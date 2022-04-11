<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>





<?PostFORM();?>
<input type="hidden" name="EditId" value="<?php echo $EditId?>">
<input type="hidden" name="ParentId" value="<?php echo $ParentId?>">


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
<input type=text  name="EditArr[Name]" value="<?php echo $EditArr['Name']?>">
</td></tr>


<tr><td class=FormLeftTd>
<?php echo $Lang['Descr']?>
<?FormError("Descr")?>
</td><td class=FormRightTd>
<textarea rows=6 name="EditArr[Descr]"><?php echo $EditArr['Descr']?></textarea>
</td></tr>

<?if ($SelectComp==true) {?>
<tr><td class=FormLeftTd>
<?php echo $Lang['Company']?>
<?FormError("Company")?>
</td><td class=FormRightTd>
<?GenSelect($CompArr, "EditArr[Company]", $EditArr['Company']);?>
</td></tr>
<?}?>

<?if(ValidId($EditId)&&$nsUser->ADMIN){?>
<tr><td class=FormLeftTd>
<?php echo $Lang['ShowOn1stPage']?>
</td><td class=FormRightTd>
<input type=checkbox name="EditArr[Watch]" value=1 <?php echo (($EditArr['Watch'] == 1) ? 'checked' : '')?>>
</td></tr>
<?}?>

</table>

<table class=SubmitTable>
<tr><td class=SubmitLeftTd>
</td><td class=SubmitRightTd>
<input type=submit value="<?php echo $Lang['Save']?>">
</td></tr>
</table>

</form>




<?include $nsTemplate->Inc("inc/footer");?>