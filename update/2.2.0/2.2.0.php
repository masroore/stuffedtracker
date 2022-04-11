<?php

$Lang['en']['ConfErr'] = 'Unable to open configuration file';
$Lang['en']['NoConfData'] = 'No data in configuration file';
$Lang['en']['NoConfSample'] = "Unable to open 'conf.sample' file in update/2.2.0 directory.";
$Lang['en']['WriteErr'] = "Unable to open 'conf.vars.php' in write mode.";

$Lang['ru']['ConfErr'] = '�� ���� ������� ���������������� ����.';
$Lang['ru']['NoConfData'] = '���������������� ���� �� �������� ������.';
$Lang['ru']['NoConfSample'] = "�� ���� ������� 'conf.sample' � ����� update/2.2.0";
$Lang['ru']['WriteErr'] = "��� ���� �� ������ � 'conf.vars.php'.";

$Lang = array_merge($Lang, $Lang[$nsLang->CurrentLang]);

$RunSql = false;
$UpdateVersion = false;
$UseRedir = false;

ModifyConf();

function FindVariableValue($VarName, &$Data)
{
    preg_match('/\$' . $VarName . '[^=]*=[^"]*"([^"]*)";/', $Data, $Res);

    return $Res[1];
}

function ModifyConf(): void
{
    global $Lang, $Logs;

    clearstatcache();

    $f = fopen(self . '/conf.vars.php', 'rb');
    if (!$f) {
        $Logs->Err($Lang['ConfErr']);

        return;
    }
    $Data = fread($f, filesize(self . '/conf.vars.php'));
    fclose($f);
    if (!$Data) {
        $Logs->Err($Lang['NoConfData']);

        return;
    }

    $DbName = FindVariableValue('DbName', $Data);
    $DbHost = FindVariableValue('DbHost', $Data);
    $DbPass = FindVariableValue('DbPass', $Data);
    $DbUser = FindVariableValue('DbUser', $Data);
    $DbPort = FindVariableValue('DbPort', $Data);
    $DefLangFile = FindVariableValue('DefLangFile', $Data);

    $f = fopen(self . '/update/2.2.0/conf.sample', 'rb');
    if (!$f) {
        $Logs->Err($Lang['NoConfSample']);

        return;
    }
    $Conf = fread($f, filesize(self . '/update/2.2.0/conf.sample'));
    fclose($f);
    $ModR = (MOD_R) ? 'true' : 'false';
    $Conf = str_replace('{C_LANG}', $DefLangFile, $Conf);
    $Conf = str_replace('{PFX}', PFX, $Conf);
    $Conf = str_replace('{MOD_R}', $ModR, $Conf);
    $Conf = str_replace('{DB_NAME}', $DbName, $Conf);
    $Conf = str_replace('{DB_HOST}', $DbHost, $Conf);
    $Conf = str_replace('{DB_PASS}', $DbPass, $Conf);
    $Conf = str_replace('{DB_USER}', $DbUser, $Conf);
    $Conf = str_replace('{DB_PORT}', $DbPort, $Conf);

    $f = fopen(self . '/conf.vars.php', 'a+b');
    if (!$f) {
        $Logs->Err($Lang['WriteErr']);

        return;
    }
    @flock($f, LOCK_EX);
    @ftruncate($f, 0);
    @fwrite($f, $Conf);
    @flock($f, LOCK_UN);
    @fclose($f);

    global $RunSql, $UpdateVersion, $UseRedir;
    $RunSql = true;
    $UpdateVersion = true;
    $UseRedir = true;
}
