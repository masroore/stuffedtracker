<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>


<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><td width=50% valign=top>



<?PostFORM();?>
<input type="hidden" name="HostId" value="<?php echo $HostId?>">
<input type="hidden" name="EditId" value="<?php echo $EditId?>">


<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $TableCaption?>
</td></tr>
</table>



<table  class=FormTable>

<tr><td class=FormLeftTd>
<?php echo $Lang['Host']?>
<?FormError("Host")?>
</td><td class=FormRightTd>
<input type=text name="EditArr[Host]" value="<?php echo $EditArr['Host']?>" style="width:100%;">
</td></tr>


<tr><td class=FormLeftTd>
<?php echo $Lang['BoundHosts']?>
</td><td class=FormRightTd>
<input type=checkbox name="EditArr[UseHosts]" value=1 <?php echo (($EditArr['UseHosts'] == 1) ? 'checked' : '')?>>
</td></tr>


<?if(ValidId($EditId)&&$nsUser->ADMIN){?>
<tr><td class=FormLeftTd>
<?php echo $Lang['StShow1stPage']?>
</td><td class=FormRightTd>
<input type=checkbox name="EditArr[Watch]" value=1 <?php echo (($EditArr['Watch'] == 1) ? 'checked' : '')?>>
</td></tr>
<?}?>

<tr><td class=FormLeftTd>
<?php echo $Lang['CookieDomain']?>
</td><td class=FormRightTd>
<input type=text name="EditArr[CookieDomain]" value="<?php echo $EditArr['CookieDomain']?>" style="width:100%;">
</td></tr>


</table>

<table class=SubmitTable>
<tr><td class=SubmitLeftTd>
</td><td class=SubmitRightTd>
<input type=submit value="<?php echo $Lang['Save']?>">
</td></tr>
</table>

</form>


<?if ($EditArr['UseHosts']==1) {?>


	<table class=CaptionTable>
	<tr><td class=CaptionTd>
	<?php echo $Lang['HostsList']?>
	</td></tr>
	</table>

	<?PostFORM();?>
	<input type=hidden name="EditId" value="<?php echo $EditId?>">
	<input type="hidden" name="HostId" value="<?php echo $HostId?>">

	<table cellpadding=2 cellspacing=0 border=0>
	<?for($j=0;$j<count($EditHost->Hosts);$j++) {?>
	<tr><td style="padding-left:20px;">
	<input type=hidden name="Enable[<?php echo $EditHost->Hosts[$j]->ID?>]" value="0">
	<input type=checkbox name="Enable[<?php echo $EditHost->Hosts[$j]->ID?>]" value=1 <?php echo (($EditHost->Hosts[$j]->ENABLED) ? 'checked' : '')?>>
	</td><td>
	<span style="font-size:10px;">
	<B><?php echo $EditHost->Hosts[$j]->HOST?></B>
	&nbsp;<a href="<?php echo getURL('company', "EditId=$EditId&HostId=$HostId&DelSiteHost=" . $EditHost->Hosts[$j]->ID)?>" onclick="return confirm('<?php echo $Lang['YouSure']?>');"><IMG SRC="<?php echo FileLink('images/icon_delete.gif'); ?>" WIDTH="11" HEIGHT="11" BORDER="0" title="<?php echo $Lang['Delete']?>"></a>

	</td></tr>
	<?}?>
	</table>

	<table cellpadding=2 cellspacing=0 border=0>
	<tr><td style="padding-left:20px;font-size:10px;">
	<img src="<?php echo FileLink('images/arrow_04.gif'); ?>" width=17 height=13 border=0 alt="" hspace=2>
	<?php echo $Lang['BoundHosts']?>
	</td></tr>
	<tr><td style="padding-left:20px;"><span style="font-size:10px;"><BR><?php echo $Lang['NewHost']?><BR>
	<input type=text name=NewHost size=30 value="">&nbsp;<input type=submit value="<?php echo $Lang['Save']?>">
	</td></tr>
	</table>

	</form>

<?}?>

</td>
<td><p><IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="10" HEIGHT="1" BORDER="0" ALT=""></p></td>
<td width=50% valign=top>


<?if (isset($PagesArr)&&is_array($PagesArr)) {?>
<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $Lang['PagesList']?>
</td></tr>
</table>
<div class=ListDiv2>




<table bgcolor="ffffff" width=100% cellpadding=3 cellspacing=0 border=0>





<tr><td colspan=2 style="border-bottom-color:#E1E1E1;	border-bottom-width:1px;	border-bottom-style:solid;padding-bottom:5px;">
<?GetFORM();?>
<input type=hidden name=HostId value=<?php echo $HostId?>>
<input type=hidden name=EditId value=<?php echo $EditId?>>
<?php echo $Lang['Template']?>: <input type=text name="Templ" value="<?php echo ((ValidVar($Templ)) ? $Templ : '')?>">&nbsp;<input type=submit value="<?php echo $Lang['Search']?>">
</form>
</td></tr>

<tr><td colspan=2>
<?php echo $Pages->Dump(); ?>
</td></tr>

<?for ($i=0;$i<count($PagesArr);$i++) {
	$Row=$PagesArr[$i];?>

	<tr><td><IMG SRC="<?php echo FileLink('images/icon_doc.gif'); ?>" WIDTH="12" HEIGHT="9" BORDER="0" ALT=""><IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="5" HEIGHT="1" BORDER="0" ALT=""></td><td width=100%>
	<a href="<?php echo getURL('company', 'EditPage=' . $Row->ID)?>">
	<?php echo $Row->PATH?> - <?php echo $Row->NAME?>
	</a>
	<a href="<?php echo getURL('actions', "Mode=new&EditId=new&SiteId=$HostId&CpId=$CpId&PageId=" . $Row->ID, 'admin')?>" title="<?php echo $Lang['CreateAction']?>"><IMG SRC="<?php echo FileLink('images/small_icon_actions-a.gif'); ?>" WIDTH="4" HEIGHT="8" BORDER="0" ALT=""></a>

	</td></tr>

<?}?>

<tr><td colspan=2>
<?php echo $Pages->Dump(); ?>
</td></tr>
</table>






</div>
<?}?>

</td></tr></table>


<?include $nsTemplate->Inc("inc/footer");?>