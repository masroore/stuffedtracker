<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>

<br>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">

<?if (count($UserReports)>0) {?>
<span style="color:#77B60B; font-size:12px;font-weight:bold;"><?php echo $Lang['MyReports']?></span>

<table class=ListTable>

<?for ($i=0;$i<count($UserReports);$i++) {
	$Row=$UserReports[$i];?>
	<tr>
	<td class=<?php echo $Row->_STYLE?>>

	<table width=100% cellpadding=0 cellspacing=0 border=0><tr>
	<td width=100%>
	<a href="<?php echo getURL($Row->Addr, 'CpId=' . $Row->CP_ID . '&ConstId=' . $Row->ID, 'report')?>">
	<B><span style="font-size:10px;color:999999">(<?php echo $Row->CONST_TYPE?>)</span>
	<?php echo $Row->NAME?></B>
	<?if ($nsUser->ADMIN) {?>
	 (<?php echo $Row->COMP_NAME?>)
	<?}?>
	</a>

	</td>
	<td width=200 nowrap>
	<?php
    $nsButtons->Add('delete.gif', $Lang['DeleteFromMy'], getURL('my_tracker', 'Mode=reports&MyDeleteId=' . $Row->ID));
    $nsButtons->Dump();
    ?>
	</td>
	</tr></table>

	</td>
	</tr>


<?}?>
</table>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="40" BORDER="0" ALT="">

<?}?>

<?if (count($WatchVis)>0) {?>
<span style="color:#77B60B; font-size:12px;font-weight:bold;"><?php echo $Lang['MyVisitors']?></span>

<table class=ListTable>

<?for ($i=0;$i<count($WatchVis);$i++) {
	$Row=$WatchVis[$i];?>

	<tr>
	<td class=<?php echo $Row->_STYLE?>>
	<table width=100% cellpadding=0 cellspacing=0 border=0><tr>
	<td width=100%>


	<B>
	<a href="<?php echo getURL('visitor', 'ViewId=' . $Row->ID . '&CpId=' . $Row->COMPANY_ID, 'admin')?>" title="<?php echo $Lang['VisitorInfo']?>">
	<?if ($Row->NAME) {?>
	<?php echo stripslashes($Row->NAME); ?>
	<?}
	else {?>
	<?php echo $Lang['Visitor']?> <?php echo $Row->ID?> / <?php echo $Row->LAST_IP?>
	<?}?>
	</a>
	</B>
	<?if ($Row->DESCRIPTION) {?>
	<br><span class=ListDescr><?php echo stripslashes($Row->DESCRIPTION)?></span>
	<?}?>
	<?if ($Row->LAST_STAMP) {?>
	<br>
	<span style="font-size:9px;"><?php echo $Lang['LastVisit']?>: <?php echo date('Y-m-d H:i', $Row->LAST_STAMP)?>
	&nbsp;
	(<?php echo (($Row->DATE_DIFF == 1 || $Row->DATE_DIFF === '0') ? '<B>' : '')?><a href="<?php echo getURL('visitor_path', 'VisId=' . $Row->ID . '&CpId=' . $Row->COMPANY_ID . "&AllClients=$AllClients&ViewDate=" . date('Y-m-d', $Row->LAST_STAMP), 'report')?>" title="<?php echo $Lang['ShowPaths']?>"><?php echo $Row->DATE_DIFF_NAME?></a></B>)</span>
	<?}?>

	<td  width=200 nowrap>
	<?php
    $nsButtons->Add('delete.gif', $Lang['DeleteFromMy'], getURL('my_tracker', 'Mode=visitors&MyDeleteId=' . $Row->ID));
    $nsButtons->Dump();
    ?>
	</td>
	</tr></table>

	</td></tr>
<?}?>

</table>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="40" BORDER="0" ALT="">



<?}?>











