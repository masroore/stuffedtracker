<?php

if (!defined('NS_PHP_TRACKING')) {
    define('HOME', $CurPath);
    define('HOST', $_SERVER['HTTP_HOST']);
    define('SELF', $CurPath);
    define('PATH', $ProdPath);
    $DefLangFile = 'en';

    ///////////////////////////
    define('SYS', HOME . $SPath);
    define('COOKIE_PFX', 'ns_');
    // cookie must expire after (12 hours)
    define('COOKIE_EXP', '43200');

    define('PFX', 'ns');
    define('MOD_R', false);

    define('INSTALLED', true);
} else {
    $CookiePfx = 'ns_';
    $CookieExp = '43200';
    $DbPfx = 'ns';
}

$DbName = 'etel_dbscompanysetup';
$DbHost = 'localhost';
$DbPass = 'WSD%780=';
$DbUser = 'etel_root';
$DbPort = '3306';
