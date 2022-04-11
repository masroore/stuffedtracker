<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>


<?if ($Mode=="edit") include $nsTemplate->Inc("admin.visitor_grp_edit");?>


<?if (ValidId($VisGrp->ID)&&count($IpArr)>0&&$Mode=="view") {?>



<?if ($Mode!="edit"&&ValidVar($EditArr['Descr'])) {?>
<table  class=FormTable>
<tr><td class=FormLeftTd>
<?php echo $Lang['GrpInfo']?>
</td><td class=FormRightTd>
<?php echo stripslashes($EditArr['Descr'])?>
</td></tr>
</table><?}?>

<table  class=FormTable>

<tr>
<td   align=center><?php echo $Lang['TotalPageLoad']?></td>
<td   align=center><?php echo $Lang['TotalActions']?></td>
<td   align=center><?php echo $Lang['TotalSales']?></td>
<td   align=center><?php echo $Lang['TotalClicks']?></td>
<td   align=center><?php echo $Lang['TotalRefCome']?></td>
<td   align=center><?php echo $Lang['TotalKeywords']?></td>
</tr>

<tr>
<td class=ReportSimpleTd align=center><B>
<?php echo $TotalCnt?>
</B></td>
<td class=ReportSimpleTd align=center><B>
<?php echo $ActionCnt?>
</B></td>
<td class=ReportSimpleTd align=center><B>
<?php echo $SaleCnt?>
</B></td>
<td class=ReportSimpleTd align=center><B>
<?php echo $ClickCnt?>
</B></td>
<td class=ReportSimpleTd align=center><B>
<?php echo $RefCnt?>
</B></td>
<td class=ReportSimpleTd2 align=center><B>
<?php echo $KeyCnt?>
</B></td>

</tr>

</table>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">


<?if (count($RefArr)>0) {?>
<div class=ListDiv>
<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $Lang['RefList']?>
</td></tr>
</table>
<table class=ListTable2>
	<?for($i=0;$i<count($RefArr);$i++) {?>
	<tr><td class=ListRowRight2>
	<span style="font-size:9px;"><b><?php echo date('Y-m-d H:i', $RefArr[$i]->STAMP)?></b>&nbsp;</span>
	<span style="font-size:10px;color:999999"><?php echo $RefArr[$i]->HOST?></span>&nbsp;
	<a href="<?php echo htmlspecialchars($RefArr[$i]->REFERER)?>" target=_blank>
	<?php echo urldecode(urldecode($RefArr[$i]->REFERER))?>
	</a>
	</td></tr>
	<?}?>
</table>
</div>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="20" BORDER="0" ALT="">
<?}?>


<?if (count($KeyArr)>0) {?>
<div class=ListDiv>
<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $Lang['KeyList']?>
</td></tr>
</table>
<table class=ListTable2>
	<?for($i=0;$i<count($KeyArr);$i++) {?>
	<tr><td class=ListRowRight2>
	<a href="<?php echo getURL('natural_constructor', "CpId=$CpId&WhereArr[0][Mode]=Key&WhereArr[0][Id]=" . $KeyArr[$i]->NATURAL_KEY . '&WhereArr[0][OrderTo]=DESC&WhereArr[0][OrderBy]=CNT&GroupBy=Vis', 'report')?>" title="<?php echo $Lang['ShowKeyStat']?>">
	<?php echo urldecode(urldecode($KeyArr[$i]->KEYWORD))?>
	</a>
	</td></tr>
	<?}?>
</table>
</div>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="20" BORDER="0" ALT="">
<?}?>



<?if (count($AgentArr)>0) {?>
<div class=ListDiv>
<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $Lang['AgentsList']?>
</td></tr>
</table>
<table class=ListTable2>
	<?for($i=0;$i<count($AgentArr);$i++) {?>
	<tr><td class=ListRowRight2>
	<a href="<?php echo getURL('natural_constructor', "CpId=$CpId&WhereArr[0][Mode]=Agent&WhereArr[0][Id]=" . $AgentArr[$i]->ID . '&WhereArr[0][OrderTo]=DESC&WhereArr[0][OrderBy]=CNT&GroupBy=Vis', 'report')?>" title="<?php echo $Lang['AgentStat']?>">
	<?php echo $AgentArr[$i]->USER_AGENT?>
	</a>
	<?if($AgentArr[$i]->GRP_ID>0) {?>
		<B><a href="<?php echo getURL('natural_constructor', "CpId=$CpId&WhereArr[0][Mode]=AgentGrp&WhereArr[0][Id]=" . $AgentArr[$i]->ID . '&WhereArr[0][OrderTo]=DESC&WhereArr[0][OrderBy]=CNT&GroupBy=Vis', 'report')?>"  title="<?php echo $Lang['AgentGrpStat']?>"><?php echo $AgentArr[$i]->GRP_NAME?></a></B>
	<?}?>
	</td></tr>
	<?}?>
</table>
</div>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="20" BORDER="0" ALT="">
<?}?>

<?}?>

<?include $nsTemplate->Inc("inc/footer");?>