<?if (count($WatchVisGrp)>0) {?>
<span style="color:#77B60B; font-size:12px;font-weight:bold;"><?php echo $Lang['MyVisitorGrps']?></span>

<table class=ListTable>

<?for ($i=0;$i<count($WatchVisGrp);$i++) {
	$Row=$WatchVisGrp[$i];?>

	<tr>
	<td class=<?php echo $Row->_STYLE?>>
	<table width=100% cellpadding=0 cellspacing=0 border=0><tr>
	<td width=100%>


	<a href="<?php echo getURL('visitor_grp', 'ViewId=' . $Row->ID . '&CpId=' . $Row->COMPANY_ID, 'admin')?>" title="<?php echo $Lang['GrpInfo']?>">
	<B>
	<?php echo stripslashes($Row->NAME); ?>
	</B></a>
	<?if ($Row->DESCRIPTION) {?>
	<br><span class=ListDescr><?php echo stripslashes($Row->DESCRIPTION)?></span>
	<?}?>
	<?if ($Row->LAST_STAMP) {?>
	<br>
	<span style="font-size:9px;"><?php echo $Lang['LastVisit']?>: <?php echo date('Y-m-d H:i', $Row->LAST_STAMP)?>
	&nbsp;
	(<?php echo (($Row->DATE_DIFF == 1 || $Row->DATE_DIFF === '0') ? '<B>' : '')?><a href="<?php echo getURL('visitor_path', 'GrpId=' . $Row->ID . '&CpId=' . $Row->COMPANY_ID . "&AllClients=$AllClients&ViewDate=" . date('Y-m-d', $Row->LAST_STAMP), 'report')?>" title="<?php echo $Lang['ShowPaths']?>"><?php echo $Row->DATE_DIFF_NAME?></a></B>)</span>
	<?}?>

	<td   width=200 nowrap>
	<?php
    $nsButtons->Add('delete.gif', $Lang['DeleteFromMy'], getURL('my_tracker', 'Mode=visitor_grps&MyDeleteId=' . $Row->ID));
    $nsButtons->Dump();
    ?>
	</td>
	</tr></table>

	</td></tr>
<?}?>

</table>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="40" BORDER="0" ALT="">


<?}?>






<?if (count($WatchActions)>0) {?>

<span style="color:#77B60B; font-size:12px;font-weight:bold;"><?php echo $Lang['MyActions']?></span>

<table class=ListTable>

<?for ($i=0;$i<count($WatchActions);$i++) {
	$Row=$WatchActions[$i];?>

	<tr>
	<td class=<?php echo $Row->_STYLE?>>
	<table width=100% cellpadding=0 cellspacing=0 border=0><tr>
	<td width=100%>


	<?if ($Row->LAST_STAMP) {?>
	<a href="<?php echo getURL('natural_constructor', 'CpId=' . $Row->COMPANY_ID . '&ViewDate=' . date('Y-m-d', $Row->LAST_STAMP) . '&WhereArr[0][Mode]=Action&WhereArr[0][Id]=' . $Row->ID . '&WhereArr[0][OrderBy]=CNT&WhereArr[0][OrderTo]=DESC&GroupBy=Vis&ShowAll=1', 'report')?>" title="<?php echo $Lang['ShowConst']?>">
	<?}?>
	<B><span style="font-size:10px;color:999999"><?php echo $Row->HOST?></span>&nbsp;
	<?php echo $Row->NAME?></B>
	<?if ($Row->LAST_STAMP) {?>
	<br>
	<span style="font-size:9px;"><?php echo $Lang['LastTimeUsed']?>: <?php echo date('Y-m-d H:i', $Row->LAST_STAMP)?>
	&nbsp;
	(<?php echo (($Row->DATE_DIFF == 1 || $Row->DATE_DIFF === '0') ? '<B>' : '')?><?php echo $Row->DATE_DIFF_NAME?></B>)</span></a>
	<?}?>

	<td  width=200 nowrap>
	<?php
    $nsButtons->Add('delete.gif', $Lang['DeleteFromMy'], getURL('my_tracker', 'Mode=actions&MyDeleteId=' . $Row->ID));
    $nsButtons->Dump();
    ?>
	</td></tr></table>

	</td></tr>
<?}?>

</table>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="40" BORDER="0" ALT="">


<?}?>




