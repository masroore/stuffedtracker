<?php

// vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4:
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Chuck Hagenbuch <chuck@horde.org>                           |
// |          Jon Parise <jon@php.net>                                    |
// |          Damian Alejandro Fernandez Sosa <damlists@cnba.uba.ar>      |
// +----------------------------------------------------------------------+

require_once SYS . '/system/class/pear.class.php';
require_once SYS . '/system/class/email/Net/Socket.php';

/**
 * Provides an implementation of the SMTP protocol using PEAR's
 * Net_Socket:: class.
 *
 * @author  Chuck Hagenbuch <chuck@horde.org>
 * @author  Jon Parise <jon@php.net>
 * @author  Damian Alejandro Fernandez Sosa <damlists@cnba.uba.ar>
 *
 * @example basic.php   A basic implementation of the Net_SMTP package.
 */
class Net_smtp
{
    /**
     * The server to connect to.
     *
     * @var string
     */
    public $host = 'localhost';

    /**
     * The port to connect to.
     *
     * @var int
     */
    public $port = 25;

    /**
     * The value to give when sending EHLO or HELO.
     *
     * @var string
     */
    public $localhost = 'localhost';

    /**
     * List of supported authentication methods, in preferential order.
     *
     * @var array
     */
    public $auth_methods = ['DIGEST-MD5', 'CRAM-MD5', 'LOGIN', 'PLAIN'];

    /**
     * Should debugging output be enabled?
     *
     * @var bool
     */
    public $_debug = false;

    /**
     * The socket resource being used to connect to the SMTP server.
     *
     * @var resource
     */
    public $_socket;

    /**
     * The most recent server response code.
     *
     * @var int
     */
    public $_code = -1;

    /**
     * The most recent server response arguments.
     *
     * @var array
     */
    public $_arguments = [];

    /**
     * Stores detected features of the SMTP server.
     *
     * @var array
     */
    public $_esmtp = [];

    /**
     * Instantiates a new Net_SMTP object, overriding any defaults
     * with parameters that are passed in.
     *
     * @param string the server to connect to
     * @param int the port to connect to
     * @param string the value to give when sending EHLO or HELO
     *
     * @since   1.0
     */
    public function __construct($host = null, $port = null, $localhost = null)
    {
        if (isset($host)) {
            $this->host = $host;
        }
        if (isset($port)) {
            $this->port = $port;
        }
        if (isset($localhost)) {
            $this->localhost = $localhost;
        }

        $this->_socket = new Net_Socket();

        /*
         * Include the Auth_SASL package.  If the package is not available,
         * we disable the authentication methods that depend upon it.
         */
        if ((@include_once 'Auth/SASL.php') === false) {
            $pos = array_search('DIGEST-MD5', $this->auth_methods);
            unset($this->auth_methods[$pos]);
            $pos = array_search('CRAM-MD5', $this->auth_methods);
            unset($this->auth_methods[$pos]);
        }
    }

    /**
     * Set the value of the debugging flag.
     *
     * @param   bool $debug      new value for the debugging flag
     *
     * @since   1.1.0
     */
    public function setDebug($debug): void
    {
        $this->_debug = $debug;
    }

    /**
     * Send the given string of data to the server.
     *
     * @param   string  $data       the string of data to send
     *
     * @return  mixed   true on success or a PEAR_Error object on failure
     *
     * @since   1.1.0
     */
    public function _send($data)
    {
        if ($this->_debug) {
            echo "DEBUG: Send: $data\n";
        }

        if (PEAR::isError($error = $this->_socket->write($data))) {
            return new PEAR_Error('Failed to write to socket: ' .
                                  $error->getMessage());
        }

        return true;
    }

    /**
     * Send a command to the server with an optional string of arguments.
     * A carriage return / linefeed (CRLF) sequence will be appended to each
     * command string before it is sent to the SMTP server.
     *
     * @param   string  $command    the SMTP command to send to the server
     * @param   string  $args       a string of optional arguments to append
     *                              to the command
     *
     * @return  mixed   the result of the _send() call
     *
     * @since   1.1.0
     */
    public function _put($command, $args = '')
    {
        if (!empty($args)) {
            return $this->_send($command . ' ' . $args . "\r\n");
        }

        return $this->_send($command . "\r\n");
    }

