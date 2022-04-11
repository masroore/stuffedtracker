<?include $nsTemplate->Inc("inc/header");?>




<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">



<?if (count($GrpList)>0) {?>


<table border="0" cellpadding="0" cellspacing="0" width=100%>
	<tr>
	<td width="100%" height="1" colspan="6" bgcolor="#E1E1E1">
	<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
	</td>


	</tr>
<tr bgcolor="#f5f5f5">
<td width=20% class=ReportSimpleTd ><B><?php echo $Lang['StatByGrp']?></B></td>
<?if($nsUser->Columns->CLICKS) {?>
	<td class="ReportHeaderTd2" colspan="2"  width=10%>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="2" width="100%" class="ReportHeaderTableTd">
		<p class="ReportHeaderName"><?php echo $Lang['RHeaderClick']?></p>
		</td></tr>
		<tr><td width="50%" class="ReportHeaderTableTd" ID="CntActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderTotal']?></p>
		</td><td width="50%" class="ReportHeaderTableTd" ID="UniActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderUni']?></p>
		</td></tr>
		</table>
	</td>
<?}?>
<?if($nsUser->Columns->ROI) {?>
	<td class="ReportHeaderTd2"   width=5% style="padding-left:6px;">
	<p class="ReportHeaderName"><?php echo $Lang['RHeaderROI']?></p>
	</td>
<?}?>
<?if($nsUser->Columns->CONVERSIONS) {?>
<td class="ReportHeaderTd2" colspan="2"  width=10%>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td colspan="2" width="100%" class="ReportHeaderTableTd">
	<p class="ReportHeaderName"><?php echo $Lang['RHeaderConversion']?></p>
	</td></tr>
	<tr><td width="50%" class="ReportHeaderTableTd" ID="ActionConvHead">
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderAction']?></p>
	</td><td width="50%" class="ReportHeaderTableTd" ID="SaleConvHead">
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderSale']?></p>
	</td></tr>
	</table>
</td>
<?}?>
</tr>

<tr>
<td width="100%" height="2" colspan="6" bgcolor="#E1E1E1">
<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="2" border="0"></p>
</td>
</tr>

<?foreach ($GrpList as $GrpId=>$Report) {?>
	<tr>

	<td class=ReportNameTd width=20%><p class=ReportColumn><B><a href="<?php echo getURL('paid_constructor', "GrpId=$GrpId", 'report')?>" title="<?php echo $Lang['Stat']?>"><?php echo $Report->Name?></a></B>
	<?if (ValidVar($Report->ClientName)) {?><br><span class=ListDescr><?php echo $Report->ClientName?></span><?}?>
	</td>

	<?if($nsUser->Columns->CLICKS) {?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $Report->CampStat['CntClick']?></td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->CampStat['UniClick']?></td>
	<?}?>

	<?if($nsUser->Columns->ROI) {?>
	<td class=ReportSimpleTd><p class=ReportColumn>
	<span class="<?php echo ($Report->GoodROI($Report->CampStat['ROI'])) ? 'GoodROI' : 'BadROI'?>">
	<?php echo $Report->CampStat['ROI']?>%</span></td>
	<?}?>

	<?if($nsUser->Columns->CONVERSIONS) {?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $Report->CampStat['ActionConv']?>%</td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->CampStat['SaleConv']?>%</td>
	<?}?>

	</tr>
	<tr>
	<td width="100%" height="1" colspan="6" bgcolor="#E1E1E1">
	<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
	</td>


	</tr>
<?}?>
</table>
<?}?>


<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="20" BORDER="0" ALT="">






