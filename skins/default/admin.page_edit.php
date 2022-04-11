<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>



<?PostFORM();?>
<input type="hidden" name="HostId" value="<?php echo $HostId?>">
<input type="hidden" name="EditPage" value="<?php echo $EditPage?>">


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
<input type=text name="EditArr[Name]" value="<?php echo $EditArr['Name']?>">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['Path']?>
<?FormError("Path")?>
</td><td class=FormRightTd>
<input type=text name="EditArr[Path]" value="<?php echo $EditArr['Path']?>">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['PageIgnore']?>
</td><td class=FormRightTd>
<input type=checkbox name="EditArr[PageIgnore]" <?php echo (($EditArr['PageIgnore'] == 1) ? 'checked' : '')?> value="1">
</td></tr>



</table>

<table class=SubmitTable>
<tr><td class=SubmitLeftTd>
</td><td class=SubmitRightTd>
<input type=submit value="<?php echo $Lang['Save']?>">
</td></tr>
</table>

</form>



<?include $nsTemplate->Inc("inc/footer");?>