    /**
     * Read a reply from the SMTP server.  The reply consists of a response
     * code and a response message.
     *
     * @param   mixed   $valid      The set of valid response codes.  These
     *                              may be specified as an array of integer
     *                              values or as a single integer value.
     *
     * @return  mixed   true if the server returned a valid response code or
     *                  a PEAR_Error object is an error condition is reached
     *
     * @since   1.1.0
     * @see     getResponse
     */
    public function _parseResponse($valid)
    {
        $this->_code = -1;
        $this->_arguments = [];

        while ($line = $this->_socket->readLine()) {
            if ($this->_debug) {
                echo "DEBUG: Recv: $line\n";
            }

            // If we receive an empty line, the connection has been closed.
            if (empty($line)) {
                $this->disconnect();

                return new PEAR_Error('Connection was unexpectedly closed');
            }

            // Read the code and store the rest in the arguments array.
            $code = substr($line, 0, 3);
            $this->_arguments[] = trim(substr($line, 4));

            // Check the syntax of the response code.
            if (is_numeric($code)) {
                $this->_code = (int) $code;
            } else {
                $this->_code = -1;

                break;
            }

            // If this is not a multiline response, we're done.
            if (substr($line, 3, 1) != '-') {
                break;
            }
        }

        // Compare the server's response code with the valid code.
        if (is_int($valid) && ($this->_code === $valid)) {
            return true;
        }

        // If we were given an array of valid response codes, check each one.
        if (is_array($valid)) {
            foreach ($valid as $valid_code) {
                if ($this->_code === $valid_code) {
                    return true;
                }
            }
        }

        return new PEAR_Error('Invalid response code received from server');
    }

    /**
     * Return a 2-tuple containing the last response from the SMTP server.
     *
     * @return  array   a two-element array: the first element contains the
     *                  response code as an integer and the second element
     *                  contains the response's arguments as a string
     *
     * @since   1.1.0
     */
    public function getResponse()
    {
        return [$this->_code, implode("\n", $this->_arguments)];
    }

    /**
     * Attempt to connect to the SMTP server.
     *
     * @param   int     $timeout    the timeout value (in seconds) for the
     *                              socket connection
     * @param   bool    $persistent Should a persistent socket connection
     *                              be used?
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.0
     */
    public function connect($timeout = null, $persistent = false)
    {
        $result = $this->_socket->connect(
            $this->host,
            $this->port,
            $persistent,
            $timeout
        );
        if (PEAR::isError($result)) {
            return new PEAR_Error('Failed to connect socket: ' .
                                  $result->getMessage());
        }

        if (PEAR::isError($error = $this->_parseResponse(220))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_negotiate())) {
            return $error;
        }