<?if (count($CampList)>0) {?>


<table border="0" cellpadding="0" cellspacing="0" width=100%>
	<tr>
	<td width="100%" height="1" colspan="6" bgcolor="#E1E1E1">
	<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
	</td>


	</tr>
<tr bgcolor="#f5f5f5">
<td width=20% class=ReportSimpleTd ><B><?php echo $Lang['StatByCamp']?></B></td>
<?if($nsUser->Columns->CLICKS) {?>
	<td class="ReportHeaderTd2" colspan="2"  width=10%>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="2" width="100%" class="ReportHeaderTableTd">
		<p class="ReportHeaderName"><?php echo $Lang['RHeaderClick']?></p>
		</td></tr>
		<tr><td width="50%" class="ReportHeaderTableTd" ID="CntActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderTotal']?></p>
		</td><td width="50%" class="ReportHeaderTableTd" ID="UniActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderUni']?></p>
		</td></tr>
		</table>
	</td>
<?}?>
<?if($nsUser->Columns->ROI) {?>
	<td class="ReportHeaderTd2"   width=5% style="padding-left:6px;">
	<p class="ReportHeaderName"><?php echo $Lang['RHeaderROI']?></p>
	</td>
<?}?>
<?if($nsUser->Columns->CONVERSIONS) {?>
<td class="ReportHeaderTd2" colspan="2"  width=10%>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td colspan="2" width="100%" class="ReportHeaderTableTd">
	<p class="ReportHeaderName"><?php echo $Lang['RHeaderConversion']?></p>
	</td></tr>
	<tr><td width="50%" class="ReportHeaderTableTd" ID="ActionConvHead">
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderAction']?></p>
	</td><td width="50%" class="ReportHeaderTableTd" ID="SaleConvHead">
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderSale']?></p>
	</td></tr>
	</table>
</td>
<?}?>
</tr>
<tr>
<td width="100%" height="2" colspan="6" bgcolor="#E1E1E1">
<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="2" border="0"></p>
</td>
</tr>

<?foreach ($CampList as $CampId=>$Report) {?>
	<tr>

	<td class=ReportNameTd width=20%><p class=ReportColumn><B><a href="<?php echo getURL('paid_constructor', "CampId=$CampId", 'report')?>" title="<?php echo $Lang['Stat']?>"><?php echo $Report->Name?></a></B>
	<?if (ValidVar($Report->ClientName)) {?><br><span class=ListDescr><?php echo $Report->ClientName?></span><?}?>
	</td>

	<?if($nsUser->Columns->CLICKS) {?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $Report->CampStat['CntClick']?></td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->CampStat['UniClick']?></td>
	<?}?>

	<?if($nsUser->Columns->ROI) {?>
	<td class=ReportSimpleTd><p class=ReportColumn>
	<span class="<?php echo ($Report->GoodROI($Report->CampStat['ROI'])) ? 'GoodROI' : 'BadROI'?>">
	<?php echo $Report->CampStat['ROI']?>%</span></td>
	<?}?>

	<?if($nsUser->Columns->CONVERSIONS) {?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $Report->CampStat['ActionConv']?>%</td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->CampStat['SaleConv']?>%</td>
	<?}?>

	</tr>
	<tr>
	<td width="100%" height="1" colspan="6" bgcolor="#E1E1E1">
	<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
	</td>


	</tr>


<?}?>
</table>
<?}?>





<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="20" BORDER="0" ALT="">





