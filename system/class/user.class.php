<?php

// ============================================================================
//
//                        ___
//                    ,yQ$SSS$Q?,      ,yQQQL
//           i_L   I$;            `$?`       `$$,
//                                 `          I$$
//           .yQ$$$$,            ;        _,d$$'
//        ,d$$P"^```?$b,       _,'  ;  ,d$$P"`
//     ,d$P"`        `"?$$Q#QP?`    $d$$P"`
//   ,$$"         ;       ``       ;$?'
//   $$;        ,dI                I$;
//   `$$,    ,d$$$`               j$I
//     ?$S#S$P'j$'                $$;         Copyright (c) Stuffed Guys
//       `"`  j$'  __....,,,.__  j$I              www.stuffedguys.com
//           j$$?"``           ',$$
//           I$;               ,$$'
//           `$$,         _.u$$?`
//             "?$$Q##Q$$SP?"^`
//                `````
//
// ============================================================================
// $Id: user.class.php,v 1.47 2005/11/15 15:34:21 kuindji Exp $
// ============================================================================

// let's prefer NOT TO CALL the inner variables, it it is not marginally nessesary
// it is better to use functions instead - this should let us catch all the
// events.

// nsUser. The session contains:
// 1. the session id(generated by "uniqid"),
// 2. user agent,
// 3. IP-address(md5-ed)
//  IP-address will be updated on change
// ::::::::::::::::::::::::::
// ON CREATING the class should check if this user is authorized by session
class nsUser extends nsBase
{
    //------------------------------------------------------------------------------------
    public $UserInfo; // contains all the user info(in array)

    public $Authorized; // it is clear

    public $Logged; // it is also clear

    public $sessid;

    public $CheckByChangingIP; // the current user session ID. It exists even if user is anonymous

    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    public function __construct()
    {
        $this->CheckByChangingIP(true);
        $this->__CheckAuth();
    }

    //------------------------------------------------------------------------------------
    public function Login($login, $pwd, $recall = false)
    {
        global $Db, $nsSession, $Logs;
        // coding pwd to md5 - temporary commented
        // $pwd = md5($pwd);
        $query = 'SELECT * FROM ' . PFX . '_system_user WHERE LOGIN = ?';
        $this->UserInfo = $Db->Select($query, 'ARR', $login);
        $this->__echo_db_error($query);
        // let's check him:
        if (isset($this->UserInfo['PWD']) && $this->UserInfo['PWD'] == md5($pwd)) {
            // this is the right user!
            $nsSession->set('ns_user_auth_uid', $this->UserId());
            $nsSession->set('ns_user_auth_uinf', $this->UserMd5());
            $this->Logged = true;
            $this->Init();
            // recall was requested, writing user id and password in the cookie
            if ($recall) {
                $this->SetCookie(COOKIE_PFX . 'uid', $this->UserId(), time() + 60 * 60 * 24 * 365 * 10, '/');
                $this->SetCookie(COOKIE_PFX . 'pwd', md5($pwd), time() + 60 * 60 * 24 * 365 * 10, '/');
            }
        } else {
            // let's see why:
            if (!isset($this->UserInfo['ID'])) {
                $Logs->Error('USER:NO_USER');
            } elseif ($this->UserInfo['PWD'] != $pwd) {
                $Logs->Error('USER:WRONG_PWD');
            }

            // ereasing all possible user info
            $this->Logout();
        }

        return $this->Logged;
    }

    //------------------------------------------------------------------------------------
    // sets if
    public function CheckByChangingIP($yesno): void
    {
        $this->CheckByChangingIP = $yesno;
    }

    //------------------------------------------------------------------------------------
    // authorized?
    public function Authorized()
    {
        return $this->Authorized;
    }

