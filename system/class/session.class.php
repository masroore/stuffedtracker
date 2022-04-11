<?php

// ============================================================================
//
//                        ___
//                    ,yQ$SSS$Q·,      ,yQQQL
//           i_L   I$;            `$½`       `$$,
//                                 `          I$$
//           .yQ$$$$,            ;        _,d$$'
//        ,d$$P"^```?$b,       _,'  ;  ,d$$P"`
//     ,d$P"`        `"?$$Q#QP½`    $d$$P"`
//   ,$$"         ;       ``       ;$?'
//   $$;        ,dI                I$;
//   `$$,    ,d$$$`               j$I
//     ?$S#S$P'j$'                $$;         Copyright (c) Stuffed Guys
//       `"`  j$'  __....,,,.__  j$I              www.stuffedguys.com
//           j$$½"``           ',$$
//           I$;               ,$$'
//           `$$,         _.u$$½`
//             "?$$Q##Q$$SP½"^`
//                `````
//
// ============================================================================
// $Id: session.class.php,v 1.9 2005/10/12 13:59:54 shalmoo Exp $
// ============================================================================

// class "Session". It is a simple bulkhead on the core PHP sessions.

//------------------------------------------------------------------------------------
class nsSession extends nsBase
{
    //------------------------------------------------------------------------------------
    public function __construct($sid = false)
    {
        if ($sid) {
            session_id($sid);
        }
        session_start();

        return session_id();
    }

    //------------------------------------------------------------------------------------
    public function set($name, $value = false): void
    {
        if ($value) {
            $this->__set_session_var($name, $value);
        } else {
            $this->__destroy_session_var($name);
        }
    }

    public function remove($name): void
    {
        $this->set($name);
    }

    //------------------------------------------------------------------------------------
    /**
     * @param string $name
     *
     * @return mixed
     * @desc returns the session variable. If this variable does not exist
     * in the current session - returns false.
     */
    public function get($name)
    {
        return $_SESSION[$name] ?? false;
    }

    //------------------------------------------------------------------------------------
    public function id()
    {
        return session_id();
    }

    //------------------------------------------------------------------------------------
    public function destroy(): void
    {
        $_SESSION = [];
        session_destroy();
    }

    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    public function __set_session_var($name, $val): void
    {
        $_SESSION[$name] = $val;
    }

    //------------------------------------------------------------------------------------
    public function __destroy_session_var($name): void
    {
        unset($_SESSION[$name]);
    }
}