<?if (count($WatchActionItems)>0) {?>
<span style="color:#77B60B; font-size:12px;font-weight:bold;"><?php echo $Lang['MyActionItems']?></span>

<table class=ListTable>

<?for ($i=0;$i<count($WatchActionItems);$i++) {
	$Row=$WatchActionItems[$i];?>

	<tr>
	<td class=<?php echo $Row->_STYLE?>>
	<table width=100% cellpadding=0 cellspacing=0 border=0><tr>
	<td width=100%>



	<?if ($Row->LAST_STAMP) {?>
	<a href="<?php echo getURL('natural_constructor', 'CpId=' . $Row->COMPANY_ID . '&ViewDate=' . date('Y-m-d', $Row->LAST_STAMP) . '&WhereArr[0][Mode]=ActionItem&WhereArr[0][Id]=' . $Row->ID . '&WhereArr[0][OrderBy]=CNT&WhereArr[0][OrderTo]=DESC&GroupBy=Vis&ShowAll=1', 'report')?>" title="<?php echo $Lang['ShowConst']?>">
	<?}?>
	<B><?php echo $Row->NAME?></B>
	<?if ($Row->LAST_STAMP) {?>
	<br>
	<span style="font-size:9px;"><?php echo $Lang['LastTimeUsed']?>: <?php echo date('Y-m-d H:i', $Row->LAST_STAMP)?>
	&nbsp;
	(<?php echo (($Row->DATE_DIFF == 1 || $Row->DATE_DIFF === '0') ? '<B>' : '')?><?php echo $Row->DATE_DIFF_NAME?></B>)</span></a>
	<?}?>

	<td width=200 nowrap>
	<?php
    $nsButtons->Add('delete.gif', $Lang['DeleteFromMy'], getURL('my_tracker', 'Mode=action_items&MyDeleteId=' . $Row->ID));
    $nsButtons->Dump();
    ?>
	</td></tr></table>

	</td></tr>
<?}?>

</table>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="40" BORDER="0" ALT="">

<?}?>




<?if (count($WatchSaleItems)>0) {?>
<span style="color:#77B60B; font-size:12px;font-weight:bold;"><?php echo $Lang['MySaleItems']?></span>

<table class=ListTable>

<?for ($i=0;$i<count($WatchSaleItems);$i++) {
	$Row=$WatchSaleItems[$i];?>

	<tr>
	<td class=<?php echo $Row->_STYLE?>>
	<table width=100% cellpadding=0 cellspacing=0 border=0><tr>
	<td width=100%>


	<?if ($Row->LAST_STAMP) {?>
	<a href="<?php echo getURL('natural_constructor', 'CpId=' . $Row->COMPANY_ID . '&ViewDate=' . date('Y-m-d', $Row->LAST_STAMP) . '&WhereArr[0][Mode]=Sale&WhereArr[0][Id]=' . $Row->ID . '&WhereArr[0][OrderBy]=CNT&WhereArr[0][OrderTo]=DESC&GroupBy=Vis&ShowAll=1', 'report')?>" title="<?php echo $Lang['ShowConst']?>">
	<?}?>
	<B><?php echo $Row->NAME?></B>
	<?if ($Row->LAST_STAMP) {?>
	<br>
	<span style="font-size:9px;"><?php echo $Lang['LastTimeUsed']?>: <?php echo date('Y-m-d H:i', $Row->LAST_STAMP)?>
	&nbsp;
	(<?php echo (($Row->DATE_DIFF == 1 || $Row->DATE_DIFF === '0') ? '<B>' : '')?><?php echo $Row->DATE_DIFF_NAME?></B>)</span></a>
	<?}?>

	<td width=200 nowrap>
	<?php
    $nsButtons->Add('delete.gif', $Lang['DeleteFromMy'], getURL('my_tracker', 'Mode=sale_items&MyDeleteId=' . $Row->ID));
    $nsButtons->Dump();
    ?>
	</td></tr></table>


	</td></tr>
<?}?>

</table>

<?}?>

<?include $nsTemplate->Inc("inc/footer");?>