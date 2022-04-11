<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>


<br>
<table  class=FormTable width=100%>
<?GetFORM();?>
<input type=hidden name=CpId value="<?php echo $CpId?>">

<tr>
<td height=20 width=34% style="padding-left:10px;padding-right:10px;">&nbsp;</td>
<td  height=20 width=33% style="padding-left:5px;" ><p class=ReportHeaderName><?php echo $Lang['KeepPaths']?></td>
<td  height=20 width=33% style="padding-left:5px;" ><p class=ReportHeaderName><?php echo $Lang['KeepNoRef']?></td>
</tr>

<tr><td colspan=3  height=2><p><IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="100%" HEIGHT="2" BORDER="0" ALT="" style="background:#E1E1E1"></p></td></tr>

<tr height=30>
<td height=20 width=34%  style="padding-left:10px;padding-right:10px;"><B>
<?if (!$CpId) echo $Lang['Global']?>
<?if ($CpId) echo $Lang['ForClient']?>

</B></td>
<td  height=20 width=33% style="padding-left:5px;" >
<select name="<?php echo $GlobName?>[KeepPath]">
<option value=1 <?php echo (($Glob->KEEP_VISITOR_PATH == 1) ? 'selected' : '')?>><?php echo $Lang['DoStore']?></option>
<option value=0 <?php echo (($Glob->KEEP_VISITOR_PATH == 0) ? 'selected' : '')?>><?php echo $Lang['DontStore']?></option>
<?if ($CpId&&$nsProduct->LICENSE==3) {?>
<option value=2 <?php echo (($Glob->KEEP_VISITOR_PATH == 2) ? 'selected' : '')?>><?php echo $Lang['Inherits']?>
<?if ($ST[0][0]->KEEP_VISITOR_PATH==1) echo $Lang['DoStore']?>
<?if ($ST[0][0]->KEEP_VISITOR_PATH==0) echo $Lang['DontStore']?>
</option>
<?}?>
</select>
</td>
<td  height=20 width=33% style="padding-left:5px;" >
<select name="<?php echo $GlobName?>[KeepNoRef]">
<option value=1 <?php echo (($Glob->KEEP_NO_REF == 1) ? 'selected' : '')?>><?php echo $Lang['DoStore']?></option>
<option value=0 <?php echo (($Glob->KEEP_NO_REF == 0) ? 'selected' : '')?>><?php echo $Lang['DontStore']?></option>
<?if ($CpId&&$nsProduct->LICENSE==3) {?>
<option value=2 <?php echo (($Glob->KEEP_NO_REF == 2) ? 'selected' : '')?>><?php echo $Lang['Inherits']?>
<?if ($ST[0][0]->KEEP_NO_REF==1) echo $Lang['DoStore']?>
<?if ($ST[0][0]->KEEP_NO_REF==0) echo $Lang['DontStore']?>
</option>
<?}?>
</select>
</td>
</tr>


<tr><td colspan=3  height=20><p><IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="20" BORDER="0"></p></td></tr>


<?for ($i=0;$i<count($ClientsArr);$i++) {
	$Cp=$ClientsArr[$i];?>

<?if (!$CpId) {?>
<tr><td colspan=3  height=2><p><IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="100%" HEIGHT="2" BORDER="0" ALT="" style="background:#E1E1E1"></p></td></tr>


<tr height=30>
<td height=20 width=34%  style="padding-left:10px;padding-right:10px;">
<span class=CaptionText><?php echo $Cp->NAME?></span>
</td>
<td  height=20 width=33% style="padding-left:5px;" >
<select name="SaveSet[<?php echo $Cp->ID?>][0][KeepPath]">
<option value=1 <?php echo (($ST[$Cp->ID][0]->KEEP_VISITOR_PATH == 1) ? 'selected' : '')?>><?php echo $Lang['DoStore']?></option>
<option value=0 <?php echo (($ST[$Cp->ID][0]->KEEP_VISITOR_PATH == 0) ? 'selected' : '')?>><?php echo $Lang['DontStore']?></option>
<option value=2 <?php echo (($ST[$Cp->ID][0]->KEEP_VISITOR_PATH == 2) ? 'selected' : '')?>><?php echo $Lang['Inherit']?></option>
</select>
</td>
<td  height=20 width=33% style="padding-left:5px;" >
<select name="SaveSet[<?php echo $Cp->ID?>][0][KeepNoRef]">
<option value=1 <?php echo (($ST[$Cp->ID][0]->KEEP_NO_REF == 1) ? 'selected' : '')?>><?php echo $Lang['DoStore']?></option>
<option value=0 <?php echo (($ST[$Cp->ID][0]->KEEP_NO_REF == 0) ? 'selected' : '')?>><?php echo $Lang['DontStore']?></option>
<option value=2 <?php echo (($ST[$Cp->ID][0]->KEEP_NO_REF == 2) ? 'selected' : '')?>><?php echo $Lang['Inherit']?></option>
</select>
</td>
</tr>
<?}?>



<?for ($j=0;$j<count($SitesArr[$Cp->ID]);$j++) {
	$Row=$SitesArr[$Cp->ID][$j];?>

<tr><td colspan=3  height=1><p><IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="100%" HEIGHT="1" BORDER="0" ALT="" style="background:#E1E1E1"></p></td></tr>


<tr height=30>
<td height=20 width=34%  style="padding-left:10px;padding-right:10px;"><?php echo $Row->HOST?></td>
<td  height=20 width=33% style="padding-left:5px;" >
<select name="SaveSet[<?php echo $Cp->ID?>][<?php echo $Row->ID?>][KeepPath]">
<option value=1 <?php echo (($ST[$Cp->ID][$Row->ID]->KEEP_VISITOR_PATH == 1) ? 'selected' : '')?>><?php echo $Lang['DoStore']?></option>
<option value=0 <?php echo (($ST[$Cp->ID][$Row->ID]->KEEP_VISITOR_PATH == 0) ? 'selected' : '')?>><?php echo $Lang['DontStore']?></option>
<option value=2 <?php echo (($ST[$Cp->ID][$Row->ID]->KEEP_VISITOR_PATH == 2) ? 'selected' : '')?>><?php echo $Lang['Inherit']?></option>
</select>
</td>
<td  height=20 width=33% style="padding-left:5px;" >
<select name="SaveSet[<?php echo $Cp->ID?>][<?php echo $Row->ID?>][KeepNoRef]">
<option value=1 <?php echo (($ST[$Cp->ID][$Row->ID]->KEEP_NO_REF == 1) ? 'selected' : '')?>><?php echo $Lang['DoStore']?></option>
<option value=0 <?php echo (($ST[$Cp->ID][$Row->ID]->KEEP_NO_REF == 0) ? 'selected' : '')?>><?php echo $Lang['DontStore']?></option>
<option value=2 <?php echo (($ST[$Cp->ID][$Row->ID]->KEEP_NO_REF == 2) ? 'selected' : '')?>><?php echo $Lang['Inherit']?></option>
</select>
</td>
</tr>


<?}?>
<tr><td colspan=3  height=20><p><IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="20" BORDER="0"></p></td></tr>
<?}?>


<tr><td colspan=3  height=20 style="padding-left:10px;">
<input type=submit value="<?php echo $Lang['Save']?>">
</td></tr>


</form>
</table>



<?include $nsTemplate->Inc("inc/footer");?>