<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>

<?if (isset($InCampArr)&&is_array($InCampArr)) {?>



<table class=ListTable>

<?for ($i=0;$i<count($InCampArr);$i++) {
	$Row=$InCampArr[$i];?>
	<tr>
	<td class=<?php echo $Row->_STYLE?>>
	<table width=100% cellpadding=0 cellspacing=0 border=0><tr>

	<td width=100%>
	<a href="<?php echo $Row->_STAT_LINK?>">
	<B style="color:#000000"><?php echo $Row->NAME?></B>

	<?if ($Row->DESCRIPTION) {?><br>	<span class="ListDescr"><?php echo $Row->DESCRIPTION?></span><?}?>

	<br>
	<?if ($nsUser->Columns->CLICKS) {?>
	<?php echo $Lang['Hits']?>: <?php echo $Row->SplitStat['CntClick']?>,
	<?php echo $Lang['UniVisitors']?>: <?php echo $Row->SplitStat['UniClick']?>,
	<?}?>
	<?if ($nsUser->Columns->CONVERSIONS) {?>
	<?php echo $Lang['ActionsConv']?>: <?php echo $Row->SplitStat['ActionConv']?>%,
	<?php echo $Lang['SalesConv']?>: <?php echo $Row->SplitStat['SaleConv']?>%
	<?}?>
	</a>
	</td>

	<td class=ListRowLeft>
	<?php
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

<?include $nsTemplate->Inc("inc/footer");?>