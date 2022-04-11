<?if (isset($InCampArr)&&is_array($InCampArr)) {?>



<table class=ListTable>

<?for ($i=0;$i<count($InCampArr);$i++) {
	$Row=$InCampArr[$i];?>



	<tr>
	<td class=<?php echo $Row->_STYLE?>>
	<table width=100% cellpadding=0 cellspacing=0 border=0><tr>


	<td width=100%>
	<a href="<?php echo $Row->_STAT_LINK?>">
	<B><span style="font-size:10px;color:999999">(<?php echo $Row->_TYPE?>)</span> <?php echo $Row->NAME?></B>
	<?if ($Row->DESCRIPTION) {?>
	<br>
	<span class="ListDescr"><?php echo $Row->DESCRIPTION?></span>
	<?}?>

	<?if (ValidId($Row->SUB_CAMP)) {?>
		<br>

		<?if ($nsUser->Columns->ROI) {?>
		<?php echo $Lang['ROI']?>: <span class="<?php echo ($Row->Report->GoodROI($Row->CampStat['ROI'])) ? 'GoodROI' : 'BadROI'?>">
		<?php echo $Row->CampStat['ROI']?>%</span>,
		<?}?>

		<?if ($nsUser->Columns->CONVERSIONS) {?>
		<?php echo $Lang['ActionsConv']?>: <?php echo $Row->CampStat['ActionConv']?>%,
		<?php echo $Lang['SalesConv']?>: <?php echo $Row->CampStat['SaleConv']?>%
		<?}?>
	<?}?>

	<?if (ValidId($Row->SPLIT_TEST)) {?>
		<br>
		<?if ($nsUser->Columns->CLICKS) {?>
		<?php echo $Lang['Clicks']?>: <?php echo $Row->SplitStat['UniClick']?>,
		<?}?>

		<?if ($nsUser->Columns->CONVERSIONS) {?>
		<?php echo $Lang['ActionsConv']?>: <?php echo $Row->SplitStat['ActionConv']?>%,
		<?php echo $Lang['SalesConv']?>: <?php echo $Row->SplitStat['SaleConv']?>%
		<?}?>
	<?}?>
	</a>
	</td>


	<td class=ListRowLeft>
	<?php
    $nsButtons->PostName = true;
    $nsButtons->Add('icon_link.gif', $Lang['CodeGen'], $Row->_CODELINK);
    $nsButtons->Add('edit.gif', $Lang['Edit'], $Row->_EDITLINK);
    $nsButtons->Add('delete.gif', $Lang['Delete'], $Row->_DELETELINK, $Lang['YouSure']);
    $nsButtons->Dump();
    ?>
	</td>
	</tr></table>

	</td></tr>


<?}?>
</table>

<?}?>

<?if (ValidArr($PathArr)&&count($PathArr)>1) {
	include $nsTemplate->Inc("inc/grp_path");
}?>