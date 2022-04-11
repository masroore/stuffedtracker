<?php

function fnAjaxError($string = false): void
{
    header('HTTP/1.1 500 Internal Server Error');
    echo $string;
    exit;
}

// ============================================================================
// Clean value from the request

function fnAjaxCleanValue($string = false)
{
    if (!$string) {
        return false;
    }
    $charset = strtolower(ValidReqVar('__SACharset', 'utf-8'));

    $string = fnAjaxConvertFromUnicode($string, $charset);

    if ($charset != 'iso-8859-1' && $charset != 'utf-8') {
        $string = html_entity_decode($string, ENT_NOQUOTES, $charset);
    }

    return $string;
}

function fnAjaxConvertFromUnicode($string = false, $charset = false)
{
    if (!$string || !$charset) {
        return false;
    }

    if (strtolower($charset) == 'utf-8') {
        return preg_replace('#%u([0-9A-F]{1,4})#ie', "fnAjaxCharCodeToUtf8(hexdec('\\1'))", utf8_encode($string));
    }

    return preg_replace('#%u([0-9A-F]{1,4})#ie', "'&#' . hexdec('\\1') . ';'", $string);
}

function fnAjaxCharCodeToUtf8($int = 0)
{
    $return = '';

    if ($int < 0) {
        return chr(0);
    } elseif ($int <= 0x007F) {
        $return .= chr($int);
    } elseif ($int <= 0x07FF) {
        $return .= chr(0xC0 | ($int >> 6));
        $return .= chr(0x80 | ($int & 0x003F));
    } elseif ($int <= 0xFFFF) {
        $return .= chr(0xE0 | ($int >> 12));
        $return .= chr(0x80 | (($int >> 6) & 0x003F));
        $return .= chr(0x80 | ($int & 0x003F));
    } elseif ($int <= 0x10FFFF) {
        $return .= chr(0xF0 | ($int >> 18));
        $return .= chr(0x80 | (($int >> 12) & 0x3F));
        $return .= chr(0x80 | (($int >> 6) & 0x3F));
        $return .= chr(0x80 | ($int & 0x3F));
    } else {
        return chr(0);
    }

    return $return;
}
