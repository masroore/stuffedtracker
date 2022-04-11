<?php

/////////////////////////////////////////////
///////// permission check here
if (!$nsUser->Logged()) {
    $nsProduct->Redir('login', '', 'admin');
}

/////////////////////////////////////////////
///////// require libraries here
$SiteId = (ValidId($_GP['SiteId'])) ? $_GP['SiteId'] : false;
$CpId = (ValidId($_GP['CpId'])) ? $_GP['CpId'] : false;
$SaveSet = (ValidArr($_GP['SaveSet'])) ? $_GP['SaveSet'] : false;

if ($CpId && !($nsUser->SUPER_USER || $nsUser->ADMIN)) {
    $nsProduct->Redir('default', '', 'admin');
}
if (!$CpId && !$nsUser->ADMIN) {
    $nsProduct->Redir('default', '', 'admin');
}

/////////////////////////////////////////////
///////// prepare any variables

$SitesArr = [];
$ClientsArr = [];
$ST = [];
$PageTitle = '';
$nsLang->TplInc('inc/user_welcome');
$nsLang->TplInc('inc/menu');

if ($nsUser->ADMIN && $nsProduct->LICENSE == 3 && !$CpId) {
    $Query = 'SELECT * FROM ' . PFX . '_tracker_client';
} else {
    $Query = 'SELECT * FROM ' . PFX . "_tracker_client WHERE ID = $CpId";
}
$Sql = new Query($Query);
while ($Row = $Sql->Row()) {
    $ClientsArr[] = $Row;
}

if (ValidId($CpId)) {
    $Query = 'SELECT ID, HOST, COMPANY_ID FROM ' . PFX . "_tracker_site WHERE COMPANY_ID=$CpId";
} else {
    $Query = 'SELECT ID, HOST, COMPANY_ID FROM ' . PFX . '_tracker_site';
}
$Sql = new Query($Query);
while ($Row = $Sql->Row()) {
    $SitesArr[$Row->COMPANY_ID][] = $Row;
}

$ConfigWhere = '';
if ($CpId) {
    $ConfigWhere = "WHERE COMPANY_ID IN (0, $CpId)";
}
$Query = 'SELECT ID, COMPANY_ID, SITE_ID, KEEP_VISITOR_PATH, KEEP_NO_REF FROM ' . PFX . "_tracker_config $ConfigWhere";
$Sql = new Query($Query);
while ($Row = $Sql->Row()) {
    $ST[$Row->COMPANY_ID][$Row->SITE_ID] = $Row;
}

for ($i = 0; $i < count($ClientsArr); ++$i) {
    if (!ValidVar($ST[$ClientsArr[$i]->ID][0])) {
        $Query = 'INSERT INTO ' . PFX . '_tracker_config (COMPANY_ID, SITE_ID) VALUES (' . $ClientsArr[$i]->ID . ', 0)';
        $Db->Query($Query);
    }
    for ($j = 0; $j < count($SitesArr[$ClientsArr[$i]->ID]); ++$j) {
        $Row = $SitesArr[$ClientsArr[$i]->ID][$j];
        if (!ValidVar($ST[$ClientsArr[$i]->ID][$Row->ID])) {
            $Query = 'INSERT INTO ' . PFX . '_tracker_config (COMPANY_ID, SITE_ID) VALUES (' . $ClientsArr[$i]->ID . ', ' . $Row->ID . ')';
            $Db->Query($Query);
        }
    }
}

$Consult->CurrentHelp = 'hint';

if (!$CpId) {
    $Glob = $ST[0][0];
    $GlobName = 'SaveSet[0][0]';
} else {
    $Glob = $ST[$CpId][0];
    if ($nsProduct->LICENSE != 3) {
        if ($Glob->KEEP_VISITOR_PATH == 2) {
            $Glob->KEEP_VISITOR_PATH = $ST[0][0]->KEEP_VISITOR_PATH;
        }
        if ($Glob->KEEP_NO_REF == 2) {
            $Glob->KEEP_NO_REF = $ST[0][0]->KEEP_NO_REF;
        }
    }
    $GlobName = "SaveSet[$CpId][0]";
}

if (ValidId($CpId)) {
    $MenuSection = 'settings';
    $ProgPath[0]['Name'] = $Lang['MSettings'];
    $ProgPath[0]['Url'] = getURL('settings', "CpId=$CpId", 'admin');
} else {
    $MenuSection = 'admin';
    $ProgPath[0]['Name'] = $Lang['Administr'];
    $ProgPath[0]['Url'] = getURL('admin', '', 'admin');
}

$PageTitle .= $Lang['Title'];
$ProgPath[1]['Name'] = $Lang['Title'];
$ProgPath[1]['Url'] = getURL('stat_config', "CpId=$CpId", 'admin');

/////////////////////////////////////////////
///////// call any process functions

if (!$nsUser->DEMO) {
    if (ValidArr($SaveSet)) {
        SaveSettings($SaveSet);
    }
}

/////////////////////////////////////////////
///////// display section here

include $nsTemplate->Inc();

/////////////////////////////////////////////
///////// process functions here

function SaveSettings($SaveSet): void
{
    global $Db, $Logs, $Lang, $CpId, $nsProduct;
    $KeepPath = '2';
    $KeepNoRef = '2';
    foreach ($SaveSet as $CP => $Arr) {
        foreach ($Arr as $SiteId => $SubArr) {
            extract($SubArr);
            $Query = 'UPDATE ' . PFX . "_tracker_config SET KEEP_VISITOR_PATH = '$KeepPath', KEEP_NO_REF = '$KeepNoRef' WHERE COMPANY_ID=$CP AND SITE_ID=$SiteId";
            $Db->Query($Query);
        }
    }
    $nsProduct->Redir(false, "RUpd=1&CpId=$CpId");
}

/////////////////////////////////////////////
///////// library section
