<?php

//
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
// | Author: Chuck Hagenbuch <chuck@horde.org>                            |
// +----------------------------------------------------------------------+
//
// $Id: mail.php,v 1.3 2005/07/04 09:37:07 shalmoo Exp $

require_once SYS . '/system/class/pear.class.php';

/**
 * PEAR's Mail:: interface. Defines the interface for implementing
 * mailers under the PEAR hierarchy, and provides supporting functions
 * useful in multiple mailer backends.
 *
 * @version $Revision: 1.3 $
 */
class mail
{
    /**
     * Line terminator used for separating header lines.
     *
     * @var string
     */
    public $sep = "\r\n";

    /**
     * Provides an interface for generating Mail:: objects of various
     * types.
     *
     * @param string $driver the kind of Mail:: object to instantiate
     * @param array  $params the parameters to pass to the Mail:: object
     *
     * @return object Mail a instance of the driver class or if fails a PEAR Error
     */
    public function factory($driver, $params = [])
    {
        $driver = strtolower($driver);
        include_once SYS . '/system/class/email/mail/' . $driver . '.php';
        $class = 'Mail_' . $driver;
        if (class_exists($class)) {
            return new $class($params);
        }

        return PEAR::raiseError('Unable to find class for driver ' . $driver);
    }

    /**
     * Implements Mail::send() function using php's built-in mail()
     * command.
     *
     * @param mixed $recipients Either a comma-seperated list of recipients
     *              (RFC822 compliant), or an array of recipients,
     *              each RFC822 valid. This may contain recipients not
     *              specified in the headers, for Bcc:, resending
     *              messages, etc.
     * @param array $headers The array of headers to send with the mail, in an
     *              associative array, where the array key is the
     *              header name (ie, 'Subject'), and the array value
     *              is the header value (ie, 'test'). The header
     *              produced from those values would be 'Subject:
     *              test'.
     * @param string $body the full text of the message body, including any
     *               Mime parts, etc
     *
     * @return mixed returns true on success, or a PEAR_Error
     *               containing a descriptive error message on
     *               failure
     *
     * @deprecated use Mail_mail::send instead
     */
    public function send($recipients, $headers, $body)
    {
        // if we're passed an array of recipients, implode it.
        if (is_array($recipients)) {
            $recipients = implode(', ', $recipients);
        }

        // get the Subject out of the headers array so that we can
        // pass it as a seperate argument to mail().
        $subject = '';
        if (isset($headers['Subject'])) {
            $subject = $headers['Subject'];
            unset($headers['Subject']);
        }

        // flatten the headers out.
        [, $text_headers] = self::prepareHeaders($headers);

        return mail($recipients, $subject, $body, $text_headers);
    }

    /**
     * Take an array of mail headers and return a string containing
     * text usable in sending a message.
     *
     * @param array $headers The array of headers to prepare, in an associative
     *              array, where the array key is the header name (ie,
     *              'Subject'), and the array value is the header
     *              value (ie, 'test'). The header produced from those
     *              values would be 'Subject: test'.
     *
     * @return mixed returns false if it encounters a bad address,
     *               otherwise returns an array containing two
     *               elements: Any From: address found in the headers,
     *               and the plain text version of the headers
     */
    public function prepareHeaders($headers)
    {
        $lines = [];
        $from = null;
        foreach ($headers as $key => $value) {
            if ($key === 'From') {
                include_once SYS . '/system/class/email/mail/RFC822.php';

                $addresses = Mail_RFC822::parseAddressList(
                    $value,
                    'localhost',
                    false
                );
                $from = $addresses[0]->mailbox . '@' . $addresses[0]->host;

                // Reject envelope From: addresses with spaces.
                if (strstr($from, ' ')) {
                    return false;
                }

                $lines[] = $key . ': ' . $value;
            } elseif ($key === 'Received') {
                // Put Received: headers at the top.  Spam detectors often
                // flag messages with Received: headers after the Subject:
                // as spam.
                array_unshift($lines, $key . ': ' . $value);
            } else {
                $lines[] = $key . ': ' . $value;
            }
        }
        $ret = [$from, implode($this->sep, $lines) . $this->sep];

        return $ret;
    }

    /**
     * Take a set of recipients and parse them, returning an array of
     * bare addresses (forward paths) that can be passed to sendmail
     * or an smtp server with the rcpt to: command.
     *
     * @param mixed either a comma-seperated list of recipients
     *              (RFC822 compliant), or an array of recipients,
     *              each RFC822 valid
     *
     * @return array an array of forward paths (bare addresses)
     */
    public function parseRecipients($recipients)
    {
        include_once SYS . '/system/class/email/mail/RFC822.php';

        // if we're passed an array, assume addresses are valid and
        // implode them before parsing.
        if (is_array($recipients)) {
            $recipients = implode(', ', $recipients);
        }

        // Parse recipients, leaving out all personal info. This is
        // for smtp recipients, etc. All relevant personal information
        // should already be in the headers.
        $addresses = Mail_RFC822::parseAddressList($recipients, 'localhost', false);
        $recipients = [];
        if (is_array($addresses)) {
            foreach ($addresses as $ob) {
                $recipients[] = $ob->mailbox . '@' . $ob->host;
            }
        }

        return $recipients;
    }
}
