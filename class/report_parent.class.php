<?php

class ReportParent
{
    public function GetSiteIds($CpId)
    {
        $Arr = [];
        $Str = '';
        $Query = 'SELECT ID FROM ' . PFX . "_tracker_site WHERE COMPANY_ID = $CpId";
        $Sql = new Query($Query);
        while ($Row = $Sql->Row()) {
            $Arr[] = $Row->ID;
        }
        if (count($Arr) == 0) {
            return false;
        }
        $Str = implode(',', $Arr);

        return $Str;
    }

    public function GetRatio($UniVisit = false, $UniSome = false)
    {
        if (!$UniVisit || !$UniSome) {
            return 0;
        }

        return round((100 / $UniVisit) * $UniSome, 2);
    }

    public function GetMicrotime()
    {
        [$usec, $sec] = explode(' ', microtime());

        return (float) $usec + (float) $sec;
    }

    public function OneOf($Current = false, $Total = false)
    {
        if ($Total <= 0) {
            return '0/0';
        }
        if ($Current <= 0) {
            return "0/$Total";
        }

        return '1/' . ceil($Total / $Current);
    }

    public function EnableAll(): void
    {
        $this->ShowVisitors = true;
        $this->ShowActions = true;
        $this->ShowSales = true;
        $this->ShowActionConv = true;
        $this->ShowSaleConv = true;
        $this->ShowROI = true;
    }

    public function DisableAll(): void
    {
        $this->ShowVisitors = false;
        $this->ShowActions = false;
        $this->ShowSales = false;
        $this->ShowActionConv = false;
        $this->ShowSaleConv = false;
        $this->ShowROI = false;
    }
}
