<?php

// ============================================================================
//
//                        ___
//                    ,yQ$SSS$Q�,      ,:yQQQL
//           i_L   I$;            `$�`       `$$,
//                                 `          I$$
//           .:yQ$$$$,            ;        _,d$$'
//        ,d$$P"^```?$b,       _,'  ;  ,:d$$P"`
//     ,d$P"`        `"?$$Q#QP�`    $d$$P"`
//   ,$$"         ;       ``       ;$?'
//   $$;        ,dI                I$;
//   `$$,    ,d$$$`               j$I
//     ?$S#S$P'j$'                $$;         Copyright (c) Stuffed Guys
//       `"`  j$'  __....,,,.__  j$I              www.stuffedguys.com
//           j$$�"``           ',$$
//           I$;               ,$$'
//           `$$,         _.:u$$�`
//             "?$$Q##Q$$SP�"^`
//                `````
//
// ============================================================================
// $Id: template.class.php,v 1.37 2005/12/01 10:34:34 kuindji Exp $
// ============================================================================

class nsTemplate
{
    //-----------------------------------------------------------------------
     public $TemplatePath; // the relative path to current skin

     public $PrePath; // the prefix for absolute path

    public $__tplName; // used for template name(usually the action name) - can be added only once!

    public $__tplNameDone; // controls if the tplName already set.

    //-----------------------------------------------------------------------
    //-----------------------------------------------------------------------
    //-----------------------------------------------------------------------
    // constructing paths
    public function __construct()
    {
        global $nsProduct;
        $__tplNameDone = false;
        $this->TemplatePath = '/skins/' . $nsProduct->SKIN;
        $this->IncludePath = self . '/skins/' . $nsProduct->SKIN;

        $this->Config = $this->GetSkinConfig();
        $Config = $this->Config;
        $this->LinksCache = [];
        while (ValidVar($Config['Parent'])) {
            $this->Config['ParentConfig'] = $this->GetSkinConfig($this->Config['Parent']);
            $Config = $this->Config['ParentConfig'];
        }
    }

    //-----------------------------------------------------------------------
    /**
     * Returns full path to php file from the "[current skin]" directory.
     * NO ".php" EXTENTION NEEDED!!!
     *
     * @param file_path $File
     *
     * @return full_file_path
     */
    public function Inc($File = false, $NoLang = false)
    {
        global $nsProduct, $nsLang;
        if (!$File) {
            $File = (($nsProduct->Section) ? $nsProduct->Section . '.' : '') . $nsProduct->Action;
        }
        if (!$NoLang) {
            $nsLang->TplInc($File);
        }
        $File .= '.php';

        return $this->LinkToFile($File);

        //$this->LastInc = $this->IncludePath."/$File.php";
        //if (!@file_exists($this->LastInc)) {
        //	$this->IncludePath = SELF.'/skins/'.$nsProduct->DEFAULT_SKIN;
        //	return $this->Inc($File);
        //}
        //return $this->LastInc;
    }

    public function LinkToFile($FileName = false, $Link = false)
    {
        if (!$FileName) {
            return false;
        }
        global $nsProduct;
        $UseCurrentSkin = false;
        $Skin = $nsProduct->SKIN;
        if ($Link && isset($this->LinkCache[$FileName])) {
            return $this->LinkCache[$FileName];
        }

        if (isset($this->Config['Files'], $this->Config['Files'][$FileName])) {
            $UseCurrentSkin = true;
        }

        if ($UseCurrentSkin || @file_exists(self . "/skins/$Skin/$FileName")) {
            if ($Link) {
                $this->LinkCache[$FileName] = PATH . "/skins/$Skin/$FileName";

                return PATH . "/skins/$Skin/$FileName";
            }

            return self . "/skins/$Skin/$FileName";
        }

        $Config = $this->Config;
        while (ValidVar($Config['Parent'])) {
            $Skin = $Config['Parent'];
            if (@file_exists(self . "/skins/$Skin/$FileName")) {
                if ($Link) {
                    $this->LinkCache[$FileName] = PATH . "/skins/$Skin/$FileName";

                    return PATH . "/skins/$Skin/$FileName";
                }

                return self . "/skins/$Skin/$FileName";
            }
            if (ValidArr($Config['ParentConfig'])) {
                $Config = $Config['ParentConfig'];
            } else {
                $Config = false;
            }
        }

        $Skin = $nsProduct->DEFAULT_SKIN;
        if (@file_exists(self . "/skins/$Skin/$FileName")) {
            if ($Link) {
                $this->LinkCache[$FileName] = PATH . "/skins/$Skin/$FileName";

                return PATH . "/skins/$Skin/$FileName";
            }

            return self . "/skins/$Skin/$FileName";
        }

        return false;
    }
    //-----------------------------------------------------------------------