<?if (count($SplitList)>0) {?>
<table border="0" cellpadding="0" cellspacing="0" width=100%>
	<tr>
	<td width="100%" height="1" colspan="7" bgcolor="#E1E1E1">
	<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
	</td></tr>
<tr bgcolor="#f5f5f5">
<td width=20% class=ReportSimpleTd ><B><?php echo $Lang['StatBySplit']?></B></td>
<?if($nsUser->Columns->CLICKS) {?>
	<td class="ReportHeaderTd2" colspan="2"  width=10%>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="2" width="100%" class="ReportHeaderTableTd">
		<p class="ReportHeaderName"><?php echo $Lang['RHeaderClick']?></p>
		</td></tr>
		<tr><td width="50%" class="ReportHeaderTableTd" ID="CntActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderTotal']?></p>
		</td><td width="50%" class="ReportHeaderTableTd" ID="UniActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderUni']?></p>
		</td></tr>
		</table>
	</td>
<?}?>
<?if($nsUser->Columns->SALES) {?>
	<td class="ReportHeaderTd2"   width=5% style="padding-left:6px;">
	<p class="ReportHeaderName"><?php echo $Lang['RHeaderSale']?></p>
	</td>
<?}?>
<?if($nsUser->Columns->ACTIONS) {?>
	<td class="ReportHeaderTd2"   width=5% style="padding-left:6px;">
	<p class="ReportHeaderName"><?php echo $Lang['RHeaderAction']?></p>
	</td>
<?}?>
<?if($nsUser->Columns->CONVERSIONS) {?>
<td class="ReportHeaderTd2" colspan="2"  width=10%>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td colspan="2" width="100%" class="ReportHeaderTableTd">
	<p class="ReportHeaderName"><?php echo $Lang['RHeaderConversion']?></p>
	</td></tr>
	<tr><td width="50%" class="ReportHeaderTableTd" ID="ActionConvHead">
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderAction']?></p>
	</td><td width="50%" class="ReportHeaderTableTd" ID="SaleConvHead">
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderSale']?></p>
	</td></tr>
	</table>
</td>
<?}?>
</tr>

<tr>
<td width="100%" height="2" colspan="7" bgcolor="#E1E1E1">
<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="2" border="0"></p>
</td>
</tr>



<?foreach ($SplitList as $SplitId=>$Report) {?>
	<tr>
	<td class=ReportNameTd width=20%><p class=ReportColumn><B><a href="<?php echo getURL('split_test', "SplitId=$SplitId", 'report')?>" title="<?php echo $Lang['Stat']?>"><?php echo $Report->Name?></a></B>
	<?if (ValidVar($Report->ClientName)) {?><br><span class=ListDescr><?php echo $Report->ClientName?></span><?}?>
	</td>
	<?if($nsUser->Columns->CLICKS){?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $Report->SplitStat['CntClick']?></td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->SplitStat['UniClick']?></td>
	<?}?>
	<?if($nsUser->Columns->SALES){?>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->SplitStat['CntSale']?></td>
	<?}?>
	<?if($nsUser->Columns->ACTIONS){?>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->SplitStat['CntAction']?></td>
	<?}?>
	<?if($nsUser->Columns->CONVERSIONS){?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $Report->SplitStat['ActionConv']?>%</td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->SplitStat['SaleConv']?>%</td>
	<?}?>

	</tr>

	<tr>
	<td width="100%" height="1" colspan="7" bgcolor="#E1E1E1">
	<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
	</td></tr>

<?}?>
</table>
<?}?>






<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="20" BORDER="0" ALT="">



<?if (count($CompList)>0) {?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td width="100%" height="1" colspan="7" bgcolor="#E1E1E1">
	<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
	</td></tr>
<tr bgcolor="#f5f5f5">
<td width=20% class=ReportSimpleTd ><B><?php echo str_replace('{DATE}', date('d.m.Y'), $Lang['StatByClient'])?></B></td>
<?if($nsUser->Columns->HITS) {?>
	<td class="ReportHeaderTd2" colspan="2"  width=10%>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="2" width="100%" class="ReportHeaderTableTd">
		<p class="ReportHeaderName"><?php echo $Lang['RHeaderHit']?></p>
		</td></tr>
		<tr><td width="50%" class="ReportHeaderTableTd" ID="CntActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderTotal']?></p>
		</td><td width="50%" class="ReportHeaderTableTd" ID="UniActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderUni']?></p>
		</td></tr>
		</table>
	</td>
<?}?>

<?if($nsUser->Columns->ACTIONS) {?>
	<td class="ReportHeaderTd2" colspan="2"  width=10%>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="2" width="100%" class="ReportHeaderTableTd">
		<p class="ReportHeaderName"><?php echo $Lang['RHeaderAction']?></p>
		</td></tr>
		<tr><td width="50%" class="ReportHeaderTableTd" ID="CntActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderTotal']?></p>
		</td><td width="50%" class="ReportHeaderTableTd" ID="UniActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderUni']?></p>
		</td></tr>
		</table>
	</td>
<?}?>

<?if($nsUser->Columns->CLICKS) {?>
	<td class="ReportHeaderTd2" colspan="2"  width=10%>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="2" width="100%" class="ReportHeaderTableTd">
		<p class="ReportHeaderName"><?php echo $Lang['RHeaderClick']?></p>
		</td></tr>
		<tr><td width="50%" class="ReportHeaderTableTd" ID="CntActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderTotal']?></p>
		</td><td width="50%" class="ReportHeaderTableTd" ID="UniActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderUni']?></p>
		</td></tr>
		</table>
	</td>
<?}?>

</tr>

<tr>
<td width="100%" height="2" colspan="7" bgcolor="#E1E1E1">
<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="2" border="0"></p>
</td>
</tr>



<?foreach ($CompList as $CompId=>$Report) {?>
	<tr>
	<td class=ReportNameTd width=20%><p class=ReportColumn><B><?php echo $Report->Name?></B></td>
	<?if($nsUser->Columns->HITS){?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $Report->StatArr['CntClick']?></td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->StatArr['UniClick']?></td>
	<?}?>
	<?if($nsUser->Columns->ACTIONS){?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $Report->StatArr['CntAction']?></td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->StatArr['UniAction']?></td>
	<?}?>
	<?if($nsUser->Columns->CLICKS){?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $Report->StatArr['CntCamp']?></td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->StatArr['UniCamp']?></td>
	<?}?>
	</tr>
	<tr>
	<td width="100%" height="1" colspan="7" bgcolor="#E1E1E1">
	<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
	</td></tr>
<?}?>
</table>
<?}?>




