<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>



<SCRIPT LANGUAGE="JavaScript">
<!--


function CheckReg(Obj)
{
	var Obj=GetObj("CheckForm");
	var Reg1=GetObj("Regular");
	var Reg2=GetObj("Regular2");
	var Hid1=GetObj("R1");
	var Hid2=GetObj("R2");
	if (!Reg1.value&&!Reg2.value) return false;
	Hid1.value=Reg1.value;
	Hid2.value=Reg2.value;
	Obj.submit();
}

//-->
</SCRIPT>

<?PostFORM(false,false, false, "ID=CheckForm target=_blank");?>
<input type=hidden name=RegCheck value=1>
<input type=hidden id=R1 name=R1>
<input type=hidden id=R2 name=R2>
</form>

<?PostFORM();?>
<input type="hidden" name="EditId" value="<?php echo $EditId?>">
<input type="hidden" name="Mode" value="<?php echo $Mode?>">


<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $TableCaption?>
</td></tr>
</table>



<table  class=FormTable>

<tr><td class=FormLeftTd>
<?php echo $Lang['Name']?>
<?FormError("Name")?>
</td><td class=FormRightTd>
<input type=text name="EditArr[Name]" value="<?php echo $EditArr['Name']?>" style="width:100%;">
</td></tr>


<tr><td class=FormLeftTd>
<?php echo $Lang['KeyVarName']?>
<?FormError("KeyVar")?>
</td><td class=FormRightTd>
<input type=text name="EditArr[KeyVar]" value="<?php echo $EditArr['KeyVar']?>" style="width:100%;">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['StatIgnor']?>
<?FormError("Ban")?>
</td><td class=FormRightTd>
<input type=checkbox name="EditArr[Ban]" value=1 <?php echo (($EditArr['Ban'] == 1) ? 'checked' : '')?>>
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['RegExp']?><br>
<span class=ListDescr>
<?php echo $Lang['RegExpDescr']?>
</span>
<?FormError("Regular")?>
</td><td class=FormRightTd>
<input type=text id="Regular" name="EditArr[Regular]" value="<?php echo htmlspecialchars($EditArr['Regular'])?>" style="width:100%;">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['RegExp2']?><br>
<span class=ListDescr>
<?php echo $Lang['RegExpDescr']?>
</span>
<?FormError("Regular")?>
</td><td class=FormRightTd>
<input type=text id="Regular2" name="EditArr[Regular2]" value="<?php echo htmlspecialchars($EditArr['Regular2'])?>" style="width:100%;">
</td></tr>

</table>

<table class=SubmitTable>
<tr><td class=SubmitLeftTd style="padding-left:10px;">

</td><td class=SubmitRightTd>
<input type=submit value="<?php echo $Lang['Save']?>">
<input type=button value="<?php echo $Lang['CheckRegs']?>" onclick="return CheckReg();">
</td></tr>
</table>

</form>



<?include $nsTemplate->Inc("inc/footer");?>