    //-----------------------------------------------------------------------
    // sets template name. IT CAN BE SET ONLY ONCE!!!
    public function SetTplName($tplName): void
    {
        global $Logs;
        if ($this->__tplNameDone) {
            $Logs->Error('TPL:TPL_ALREADY_SET');
        } else {
            $this->__tplName = $tplName;
            $this->__tplNameDone = true;
        }
    }

    public function GetSkinConfig($Skin = false)
    {
        global $nsProduct;
        if (!$Skin) {
            $Skin = $nsProduct->SKIN;
        }
        if (@file_exists(self . "/skins/$Skin/config/conf.skin.php")) {
            include_once self . "/skins/$Skin/config/conf.skin.php";
        }
        if (ValidArr($SkinConfig)) {
            return $SkinConfig;
        }

        return false;
    }

    //-----------------------------------------------------------------------
    // returns absolute path to current skin.
    public function AbsPath()
    {
        return $this->IncludePath;
    }

    //-----------------------------------------------------------------------
    // PROTOTYPE YET: shows the output to user
    //function Dump(){
    //	$this->__DestroyDangerousInfo();
    //	require_once($this->PrePath.$this->$tplName);
    //}

    //-----------------------------------------------------------------------
    // destroys all that designer can use for hacking the system
    public function __DestroyDangerousInfo(): void
    {
        global $Db, $DbName, $DbHost, $DbPass, $DbUser, $DbPort;
        unset($DbName, $DbHost, $DbPass, $DbUser, $DbPort);
        $Db->Close();
    }

    //------------------------------------------------------------------------
    public function HrefSelected($href)
    {
        global $nsProduct;

        return $nsProduct->Action == $href;
    }

    //------------------------------------------------------------------------
    // returns a specified query paramater, optionally NOT encoding all
    // html inside of the value, because normally it used for inserting
    // query params in the form, thus the encoding is preferred for safety
    public function Query($param, $not_encode = false)
    {
        if (!isset($param) || !isset($_REQUEST[$param])) {
            return '';
        }

        return $not_encode ? $_REQUEST[$param] : htmlspecialchars($_REQUEST[$param]);
    }

    //------------------------------------------------------------------------
    // returns * if the specified parameter is not in the $_REQUEST, or an empty
    // string if it is there, used to mark required fields in the form
    public function Required($param = false)
    {
        if (!$param || (isset($_REQUEST[$param]) && $_REQUEST[$param] != '')) {
            return '';
        }

        return '<span class="missing">*</span>';
    }

    //------------------------------------------------------------------------
    // cuts the end of the string, leaving only specified number of characters
    public function Cut($string, $length = 50)
    {
        if (empty($string)) {
            return ' ';
        }
        if (strlen($string) <= $length) {
            return $string;
        }
        $string = substr($string, 0, $length);
        $string = preg_replace('/\\s+^/', '', $string) . '...';

        return empty($string) ? ' ' : $string;
    }

    //---------------------------------------------------------
    /**
     * @param email $to
     * @param file_name $tmpl
     *
     * @return bool
     * @desc sends mail to $to from system default mail.
     * gets content from "<cuttent skin>/mail/$tmpl.php" file.
     */
    public function mail($to, $tmpl)
    {
        include_once SYS . '/system/class/nsemail.class.php';
        include_once self . '/lib/htmlout.php';
        global $tMail, $LangConfig, $Lang, $nsTemplate, $send_from_this_mail;
        $charset = ValidVar($LangConfig['charset'], '');
        if (!$charset) {
            $charset = '';
        } else {
            $charset = " charset=$charset";
        }

        // grabbing the template content:
        ob_start();
        include $nsTemplate->Inc('mail/' . $tmpl);
        $content = ob_get_contents();
        //ob_end_clean();
        // building header(output is an HTML format, isn't it?):
        $headers['MIME-Version'] = '1.0';
        $headers['Content-Type'] = "text/html;$charset";
        // other parameters:
        $headers['To'] = $to;
        $headers['Subject'] = $subject;
        $headers['From'] = $send_from_this_mail;
        $headers['Reply-To'] = $send_from_this_mail;
        nsEmail::send($to, $headers, $content);
    }
}

function FileLink($File = false)
{
    if (!$File) {
        return false;
    }
    global $nsTemplate;

    return $nsTemplate->LinkToFile($File, 1);
}