<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="20" BORDER="0" ALT="">





<?if (count($SiteList)>0) {?>
<table border="0" cellpadding="0" cellspacing="0" width=100%>
	<tr>
	<td width="100%" height="1" colspan="7" bgcolor="#E1E1E1">
	<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
	</td></tr>

<tr bgcolor="#f5f5f5">
<td width=20% class=ReportSimpleTd ><B><?php echo str_replace('{DATE}', date('d.m.Y'), $Lang['StatBySite'])?></B></td>
<?if($nsUser->Columns->HITS) {?>
	<td class="ReportHeaderTd2" colspan="2"  width=10%>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="2" width="100%" class="ReportHeaderTableTd">
		<p class="ReportHeaderName"><?php echo $Lang['RHeaderHit']?></p>
		</td></tr>
		<tr><td width="50%" class="ReportHeaderTableTd" ID="CntActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderTotal']?></p>
		</td><td width="50%" class="ReportHeaderTableTd" ID="UniActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderUni']?></p>
		</td></tr>
		</table>
	</td>
<?}?>

<?if($nsUser->Columns->ACTIONS) {?>
	<td class="ReportHeaderTd2" colspan="2"  width=10%>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="2" width="100%" class="ReportHeaderTableTd">
		<p class="ReportHeaderName"><?php echo $Lang['RHeaderAction']?></p>
		</td></tr>
		<tr><td width="50%" class="ReportHeaderTableTd" ID="CntActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderTotal']?></p>
		</td><td width="50%" class="ReportHeaderTableTd" ID="UniActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderUni']?></p>
		</td></tr>
		</table>
	</td>
<?}?>

<?if($nsUser->Columns->CLICKS) {?>
	<td class="ReportHeaderTd2" colspan="2"  width=10%>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="2" width="100%" class="ReportHeaderTableTd">
		<p class="ReportHeaderName"><?php echo $Lang['RHeaderClick']?></p>
		</td></tr>
		<tr><td width="50%" class="ReportHeaderTableTd" ID="CntActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderTotal']?></p>
		</td><td width="50%" class="ReportHeaderTableTd" ID="UniActionHead">
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderUni']?></p>
		</td></tr>
		</table>
	</td>
<?}?>

</tr>

<tr>
<td width="100%" height="2" colspan="7" bgcolor="#E1E1E1">
<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="2" border="0"></p>
</td>
</tr>


<?foreach ($SiteList as $SiteId=>$Report) {?>
	<tr>
	<td class=ReportNameTd width=20%><p class=ReportColumn><B><?php echo $Report->Name?></B>
	<?if (ValidVar($Report->ClientName)) {?><br><span class=ListDescr><?php echo $Report->ClientName?></span><?}?>
	</td>

	<?if($nsUser->Columns->HITS){?>
	<td class=ReportSimpleTd2><p class=ReportColumn><a href="<?php echo getURL('natural_constructor', 'CpId=' . $Report->CpId . "&WhereArr[0][Mode]=Site&WhereArr[0][Id]=$SiteId&WhereArr[0][OrderBy]=CNT&WhereArr[0][OrderTo]=DESC&GroupBy=Date&", 'report')?>"><?php echo $Report->StatArr['CntClick']?></a></td>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $Report->StatArr['UniClick']?></td>
	<?}?>

	<?if($nsUser->Columns->ACTIONS){?>
	<td class=ReportSimpleTd2><p class=ReportColumn><a href="<?php echo getURL('natural_constructor', 'CpId=' . $Report->CpId . "&WhereArr[0][Mode]=Site&WhereArr[0][Id]=$SiteId&WhereArr[0][OrderBy]=CNT&WhereArr[0][OrderTo]=DESC&GroupBy=Action&ViewDate=" . $Report->ViewDate . '', 'report')?>"><?php echo $Report->StatArr['CntAction']?></a></td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->StatArr['UniAction']?></td>
	<?}?>

	<?if($nsUser->Columns->CLICKS){?>
	<td class=ReportSimpleTd2><p class=ReportColumn><a href="<?php echo getURL('paid_constructor', 'CpId=' . $Report->CpId . "&WhereArr[0][Mode]=Site&WhereArr[0][Id]=$SiteId&WhereArr[0][OrderBy]=CNT&WhereArr[0][OrderTo]=DESC&GroupBy=Camp&ViewDate=" . $Report->ViewDate . '', 'report')?>"><?php echo $Report->StatArr['CntCamp']?></a></td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $Report->StatArr['UniCamp']?></td>
	<?}?>

	</tr>

	<tr>
	<td width="100%" height="1" colspan="7" bgcolor="#E1E1E1">
	<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
	</td></tr>
<?}?>
</table>
<?}?>




