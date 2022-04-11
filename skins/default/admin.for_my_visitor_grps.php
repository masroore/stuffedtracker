<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>



<?if ($nsUser->ADMIN&&ValidArr($CompArr)&&count($CompArr)>1) {?>
	<div class=FormDiv>
	<?GetFORM("visitor_grp", "EditId=new", "admin");?>
	<table width=100%>
	<tr><td class=FormHeader>
	<select name=CpId>
	<?for ($i=0;$i<Count($CompArr);$i++) {?>
	<option value=<?php echo $CompArr[$i]->ID?> <?php echo (($CompArr[$i]->ID == $SelectCpId) ? 'selected' : '')?>><?php echo $CompArr[$i]->NAME?></option>
	<?}?>
	</select>&nbsp;<input type=submit value="<?php echo $Lang['AddNewGrp']?>">
	</td></tr></table>
	</form>
	</div><IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">
<?}?>



<table class=ListTable>


<?if ($nsUser->MERCHANT) {?>
		<tr><td colspan=3 class=ListRowRight >
		 <a href="<?php echo getURL('visitor_grp', 'EditId=new&CpId=' . $nsUser->COMPANY_ID)?>">
		<span style="color:#77B60B; font-size:12px;font-weight:bold;"><?php echo $Lang['AddNewGrp']?></span>
		</a>
		</td></tr>
<?}?>

<?if (count($VisitorsList)>0) {?>


<?PostFORM();?>
	<input type=hidden name="Mode" value="visitor_grps">


<?for ($i=0;$i<count($VisitorsList);$i++) {
	$Row=$VisitorsList[$i];?>

	<?if ($Row->NewComp&&$nsUser->ADMIN) {?>
		<tr><td colspan=3 class=ListRowRight >
		<span class=MyTrackerHeader><?php echo $Row->COMP_NAME?></span>

		<!-- &nbsp;&nbsp;(<a href="<?php echo getURL('visitor_grp', 'EditId=new&CpId=' . $Row->COMPANY_ID)?>">
		<span style="color:#77B60B; font-size:12px;font-weight:bold;"><?php echo $Lang['AddNewGrp']?></span>
		</a>)-->

		</td></tr>
	<?}?>

	<tr>
	<td class=<?php echo $Row->_STYLE?>>
	<table width=100% cellpadding=0 cellspacing=0 border=0>
	<tr>

	<td width=25 nowrap>
	<?if (!ValidId($Row->WATCH_ID)) {?>
		<input type=checkbox value=1 name="AddToMy[<?php echo $Row->ID?>]">
	<?}?>
	</td>


	<td width=100%>
	<B style="color:#000000"><?php echo $Row->NAME?></B>
	<?if ($Row->DESCRIPTION) {?>
	<br><span class=ListDescr><?php echo stripslashes($Row->DESCRIPTION)?></span>
	<?}?>
	</a>
	</td>

	<td>
	<?php
    $nsButtons->Add('edit.gif', $Lang['Info'], getURL('visitor_grp', 'ViewId=' . $Row->ID . '&CpId=' . $Row->COMPANY_ID));
    $nsButtons->Add('delete.gif', $Lang['Delete'], getURL('my_tracker', 'Mode=visitor_grps&DeleteId=' . $Row->ID), $Lang['YouSure']);
    $nsButtons->Dump();
    ?>
	</td>
	</tr></table>

	</td></tr>

<?}?>


<?if (!$NoAdd) {?>
<tr><td class=ReportSimpleTd2 colspan=3>
<input type=submit value="<?php echo $Lang['AddChoosedToMy2']?>">
</td></tr>
<?}?>
</form>



<?}
else include $nsTemplate->Inc("inc/no_records");?>

</table>

<?include $nsTemplate->Inc("inc/footer");?>