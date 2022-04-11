<?php

//================================================================
//================================================================
// the grand-parent for all ns-classes
//================================================================
class nsBase
{
    public $HeadersSent;

    public $CookieSent;

    public $P3PSent;

    //-----------------------------------------------------------
    public function __construct()
    {
        // nothing yet
        $this->HeadersSent = false;
        $this->CookieSent = false;
        $this->P3PSent = false;
    }

    //-----------------------------------------------------------
    //
    /**
     * @param object $Obj
     * @desc dynamicly unpacks all variables from the object inside the class
     */
    public function UnpackVars(&$Obj): void
    {
        if (!is_array($Obj)) {
            $Obj = (array) $Obj;
        }
        foreach ($Obj as $Key => $Value) {
            $this->$Key = $Value;
        }
    }

    //-----------------------------------------------------------
    //
    /**
     * @param string $Query
     * @desc selects the row from the DB (using the quert $Query)
     * and unpacks inwards
     */
    public function SelectUnpack($Query): void
    {
        global $Db;
        $this->UnpackVars($Db->Select($Query));
    }

    public function SendP3P(): void
    {
        $this->P3PSent = true;
        $Str = GetParam('P3P', 'STRVAL');
        $Ref = GetParam('P3P_REF', 'STRVAL');
        if (!ValidVar($Str)) {
            return;
        }
        if (ValidVar($Ref)) {
            $Ref = "policyref=\"$Ref\", ";
        } else {
            $Ref = '';
        }
        header("P3P: $Ref CP=\"$Str\"");
    }

    public function SetCookie($Name = false, $Value = false, $Expire = false, $Path = false, $Domain = false, $Secure = false)
    {
        $this->HeadersSent = true;
        $this->CookieSent = true;
        if (!$this->P3PSent) {
            $this->SendP3P();
        }

        return setcookie($Name, $Value, $Expire, $Path, $Domain, $Secure);
    }
}
//================================================================
//================================================================