<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="20" BORDER="0" ALT="">





<?if (count($Clients)>0) {?>

<table border="0" cellpadding="0" cellspacing="0" width=100%>
<?for($i=0;$i<count($Clients);$i++) {
	$Row=$Clients[$i];?>

	<tr><td class=ListRowRight>

	<table border="0" cellpadding="0" cellspacing="0" width=100%>
	<tr><td width=100%><p class=SectionName style="margin-bottom:0px;"><a href="<?php echo getURL('client_page', 'CpId=' . $Row->ID)?>"><B><?php echo $Row->NAME?></B></a></p>
	</td>

	<td><IMG SRC="<?php echo FileLink('images/small_icon_stat-a.gif'); ?>" WIDTH="8" HEIGHT="8" BORDER="0" ALT="" hspace=6></td>
	<td nowrap style="font-size:10px;">
	<a href="<?php echo getURL('paid_constructor', 'CpId=' . $Row->ID, 'report')?>"><?php echo $Lang['MPaidAdv']?></a>


	</td>

	<td><IMG SRC="<?php echo FileLink('images/small_icon_stat-a.gif'); ?>" WIDTH="8" HEIGHT="8" BORDER="0" ALT="" hspace=6></td><td nowrap style="font-size:10px;">
	<a href="<?php echo getURL('natural_constructor', 'CpId=' . $Row->ID, 'report')?>"><?php echo $Lang['MNatural']?></a>


	</td>

	<td><IMG SRC="<?php echo FileLink('images/small_icon_logs-a.gif'); ?>" WIDTH="11" HEIGHT="9" BORDER="0" ALT="" hspace=6></td><td nowrap style="font-size:10px;">
	<a href="<?php echo getURL('reports', 'CpId=' . $Row->ID, 'admin')?>"><?php echo $Lang['MLogs']?></a>


	</td>

	<td><IMG SRC="<?php echo FileLink('images/small_icon_campaign-a.gif'); ?>" WIDTH="8" HEIGHT="7" BORDER="0" ALT="" hspace=6></td><td nowrap style="font-size:10px;">
	<a href="<?php echo getURL('campaign', 'CpId=' . $Row->ID, 'admin')?>"><?php echo $Lang['MCampaign']?></a>
	</td>

	<td><IMG SRC="<?php echo FileLink('images/small_icon_actions-a.gif'); ?>" WIDTH="4" HEIGHT="8" BORDER="0" ALT="" hspace=6></td><td nowrap style="font-size:10px;">
	<a href="<?php echo getURL('actions', 'CpId=' . $Row->ID, 'admin')?>"><?php echo $Lang['MActions']?></a>
	</td>


	</tr>
	</table>

	</td></tr>

<?}?>
</table>

<?}?>




<?include $nsTemplate->Inc("inc/footer");?>