<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>

<div class=FormDiv>
<table width=100%>
<tr><td class=FormHeader <?php echo (($Pages) ? 'align=center' : '')?>>


<?if (!$Pages) {?>
<?GetFORM();?>

<?if ($FileExists) {?>
<input type=hidden name=DoImport value="1">
<input type=submit value="<?php echo $Lang['Import']?>">
&nbsp;<b style="color:#000000">(<?php echo $FileName?>, <?php echo FileSizeStr($FileSize)?><?if ($FileModified) {?>, <?php echo $Lang['LastModify']?>: <?php echo date('Y-m-d H:i:s', $FileModified)?><?}?>)</b>
&nbsp;<input type=text size=5 name=pp value=<?php echo $PerPage?>>&nbsp;<?php echo $Lang['RowsPerPage']?>
<?} else {?>
	<b style="color:#000000"><?php echo $FileName?>: <?php echo $Lang['FindFail']?></b>
<?}?>
<?} else {?>
	<span style="font-size:14px;color:#000000"><?php echo $Lang['Progress']?>: <b><?php echo $CurrentProgress?>%</b></span>
<?}?>

</form>


</td></tr></table>
</div>

<?if ($Pages) $Pages->Dump();?>

<?if (!$Pages) {?>
<div style="background:#ffffff;padding:14px;color:#000000"><?php echo $Lang['ImportComment']?></div>
<?}?>

<?include $nsTemplate->Inc("inc/footer");?>