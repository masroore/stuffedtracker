<?php

class NS_TRACK_MISC
{
    public function ValidId(&$id)
    {
        if (!isset($id)) {
            return false;
        }

        if (!is_int($id) && !is_string($id)) {
            return false;
        }

        if (is_string($id) && (string) ((int) $id) != $id) {
            return false;
        }

        if (!((int) $id >= 0)) {
            return false;
        }

        return true;
    }

    public function ValidVar(&$Var, $defval = false)
    {
        if (empty($Var)) {
            return $defval;
        }

        return $Var;
    }

    public function ValidArr(&$Arr)
    {
        if (!isset($Arr)) {
            return false;
        }
        if (!is_array($Arr)) {
            return false;
        }

        return true;
    }

    public function Redir($Url): void
    {
        header("Location: $Url");
        exit;
    }

    public function GetSettings($CompId = false, $SiteId = false)
    {
        $Where = [];
        $Where[] = '(COMPANY_ID=0 AND SITE_ID=0)';
        if (self::ValidId($CompId)) {
            $Where[] = "(COMPANY_ID=$CompId AND SITE_ID=0)";
        }
        if (self::ValidId($SiteId)) {
            $Where[] = "SITE_ID=$SiteId";
        }
        $WhereStr = 'WHERE ' . implode(' OR ', $Where);
        $Pfx = (defined('NS_DB_PFX')) ? NS_DB_PFX : PFX;
        global $_NS_TRACK_VARS;
        $QueryClass = (isset($_NS_TRACK_VARS['QueryClass'])) ? $_NS_TRACK_VARS['QueryClass'] : 'Query';
        $Query = 'SELECT * FROM ' . $Pfx . "_tracker_config $WhereStr";
        $Sql = new $QueryClass($Query);
        $Sets = [];
        while ($Row = $Sql->Row()) {
            if ($Row->COMPANY_ID == 0) {
                $Sets['All'] = $Row;
            }
            if ($Row->COMPANY_ID > 0 && $Row->SITE_ID == 0) {
                $Sets['Client'] = $Row;
            }
            if ($Row->COMPANY_ID > 0 && $Row->SITE_ID > 0) {
                $Sets['Site'] = $Row;
            }
        }

        return $Sets;
    }

    public function SetsByPrior($Arr, $Var)
    {
        if (isset($Arr['Site']->$Var) && $Arr['Site']->$Var != 2) {
            return $Arr['Site']->$Var;
        }
        if (isset($Arr['Client']->$Var) && $Arr['Client']->$Var != 2) {
            return $Arr['Client']->$Var;
        }
        if (isset($Arr['All']->$Var)) {
            return $Arr['All']->$Var;
        }

        return false;
    }

    public function TimeDblSettings($Arr, $Var, $Time)
    {
        if (isset($Arr['Site']->$Var) && $Arr['Site']->$Var != 2) {
            return $Arr['Site']->$Time;
        }
        if (isset($Arr['Client']->$Var) && $Arr['Client']->$Var != 2) {
            return $Arr['Client']->$Time;
        }
        if (isset($Arr['All']->$Var)) {
            return $Arr['All']->$Time;
        }

        return false;
    }

    public function ValidIp($IP)
    {
        $Num = '([0-9]|[0-9]{2}|1\\d\\d|2[0-4]\\d|25[0-5])';

        return preg_match("/^$Num\\.$Num\\.$Num\\.$Num$/", $IP);
    }

    public function GetMicrotime()
    {
        [$usec, $sec] = explode(' ', microtime());

        return (float) $usec + (float) $sec;
    }

    public function ToLower($str)
    {
        if (!$str) {
            return false;
        }
        $U_alph = 'éöóêåíãøùçõúôûâàïðîëäæýÿ÷ñìèòüáþ¸qwertyuiopasdfghjklzxcvbnm';
        $L_alph = 'ÉÖÓÊÅÍÃØÙÇÕÚÔÛÂÀÏÐÎËÄÆÝß×ÑÌÈÒÜÁÞ¨QWERTYUIOPASDFGHJKLZXCVBNM';

        return strtr($str, $L_alph, $U_alph);
    }

    public function CookieStorageSet($Name = false, $Value = false, $Expire = false, $Path = false, $Domain = false, $Secure = false)
    {
        if (!$Name) {
            return false;
        }
        global $nsUser, $_COOKIE, $_NS_TRACK_VARS;
        if (isset($_NS_TRACK_VARS['COOKIE_DOMAIN'])) {
            $Domain = $_NS_TRACK_VARS['COOKIE_DOMAIN'];
        }
        $CookieArr = self::ValidVar($_COOKIE[COOKIE_PFX . 'storage']);
        if (!self::ValidVar($CookieArr)) {
            $CookieArr = [];
        } else {
            $CookieArr = @unserialize($CookieArr);
        }
        if (!is_array($Name)) {
            $Arr[$Name] = $Value;
        } else {
            $Arr = $Name;
        }
        foreach ($Arr as $Name => $Value) {
            $CookieArr[$Name] = $Value;
        }
        $CookieArr = serialize($CookieArr);
        $_COOKIE[COOKIE_PFX . 'storage'] = $CookieArr;
        $nsUser->SetCookie(COOKIE_PFX . 'storage', $CookieArr, $Expire, $Path, $Domain, $Secure);
    }

    public function CookieStorageGet($Name = false)
    {
        if (!$Name) {
            return false;
        }
        global $_COOKIE;
        $CookieArr = self::ValidVar($_COOKIE[COOKIE_PFX . 'storage']);
        if (!self::ValidVar($CookieArr)) {
            return false;
        }
        $CookieArr = @unserialize($CookieArr);

        return self::ValidVar($CookieArr[$Name]);
    }

    public function escape_string($string)
    {
        if (null === $string || $string === false) {
            return null;
        }
        if (version_compare(PHP_VERSION, '4.3.0') == '-1') {
            return mysql_escape_string($string);
        }

        return mysql_real_escape_string($string);
    }

    public function ns_my_url()
    {
        return 'http' . ((strtolower(ValidVar($_SERVER['HTTPS'])) == 'on') ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
}
