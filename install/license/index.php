<SCRIPT LANGUAGE="JavaScript">
<!--

function BtnForw(oCheck)
{
	oBtn=GetObj("StepForw");
	if (oCheck.checked==true) oBtn.disabled=false;
	else oBtn.disabled=true;
}

//-->
</SCRIPT>



<table  class=FormTable>

<tr><td class=FormLeftTd>
<B><?php echo $Lang['LicenseText']?>:</B>
</td><td class=FormRightTd>



<textarea rows=20 style="width:100%" readonly>
<?include $CLang.".license.php"?>

</textarea>


</td></tr>


<tr><td class=FormLeftTd>
<label for="IAgree">&nbsp;<?php echo $Lang['IAgree']?></label>
</td><td class=FormRightTd>
<input type=checkbox value=1 name="IAgree" id="IAgree" <?php echo (($IAgree == 1) ? 'checked' : '')?> onchange="BtnForw(this);" onclick="BtnForw(this);">
</td></tr>


</table>
