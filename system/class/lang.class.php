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
// $Id: lang.class.php,v 1.30 2005/10/21 09:56:22 kuindji Exp $
// ============================================================================

class nsLang
{
    public $CurrentLang; // current language for this page.

    public $_LangList; // the variable for list of languages

    public $htmlTagArguments;

    //-------------------------------------------------------------------------
    //-------------------------------------------------------------------------
    public function __construct()
    {
        global $DefLangFile;
        $this->htmlTagArguments = 'dir="ltr" ';
        $this->CurrentLang($DefLangFile);
    }

    //-------------------------------------------------------------------------
    public function GetList()
    {
        global $nsProduct;
        if (!isset($this->_LangList)) {
            // unpacking the query get vars:
            //	 $querystr = 'http://'.HOST.'/'.$_REQUEST['RequestPath'].'?';
            $querystr = $nsProduct->SelfAction();
            foreach ($_GET as $GName => $GValue) {
                if (
                $GName != 'RequestPath' &&
                $GName != 'lsave' &&
                $GName != 'lang' &&
                $GName != 'action' &&
                $GName != 'sc' &&
                $GName != 'prd'
                ) {
                    $querystr .= $GName . '=' . $GValue . '&';
                }
            }

            $langd = dir($this->Path());
            for ($i = 0; false !== ($entry = $langd->read()); $i) {
                if (strpos($entry, '.lang.php') && !is_dir($this->Path() . $entry)) {
                    $CLangs[$i]['name'] = str_replace('.lang.php', '', $entry);
                    $CLangs[$i]['path'] = $this->Path() . '/' . $CLangs[$i]['name'] . '/';
                    $req = $CLangs[$i]['path'] . '_system/' . $CLangs[$i]['name'] . '.config.php';
                    require $req;
                    $CLangs[$i]['caption'] = $LangConfig['name'];
                    $CLangs[$i]['charset'] = $LangConfig['charset'];
                    $CLangs[$i]['url'] = $querystr . 'lang=' . $CLangs[$i]['name'];
                    ++$i;
                    unset($LangConfig);
                }
            }

            $langd->close();
            if (!$i) { // no languages found - but we have to return something:
                $CLangs[$i]['name'] =
            $CLangs[$i]['path'] =
            $CLangs[$i]['caption'] =
            $CLangs[$i]['charset'] =
            $CLangs[$i]['url'] = '';
            }

            return $this->_LangList = $CLangs;
        }

        return $this->_LangList;
    }

    //-------------------------------------------------------------------------
    /**
     * @desc includes file that contains
     * additional cells for the array "$Lang". Exactly for the current
     * product. If nsProduct was not constructed yet - includes
     * the file for the inner system
     */
    public function Inc($def = false): void
    {
        global $nsProduct, $DefLangFile, $Lang;
        if ($def) {
            $tmpcur = $this->CurrentLang;
            $this->CurrentLang = $DefLangFile;
        }
        $retsys = SYS . '/system/lang/' . $this->CurrentLang . '.lang.php';
        // I am not shure that chosen language exists inside the
        // system - but only in this product
        $retsys = file_exists($retsys) ? $retsys : SYS . '/system/lang/' . $DefLangFile . '.lang.php';

        if (isset($nsProduct->Action)) {
            $retprod = self . '/lang/' . $this->CurrentLang . '/' . $nsProduct->Section . '.' . $nsProduct->Action . '.php';
            $retdefprod = self . '/lang/' . $DefLangFile . '/' . $nsProduct->Section . '.' . $nsProduct->Action . '.php';
            $retval = file_exists($retprod) ? $retprod :
                                (file_exists($retdefprod) ? $retdefprod : $retsys);
        } elseif (isset($nsProduct->ID)) {
            $retprod = self . '/lang/' . $this->CurrentLang . '.lang.php';
            $retdefprod = self . '/lang/' . $DefLangFile . '.lang.php';
            $retval = file_exists($retprod) ? $retprod :
                                (file_exists($retdefprod) ? $retdefprod : $retsys);
        } else {
            $retval = $retsys;
        }
        if (!$def) {
            $this->Inc(true);
        }
        require $retval;
        if ($def) {
            $this->CurrentLang = $tmpcur;
        }
    }

    //-------------------------------------------------------------------------
    public function IncConfig(): void
    {
        global $LangConfig;
        require self . '/lang/' . $this->CurrentLang . '/_system/' . $this->CurrentLang . '.config.php';
    }

    public function ReturnConfig($Lang)
    {
        $LangConfig = [];
        require self . "/lang/$Lang/_system/$Lang.config.php";

        return $LangConfig;
    }

    //-------------------------------------------------------------------------
    /**
     * @param string $file
     * @desc Include for use within naTemplate's "Inc()"
     */
    public function TplInc($file, $def = false): void
    {
        global $DefLangFile, $Lang;
        if ($def) {
            $tmpcur = $this->CurrentLang;
            $this->CurrentLang = $DefLangFile;
        }
        global $nsProduct, $DefLangFile, $Lang;
        $incf = self . '/lang/' . $this->CurrentLang . '/' . $file . '.php';
        if (!$def) {
            $this->TplInc($file, true);
        }
        if (file_exists($incf)) {
            require $incf;
        }
        if ($def) {
            $this->CurrentLang = $tmpcur;
        }
    }

    public function TplReturn($file, $def = false)
    {
        global $DefLangFile;
        $Lang = [];
        if ($def) {
            $tmpcur = $this->CurrentLang;
            $this->CurrentLang = $DefLangFile;
        }
        global $nsProduct, $DefLangFile;
        $incf = self . '/lang/' . $this->CurrentLang . '/' . $file . '.php';
        if (file_exists($incf)) {
            require $incf;

            return $Lang;
        }
    }

    //-------------------------------------------------------------------------
    public function InitLang($L = ''): void
    {
        if (!empty($L)) {
            $this->CurrentLang($L);
        }
    }

    //-------------------------------------------------------------------------
    public function CurrentLang($L): void
    {
        global $nsSession;
        $this->CurrentLang = $L;
        if (isset($nsSession)) {
            $nsSession->set('ns_lang_current', $L);
        }
    }

    //-------------------------------------------------------------------------
    public function Path()
    {
        return self . '/lang';
    }

    //-------------------------------------------------------------------------
    /**
     * @param filename $file
     * @desc Includes the specific file from the current language directory
     */
    public function IncFile($file): void
    {
        global $Lang;
        require $this->Path() . '/' . $this->CurrentLang . '/' . $file;
    }
}
