<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>

<script type=javascript>

var ActionsArr = new Array;
var ActionIds = new Array();
<?for ($i=0;$i<count($ActionsArr);$i++) {?>
	echo "ActionsArr[$i]='".$ActionsArr[$i]->NAME."';\n";
	echo "ActionsIds[$i]='".$ActionsArr[$i]->ID."';\n";
<?}?>

</script>

<div class=FormDiv>
<table width=100% >
<tr><td class=FormHeader>
<?GetFORM();?>
<input type=hidden name="CpId" value="<?php echo $CpId?>">
<input type=hidden name="FormClicked" value="1">

<table cellpadding=0 cellspacing=0 border=0><tr>


<?if (count($SitesArr)>1) {?>
<td>
<B style="color:#000000"><?php echo $Lang['ChooseSite']?></B>:&nbsp;
<select name=SiteId>
<option></option>
<?for ($i=0;$i<count($SitesArr);$i++) {?>
	<option value=<?php echo $SitesArr[$i]->ID?> <?php echo (($SitesArr[$i]->ID == $SiteId) ? 'selected' : '')?>><?php echo $SitesArr[$i]->HOST?></option>
<?}?>
</select>
&nbsp;
</td>
<?}?>

<td>
<select name="CodeType">
<option value=1 <?php echo (($CodeType == 1) ? 'selected' : '')?>><?php echo $Lang['CodeType1']?></option>
<option value=3 <?php echo (($CodeType == 3) ? 'selected' : '')?>><?php echo $Lang['CodeType3']?></option>
<?if ($nsProduct->LICENSE!=3 || $AllowPhp) {?>
<option value=4 <?php echo (($CodeType == 4) ? 'selected' : '')?>><?php echo $Lang['CodeType4']?></option>
<?}?>
</select>
&nbsp;
</td><td>
<select name="CodePlace">
<option value=1 <?php echo (($CodePlace == 1) ? 'selected' : '')?>><?php echo $Lang['ForSite']?></option>
<option value=2 <?php echo (($CodePlace == 2) ? 'selected' : '')?>><?php echo $Lang['ForShop']?></option>
<option value=3 <?php echo (($CodePlace == 3) ? 'selected' : '')?>><?php echo $Lang['ForAction']?></option>
</select>
</td>
<?if (count($ActionsArr)>0&&$CodePlace==3) {?>
<td>&nbsp;
<select name="ActionId">
<?for ($i=0;$i<count($ActionsArr);$i++) {?>
	<option value=<?php echo $ActionsArr[$i]->ID?> <?php echo (($ActionsArr[$i]->ID == $ActionId) ? 'selected' : '')?>><?php echo $ActionsArr[$i]->NAME?></option>
<?}?>
</select>
<?}?>
<td>&nbsp;<input type=submit value="<?php echo $Lang['Refresh']?>"></td>
</tr></table>
</form>
</td></tr></table>
</div>

<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">


<div style="border-width:1px;border-style:solid;border-color:#C7C7C7;padding:10px;">

<span style="color:#000000">
<?php echo $TopCodeHelp?>
</span>
<br><IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">

<textarea rows=9 style="width:100%;font-family:Courier;font-size:14px;border-width:1px; border-style:solid;border-color:#C7C7C7;padding:4px;background:#E5E5E5;color:#000000;" readonly onclick="this.select();">
<?php echo $ResultCode?>
</textarea>

<?if (ValidVar($CodeComment)) {?>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT=""><br><span style="color:#000000">
<?php echo $CodeComment?>
<?}?>
</span><br><IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">
</div>


<?include $nsTemplate->Inc("inc/footer");?>