        return true;
    }

    /**
     * Attempt to disconnect from the SMTP server.
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.0
     */
    public function disconnect()
    {
        if (PEAR::isError($error = $this->_put('QUIT'))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_parseResponse(221))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_socket->disconnect())) {
            return new PEAR_Error('Failed to disconnect socket: ' .
                                  $error->getMessage());
        }

        return true;
    }

    /**
     * Attempt to send the EHLO command and obtain a list of ESMTP
     * extensions available, and failing that just send HELO.
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.1.0
     */
    public function _negotiate()
    {
        if (PEAR::isError($error = $this->_put('EHLO', $this->localhost))) {
            return $error;
        }

        if (PEAR::isError($this->_parseResponse(250))) {
            // If we receive a 503 response, we're already authenticated.
            if ($this->_code === 503) {
                return true;
            }

            // If the EHLO failed, try the simpler HELO command.
            if (PEAR::isError($error = $this->_put('HELO', $this->localhost))) {
                return $error;
            }
            if (PEAR::isError($this->_parseResponse(250))) {
                return new PEAR_Error('HELO was not accepted: ', $this->_code);
            }

            return true;
        }

        foreach ($this->_arguments as $argument) {
            $verb = strtok($argument, ' ');
            $arguments = substr(
                $argument,
                strlen($verb) + 1,
                strlen($argument) - strlen($verb) - 1
            );
            $this->_esmtp[$verb] = $arguments;
        }

        return true;
    }

    /**
     * Returns the name of the best authentication method that the server
     * has advertised.
     *
     * @return mixed    returns a string containing the name of the best
     *                  supported authentication method or a PEAR_Error object
     *                  if a failure condition is encountered
     *
     * @since  1.1.0
     */
    public function _getBestAuthMethod()
    {
        $available_methods = explode(' ', $this->_esmtp['AUTH']);

        foreach ($this->auth_methods as $method) {
            if (in_array($method, $available_methods)) {
                return $method;
            }
        }

        return new PEAR_Error('No supported authentication methods');
    }

    /**
     * Attempt to do SMTP authentication.
     *
     * @param string the userid to authenticate as
     * @param string the password to authenticate with
     * @param string The requested authentication method.  If none is
     *               specified, the best supported method will be used.
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.0
     */
    public function auth($uid, $pwd, $method = '')
    {
        if (empty($this->_esmtp['AUTH'])) {
            return new PEAR_Error('SMTP server does no support authentication');
        }

        /*
         * If no method has been specified, get the name of the best supported
         * method advertised by the SMTP server.
         */
        if (empty($method)) {
            if (PEAR::isError($method = $this->_getBestAuthMethod())) {
                // Return the PEAR_Error object from _getBestAuthMethod().
                return $method;
            }
        } else {
            $method = strtoupper($method);
            if (!in_array($method, $this->auth_methods)) {
                return new PEAR_Error("$method is not a supported authentication method");
            }
        }

        switch ($method) {
            case 'DIGEST-MD5':
                $result = $this->_authDigest_MD5($uid, $pwd);

                break;
            case 'CRAM-MD5':
                $result = $this->_authCRAM_MD5($uid, $pwd);

                break;
            case 'LOGIN':
                $result = $this->_authLogin($uid, $pwd);

                break;
            case 'PLAIN':
                $result = $this->_authPlain($uid, $pwd);

                break;
            default:
                $result = new PEAR_Error("$method is not a supported authentication method");

                break;
        }

        // If an error was encountered, return the PEAR_Error object.
        if (PEAR::isError($result)) {
            return $result;
        }

        // RFC-2554 requires us to re-negotiate ESMTP after an AUTH.
        if (PEAR::isError($error = $this->_negotiate())) {
            return $error;
        }

        return true;
    }

    /**
     * Authenticates the user using the DIGEST-MD5 method.
     *
     * @param string the userid to authenticate as
     * @param string the password to authenticate with
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.1.0
     */
    public function _authDigest_MD5($uid, $pwd)
    {
        if (PEAR::isError($error = $this->_put('AUTH', 'DIGEST-MD5'))) {
            return $error;
        }
        // 334: Continue authentication request
        if (PEAR::isError($error = $this->_parseResponse(334))) {
            // 503: Error: already authenticated
            if ($this->_code === 503) {
                return true;
            }

            return $error;
        }

        $challenge = base64_decode($this->_arguments[0]);
        $digest = &Auth_SASL::factory('digestmd5');
        $auth_str = base64_encode($digest->getResponse(
            $uid,
            $pwd,
            $challenge,
            $this->host,
            'smtp'
        ));

        if (PEAR::isError($error = $this->_put($auth_str))) {
            return $error;
        }
        // 334: Continue authentication request
        if (PEAR::isError($error = $this->_parseResponse(334))) {
            return $error;
        }

        /*
         * We don't use the protocol's third step because SMTP doesn't allow
         * subsequent authentication, so we just silently ignore it.
         */
        if (PEAR::isError($error = $this->_put(' '))) {
            return $error;
        }
        // 235: Authentication successful
        if (PEAR::isError($error = $this->_parseResponse(235))) {
            return $error;
        }
    }

    /**
     * Authenticates the user using the CRAM-MD5 method.
     *
     * @param string the userid to authenticate as
     * @param string the password to authenticate with
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.1.0
     */
    public function _authCRAM_MD5($uid, $pwd)
    {
        if (PEAR::isError($error = $this->_put('AUTH', 'CRAM-MD5'))) {
            return $error;
        }
        // 334: Continue authentication request
        if (PEAR::isError($error = $this->_parseResponse(334))) {
            // 503: Error: already authenticated
            if ($this->_code === 503) {
                return true;
            }

            return $error;
        }

        $challenge = base64_decode($this->_arguments[0]);
        $cram = &Auth_SASL::factory('crammd5');
        $auth_str = base64_encode($cram->getResponse($uid, $pwd, $challenge));

        if (PEAR::isError($error = $this->_put($auth_str))) {
            return $error;
        }

        // 235: Authentication successful
        if (PEAR::isError($error = $this->_parseResponse(235))) {
            return $error;
        }
    }

    /**
     * Authenticates the user using the LOGIN method.
     *
     * @param string the userid to authenticate as
     * @param string the password to authenticate with
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.1.0
     */
    public function _authLogin($uid, $pwd)
    {
        if (PEAR::isError($error = $this->_put('AUTH', 'LOGIN'))) {
            return $error;
        }
        // 334: Continue authentication request
        if (PEAR::isError($error = $this->_parseResponse(334))) {
            // 503: Error: already authenticated
            if ($this->_code === 503) {
                return true;
            }

            return $error;
        }

        if (PEAR::isError($error = $this->_put(base64_encode($uid)))) {
            return $error;
        }
        // 334: Continue authentication request
        if (PEAR::isError($error = $this->_parseResponse(334))) {
            return $error;
        }

        if (PEAR::isError($error = $this->_put(base64_encode($pwd)))) {
            return $error;
        }

        // 235: Authentication successful
        if (PEAR::isError($error = $this->_parseResponse(235))) {
            return $error;
        }

        return true;
    }

    /**
     * Authenticates the user using the PLAIN method.
     *
     * @param string the userid to authenticate as
     * @param string the password to authenticate with
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.1.0
     */
    public function _authPlain($uid, $pwd)
    {
        if (PEAR::isError($error = $this->_put('AUTH', 'PLAIN'))) {
            return $error;
        }
        // 334: Continue authentication request
        if (PEAR::isError($error = $this->_parseResponse(334))) {
            // 503: Error: already authenticated
            if ($this->_code === 503) {
                return true;
            }

            return $error;
        }

        $auth_str = base64_encode(chr(0) . $uid . chr(0) . $pwd);

        if (PEAR::isError($error = $this->_put($auth_str))) {
            return $error;
        }

        // 235: Authentication successful
        if (PEAR::isError($error = $this->_parseResponse(235))) {
            return $error;
        }

        return true;
    }

    /**
     * Send the HELO command.
     *
     * @param string the domain name to say we are
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.0
     */
    public function helo($domain)
    {
        if (PEAR::isError($error = $this->_put('HELO', $domain))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_parseResponse(250))) {
            return $error;
        }

        return true;
    }

    /**
     * Send the MAIL FROM: command.
     *
     * @param string the sender (reverse path) to set
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.0
     */
    public function mailFrom($sender)
    {
        if (PEAR::isError($error = $this->_put('MAIL', "FROM:<$sender>"))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_parseResponse(250))) {
            return $error;
        }

        return true;
    }

    /**
     * Send the RCPT TO: command.
     *
     * @param string the recipient (forward path) to add
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.0
     */
    public function rcptTo($recipient)
    {
        if (PEAR::isError($error = $this->_put('RCPT', "TO:<$recipient>"))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_parseResponse([250, 251]))) {
            return $error;
        }

        return true;
    }

    /**
     * Quote the data so that it meets SMTP standards.
     *
     * This is provided as a separate public function to facilitate easier
     * overloading for the cases where it is desirable to customize the
     * quoting behavior.
     *
     * @param string The message text to quote.  The string must be passed
     *               by reference, and the text will be modified in place.
     *
     * @since  1.2
     */
    public function quotedata(&$data): void
    {
        /*
         * Change Unix (\n) and Mac (\r) linefeeds into Internet-standard CRLF
         * (\r\n) linefeeds.
         */
        $data = preg_replace("/([^\r]{1})\n/", "\\1\r\n", $data);
        $data = preg_replace("/\n\n/", "\n\r\n", $data);

        /*
         * Because a single leading period (.) signifies an end to the data,
         * legitimate leading periods need to be "doubled" (e.g. '..').
         */
        $data = preg_replace("/\n\\./", "\n..", $data);
    }

    /**
     * Send the DATA command.
     *
     * @param string the message body to send
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.0
     */
    public function data($data)
    {
        /*
         * RFC 1870, section 3, subsection 3 states "a value of zero indicates
         * that no fixed maximum message size is in force".  Furthermore, it
         * says that if "the parameter is omitted no information is conveyed
         * about the server's fixed maximum message size".
         */
        if (isset($this->_esmtp['SIZE']) && ($this->_esmtp['SIZE'] > 0)) {
            if (strlen($data) >= $this->_esmtp['SIZE']) {
                $this->disconnect();

                return new PEAR_Error('Message size excedes the server limit');
            }
        }

        // Quote the data based on the SMTP standards.
        $this->quotedata($data);

        if (PEAR::isError($error = $this->_put('DATA'))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_parseResponse(354))) {
            return $error;
        }

        if (PEAR::isError($this->_send($data . "\r\n.\r\n"))) {
            return new PEAR_Error('write to socket failed');
        }
        if (PEAR::isError($error = $this->_parseResponse(250))) {
            return $error;
        }

        return true;
    }

    /**
     * Send the SEND FROM: command.
     *
     * @param string the reverse path to send
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.2.6
     */
    public function sendFrom($path)
    {
        if (PEAR::isError($error = $this->_put('SEND', "FROM:<$path>"))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_parseResponse(250))) {
            return $error;
        }

        return true;
    }

    /**
     * Backwards-compatibility wrapper for sendFrom().
     *
     * @param string the reverse path to send
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since       1.0
     * @deprecated  1.2.6
     */
    public function send_from($path)
    {
        return sendFrom($path);
    }

    /**
     * Send the SOML FROM: command.
     *
     * @param string the reverse path to send
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.2.6
     */
    public function somlFrom($path)
    {
        if (PEAR::isError($error = $this->_put('SOML', "FROM:<$path>"))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_parseResponse(250))) {
            return $error;
        }

        return true;
    }

    /**
     * Backwards-compatibility wrapper for somlFrom().
     *
     * @param string the reverse path to send
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since       1.0
     * @deprecated  1.2.6
     */
    public function soml_from($path)
    {
        return somlFrom($path);
    }

    /**
     * Send the SAML FROM: command.
     *
     * @param string the reverse path to send
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.2.6
     */
    public function samlFrom($path)
    {
        if (PEAR::isError($error = $this->_put('SAML', "FROM:<$path>"))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_parseResponse(250))) {
            return $error;
        }

        return true;
    }

    /**
     * Backwards-compatibility wrapper for samlFrom().
     *
     * @param string the reverse path to send
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since       1.0
     * @deprecated  1.2.6
     */
    public function saml_from($path)
    {
        return samlFrom($path);
    }

    /**
     * Send the RSET command.
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.0
     */
    public function rset()
    {
        if (PEAR::isError($error = $this->_put('RSET'))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_parseResponse(250))) {
            return $error;
        }

        return true;
    }

    /**
     * Send the VRFY command.
     *
     * @param string The string to verify
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.0
     */
    public function vrfy($string)
    {
        // Note: 251 is also a valid response code
        if (PEAR::isError($error = $this->_put('VRFY', $string))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_parseResponse(250))) {
            return $error;
        }

        return true;
    }

    /**
     * Send the NOOP command.
     *
     * @return mixed returns a PEAR_Error with an error message on any
     *               kind of failure, or true on success
     *
     * @since  1.0
     */
    public function noop()
    {
        if (PEAR::isError($error = $this->_put('NOOP'))) {
            return $error;
        }
        if (PEAR::isError($error = $this->_parseResponse(250))) {
            return $error;
        }

        return true;
    }

    /**
     * Backwards-compatibility method.  identifySender()'s functionality is
     * now handled internally.
     *
     * @return  bool     this method always return true
     *
     * @since   1.0
     */
    public function identifySender()
    {
        return true;
    }
}