    //------------------------------------------------------------------------------------
    // authorized?
    public function Logged()
    {
        if (!isset($GLOBALS['from_command_line'])) {
            return $this->Logged;
        }
        // checking command line logging:
        global $Db;
        $ulogin = ValidReqVar('user');
        $md5_pwd = md5(ValidReqVar('pwd'));
        $this->UserInfo = $Db->Select('SELECT * FROM ' . PFX . '_system_user
			WHERE LOGIN = ?', 'ARR', $ulogin);

        return ValidVar($this->UserInfo['PWD']) == $md5_pwd;
        print_r($_REQUEST);
    }

    //------------------------------------------------------------------------------------
    // returns user ID, or sets the user id (if argument is set)
    public function UserId($bySess = false)
    {
        global $nsSession;
        if ($bySess) {
            return $nsSession->get('ns_user_auth_uid');
        }

        return $this->UserInfo['ID'] ?? 0;
    }

    //------------------------------------------------------------------------------------
    public function Init(): void
    {
        global $nsProduct, $nsLang, $Db;
        //$nsProduct->Initialize($this->UserInfo['ID']);
        $query = 'SELECT * FROM ' . PFX . '_system_user2lang '
            . "WHERE UID='" . $this->UserInfo['ID'] . "' AND PROD_ID=" . $nsProduct->ID;
        $ulang = $Db->Select($query, 'ARR');
        if (isset($ulang['LANG'])) {
            $nsLang->InitLang($ulang['LANG']);
        }
        $this->ULANG = $ulang['LANG'];

        $uskin = false;
        $query = 'SELECT SKIN FROM ' . PFX . '_system_user2skin WHERE UID=' . $this->UserInfo['ID'] . ' AND PROD_ID=' . $nsProduct->ID;
        $uskin = $Db->ReturnValue($query);
        if ($uskin) {
            $nsProduct->SKIN = $uskin;
        }
        $this->USKIN = $uskin;
    }

    //------------------------------------------------------------------------------------
    // unauthorizes and authorized the client again
    public function Reauthorize(): void
    {
        $this->__Authorize();
    }

    //------------------------------------------------------------------------------------
    // returns user session ID
    public function SessionId()
    {
        return $this->sessid;
    }

    //------------------------------------------------------------------------------------
    // throws the user away from the system.
    public function Logout(): void
    {
        global $nsSession;

        $nsSession->set('ns_user_auth_uid');
        $nsSession->set('ns_user_auth_uinf');
        //$nsSession->destroy();
        // expiring cookies
        $this->SetCookie(COOKIE_PFX . 'uid', '', time() - 60 * 60 * 24 * 365 * 10, '/');
        $this->SetCookie(COOKIE_PFX . 'pwd', '', time() - 60 * 60 * 24 * 365 * 10, '/');
        //$this->SetCookie(COOKIE_PFX.'user_auths', '', time()-60*60*24*365*10, '/');

        $this->Logged = false;
        $this->UserInfo = [];
    }

    //------------------------------------------------------------------------------------
    // returns user md5 entry (user id and pwd)
    public function UserMd5()
    {
        return md5($this->UserId() . $this->UserInfo['PWD']);
    }

    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    //------------  PRIVATE FUNCTIONS:
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    // logging user by session user session
    public function __CheckUser()
    {
        global $Db, $nsSession;

        if ($this->UserId(true)) {
            $query = 'SELECT * FROM ' . PFX . '_system_user '
                                . 'WHERE ID=' . $this->UserId(true);
            $this->UserInfo = $Db->Select($query, 'ARR');
            $this->__echo_db_error($query);
        }
        // do we have the session var?
        if (
            $nsSession->get('ns_user_auth_uid') == $this->UserId() &&
            $nsSession->get('ns_user_auth_uinf') == $this->UserMd5()
        ) {
            // this is the right user!
            $this->Logged = true;
            $this->Init();
        }
        // checking if the user have login and pwd in the cookie
        elseif (isset($_COOKIE[COOKIE_PFX . 'uid'], $_COOKIE[COOKIE_PFX . 'pwd'])) {
            $uid = $_COOKIE[COOKIE_PFX . 'uid'];
            $md5_pwd = $_COOKIE[COOKIE_PFX . 'pwd'];
            $this->UserInfo = $Db->Select('SELECT * FROM ' . PFX . '_system_user WHERE ID = ?', 'ARR', $uid);
            if (isset($this->UserInfo['PWD']) && $this->UserInfo['PWD'] == $md5_pwd) {
                $this->Logged = true;
                $this->Init();
                // prolonging cookie for another 10 years
                $this->SetCookie(COOKIE_PFX . 'uid', $uid, time() + 60 * 60 * 24 * 365 * 10, '/');
                $this->SetCookie(COOKIE_PFX . 'pwd', $md5_pwd, time() + 60 * 60 * 24 * 365 * 10, '/');
            }
        }
        // erasing all possible user info
        else {
            $this->Logout();
        }

        return $this->Logged;
    }

    //------------------------------------------------------------------------------------
    // checks and sets common authorization.
    public function __CheckAuth()
    {
        global $Db, $nsSession;
        if (!$Db->ID) {
            $this->Authorized = false;

            return false;
        }

        // has the session been set?
        if (!isset($this->sessid)) {
            $this->sessid = $nsSession->get('ns_user_auth_sess');
            // OK, now checkin' the session info:
            if ($nsSession->get('ns_user_auths') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])) {
                $this->Authorized = true;
            // oh, this user has wrong check-entry. Maybe changed?
            } elseif ($this->CheckByChangingIP &&
                isset($_COOKIE[COOKIE_PFX . 'user_auths']) &&
                $nsSession->get('ns_user_auths') == $_COOKIE[COOKIE_PFX . 'user_auths']
            ) {
                // Did change. Rewriting the session entry (and cookie also):
                $this->__Authorize(true);
                $this->Authorized = true;
            } else { // it is really wrong Authorization. Creating a new one:
                $this->__Authorize();
            }
        }
        // session had not been set!
        if (!$this->sessid) {
            $this->__Authorize();
        }

