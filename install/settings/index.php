
<SCRIPT LANGUAGE="JavaScript">
<!--

function GoToUpdate()
{
	oForm=GetObj("InstallForm");
	oForm.action="update.php";
	oForm.submit();
}

//-->
</SCRIPT>

<table  class=FormTable>

<tr><td class=FormLeftTd>
<?php echo $Lang['Host']?> *
</td><td class=FormRightTd>
<input type=text  name="DbHost" value="<?php echo $DbHost?>">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['Port']?>
</td><td class=FormRightTd>
<input type=text  name="DbPort" value="<?php echo $DbPort?>">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['Db']?> *
</td><td class=FormRightTd>
<input type=text  name="DbName" value="<?php echo $DbName?>">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['DbUsername']?>
</td><td class=FormRightTd>
<input type=text  name="DbUser" value="<?php echo $DbUser?>">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['DbPass']?>
</td><td class=FormRightTd>
<input type=text  name="DbPass" value="<?php echo $DbPass?>">
</td></tr>

<tr><td colspan=2></td></tr>


<tr><td class=FormLeftTd>
<?php echo $Lang['TablePfx']?> *
</td><td class=FormRightTd>
<input type=text  name="DbPref" value="<?php echo $DbPref?>">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['UseModR-2']?>
</td><td class=FormRightTd>
<input type=checkbox  name="UseModR" <?php echo (($DisableModR) ? 'disabled' : '')?> value="1" <?php echo (($UseModR) ? 'checked' : '')?>>
</td></tr>

<tr><td colspan=2></td></tr>


<tr><td class=FormLeftTd>
<?php echo $Lang['SendUseInfo-2']?>
</td><td class=FormRightTd>
<input type=checkbox  name="SendUsage" value="1" <?php echo (($SendUsage) ? 'checked' : '')?>>
</td></tr>


<?if ($UpdateNeeded) {?>
<tr><td class=FormLeftTd>

</td><td class=FormRightTd>
<input type=button value="<?php echo $Lang['RepairConf']?>" onclick="GoToUpdate();">
</td></tr>

<?}?>
</table>