        // Delivering control to user check:
        $this->__CheckUser();
    }

    public function VisitorCookie($Cookie = false)
    {
        $Domain = false;
        if (defined('COOKIE_DOMAIN')) {
            $Domain = COOKIE_DOMAIN;
        }
        if ($Cookie) {
            $this->SetCookie(COOKIE_PFX . 'visitor', $Cookie, time() + 60 * 60 * 24 * 10 * 365, '/', $Domain);

            return $Cookie;
        }
        global $_COOKIE;
        if (isset($_COOKIE[COOKIE_PFX . 'visitor'])) {
            return $_COOKIE[COOKIE_PFX . 'visitor'];
        }

        $Cookie = $this->CookieId();
        $this->SetCookie(COOKIE_PFX . 'visitor', $Cookie, time() + 60 * 60 * 24 * 10 * 365, '/', $Domain);
        //DebugStr("$this->SetCookie(COOKIE_PFX.'visitor', $Cookie, time()+1000000);");
        //$_COOKIE[COOKIE_PFX.'_visitor']=$Cookie;
        return $Cookie;
    }

    public function CookieId()
    {
        return substr(md5(uniqid(mt_rand())), 0, 32);
    }

    public function VisitorAgent()
    {
        global $_SERVER;

        return ValidVar($_SERVER['HTTP_USER_AGENT']);
    }

    //------------------------------------------------------------------------------------
    // Authorizing client
    public function __Authorize($OnlyResetUaIpEntry = false): void
    {
        global $nsSession;
        if (!$OnlyResetUaIpEntry) {
            // very hard-to-guess sequense
            $this->sessid = md5(uniqid(mt_rand(), true));
            $nsSession->set('ns_user_auth_sess', $this->sessid);
        }
        $entry = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
        $nsSession->set('ns_user_auths', $entry);
        if ($this->CheckByChangingIP) {
            $this->SetCookie(COOKIE_PFX . 'user_auths', $entry, time() + (int) COOKIE_EXP, '/');
        }
    }
    //------------------------------------------------------------------------------------

    //------------------------------------------------------------------------------------
    // this is debuggin function - turned off now.
    public function __echo_db_error($q = false): void
    {
        global $Db;
        //if($q) echo '<b>:'.$q.':</b><br>';
      //echo '<i>++'.$Db->LastError.'++</i><br>';
    }
    //------------------------------------------------------------------------------------
}
