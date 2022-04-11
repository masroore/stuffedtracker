<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>


<SCRIPT LANGUAGE="JavaScript">
<!--

function CheckVisitor()
{
	oHid=GetObj("AlreadySaved");
	if (oHid.value==1) return true;
	oNewIp=GetObj("NewIp");
	oNewIp2=GetObj("VisNewIp");
	oNewIp2.value=oNewIp.value;
	oForm=GetObj("EDIT_FORM");
	oForm.submit();
	return false;
}

//-->
</SCRIPT>



<?if ($Mode=="edit") {?>
<table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=50% valign=top>
<?}?>




<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $TableCaption?>
</td></tr>
</table>

<table  class=FormTable>
<?PostFORM(false, false, false, "ID=\"EDIT_FORM\"");?>
<input type=hidden name="VisId" value="<?php echo $VisId?>">
<input type=hidden name="AlreadySaved" value="<?php echo ((ValidId($Visitor->CLIENT_VIS_ID)) ? '1' : '0')?>" Id="AlreadySaved">
<input type=hidden id="VisNewIp" name="NewIp" value="">

<tr><td class=FormLeftTd>
<?php echo $Lang['LastAgent']?>
</td><td class=FormRightTd>
<a href="<?php echo getURL('natural_constructor', "CpId=$CpId&WhereArr[0][Mode]=Agent&WhereArr[0][Id]=" . $Visitor->USER_AGENT_ID . '&WhereArr[0][OrderTo]=DESC&WhereArr[0][OrderBy]=CNT&GroupBy=Vis&WhereArr[1][OrderTo]=DESC&WhereArr[1][OrderBy]=CNT&ShowAll=1', 'report')?>" title="<?php echo $Lang['OtherWithAgent']?>">
<?php echo $Visitor->USER_AGENT?>
</a>
<?if($Visitor->GRP_ID>0){?>
<br><B>
<a href="<?php echo getURL('natural_constructor', "CpId=$CpId&GroupBy=AgentGrp&ShowAll=1", 'report')?>" title="<?php echo $Lang['AgentStat']?>">
<?php echo $Visitor->GRP_NAME?>
</a>
</B>
<?}?>
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['LastIp']?>
</td><td class=FormRightTd>
<a href="<?php echo getURL('visitor_path', "CpId=$CpId&IP=" . $Visitor->LAST_IP, 'report')?>" title="<?php echo $Lang['OtherWithIP']?>">
<?php echo $Visitor->LAST_IP?>
</a>
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['ScrRes']?>
</td><td class=FormRightTd>
<?php echo (($Visitor->LAST_RESOLUTION != '-1') ? $Visitor->LAST_RESOLUTION : $Lang['Undefined'])?>
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['Color']?>
</td><td class=FormRightTd>
<?php echo (($Visitor->PIXEL_DEPTH > 0) ? $Visitor->PIXEL_DEPTH . 'bit' : $Lang['Undefined'])?>
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['Flash']?>
</td><td class=FormRightTd>
<?php echo (($Visitor->FLASH_VERSION != '-1') ? $Visitor->FLASH_VERSION : $Lang['Undefined'])?>
</td></tr>

<?if ($Mode=="edit") {?>

<tr><td class=FormLeftTd>
<?php echo $Lang['VisitorName']?>
</td><td class=FormRightTd>
<input type=text  name="EditArr[Name]" value="<?php echo $EditArr['Name']?>">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['Title']?>
</td><td class=FormRightTd>
<textarea rows=5 name="EditArr[Descr]"><?php echo $EditArr['Descr']?></textarea>
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['AddToMy']?>
</td><td class=FormRightTd>
<input type=checkbox name="EditArr[Watch]" value=1 <?php echo (($EditArr['Watch'] > 0) ? 'checked' : '')?>>
</td></tr>


</table>

<table class=SubmitTable>
<tr><td class=SubmitLeftTd>
</td><td class=SubmitRightTd>
<input type=submit value="<?php echo $Lang['Save']?>">
</td></tr>

<?}
elseif (ValidVar($EditArr['Descr'])) {?>
<tr><td class=FormLeftTd>
<?php echo $Lang['Title']?>
</td><td class=FormRightTd>
<?php echo stripslashes($EditArr['Descr'])?>
</td></tr>
<?}?>

</form>
</table>

<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">

<?if ($Mode=="edit") {?>
</td><td width=50% valign=top>

<div class=ListDiv>

<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $Lang['IpList']?>
</td></tr>
</table>


<table class=ListTable2>
<?for ($i=0;$i<count($IpArr);$i++) {
	$Row=$IpArr[$i];?>
	<tr>
	<td class=<?php echo $Row->_STYLE?>>

	<table width=100% cellpadding=0 cellspacing=0 border=0><tr>
	<td width=100%>
	<B style="color:#000000"><?php echo $Row->IP?></B>
	</td>
	<td>
	<?php
    $nsButtons->Add('delete.gif', $Lang['Delete'], getURL('visitor', "VisId=$VisId&CpId=$CpId&DeleteIp=" . $IpArr[$i]->ID));
    $nsButtons->Dump();
    ?>
	</td>
	</tr></table>

	</td></tr>
<?}?>
</table>


<?PostFORM();?>
<input type=hidden name="VisId" value="<?php echo $VisId?>">
<input type=hidden name="CpId" value="<?php echo $CpId?>">
<table  class=FormTable>
<tr><td class=FormLeftTd>
<?php echo $Lang['AddNewIp']?>
</td><td class=FormRightTd>
<input type=text size=15 id="NewIp" name="NewIp">
</td></tr>

</table>

<table class=SubmitTable>
<tr><td class=SubmitLeftTd>
</td><td class=SubmitRightTd>
<input type=submit value="<?php echo $Lang['Add']?>" onclick="return CheckVisitor();">
</td></tr>
</table>

</form>

</div><br>

</td></tr></table>
<?}?>



<?if ($Mode=="view") {?>
<?//if ($Visitor->COMPANY_ID) {?>

<div style="width:100%" class=FormDiv2>
<table  class=FormTable>

<tr>
<td  class=ReportTabTd align=center><?php echo $Lang['TotalPageLoad']?></td>
<td  class=ReportTabTd align=center><?php echo $Lang['TotalActions']?></td>
<td  class=ReportTabTd align=center><?php echo $Lang['TotalSales']?></td>
<td  class=ReportTabTd align=center><?php echo $Lang['TotalClicks']?></td>
<td  class=ReportTabTd align=center><?php echo $Lang['TotalRefCome']?></td>
<td  class=ReportTabTd align=center><?php echo $Lang['TotalKeywords']?></td>

</tr>

<tr>

<td class=ReportSimpleTd align=center><B>
<a href="<?php echo getURL('natural_constructor', "CpId=$CpId&WhereArr[0][Mode]=Vis&WhereArr[0][Id]=$VisId&WhereArr[0][OrderTo]=DESC&WhereArr[0][OrderBy]=CNT&GroupBy=Page&WhereArr[1][OrderTo]=DESC&WhereArr[1][OrderBy]=CNT&ShowAll=1", 'report')?>" title="<?php echo $Lang['ShowPagesList']?>">
<?php echo $TotalCnt?>
</a>
</B></td>

<td class=ReportSimpleTd align=center><B>
<a href="<?php echo getURL('natural_constructor', "CpId=$CpId&WhereArr[0][Mode]=Vis&WhereArr[0][Id]=$VisId&WhereArr[0][OrderTo]=DESC&WhereArr[0][OrderBy]=CNT&GroupBy=Action&WhereArr[1][OrderTo]=DESC&WhereArr[1][OrderBy]=CNT&ShowAll=1", 'report')?>" title="<?php echo $Lang['ShowActionsList']?>">
<?php echo $ActionCnt?>
</a>
</B></td>

<td class=ReportSimpleTd align=center><B>
<a href="<?php echo getURL('natural_constructor', "CpId=$CpId&WhereArr[0][Mode]=Vis&WhereArr[0][Id]=$VisId&WhereArr[0][OrderTo]=DESC&WhereArr[0][OrderBy]=CNT&GroupBy=Sale&WhereArr[1][OrderTo]=DESC&WhereArr[1][OrderBy]=CNT&ShowAll=1", 'report')?>" title="<?php echo $Lang['ShowSalesList']?>">
<?php echo $SaleCnt?>
</a>
</B></td>

<td class=ReportSimpleTd align=center><B>
<a href="<?php echo getURL('paid_constructor', "CpId=$CpId&WhereArr[0][Mode]=Vis&WhereArr[0][Id]=$VisId&WhereArr[0][OrderTo]=DESC&WhereArr[0][OrderBy]=CNT&GroupBy=Camp&WhereArr[1][OrderTo]=DESC&WhereArr[1][OrderBy]=CNT&ShowAll=1", 'report')?>" title="<?php echo $Lang['ShowCampList']?>">
<?php echo $ClickCnt?>
</B></td>

<td class=ReportSimpleTd align=center><B>
<a href="<?php echo getURL('natural_constructor', "CpId=$CpId&WhereArr[0][Mode]=Vis&WhereArr[0][Id]=$VisId&WhereArr[0][OrderTo]=DESC&WhereArr[0][OrderBy]=CNT&GroupBy=Ref&WhereArr[1][OrderTo]=DESC&WhereArr[1][OrderBy]=CNT", 'report')?>" title="<?php echo $Lang['ShowRefList']?>">
<?php echo $RefCnt?>
</a>
</B></td>

<td class=ReportSimpleTd2 align=center><B>
<a href="<?php echo getURL('natural_constructor', "CpId=$CpId&WhereArr[0][Mode]=Vis&WhereArr[0][Id]=$VisId&WhereArr[0][OrderTo]=DESC&WhereArr[0][OrderBy]=CNT&GroupBy=Key&WhereArr[1][OrderTo]=DESC&WhereArr[1][OrderBy]=CNT", 'report')?>" title="<?php echo $Lang['ShowLeyList']?>">
<?php echo $KeyCnt?>
</a>
</B></td>

</tr>

</table>
</div>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="20" BORDER="0" ALT="">

<?if (count($RefArr)>0) {?>
<div class=ListDiv>
<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $Lang['RefList']?>
</td></tr>
</table>
<table class=ListTable2 width=100%>
	<?for($i=0;$i<count($RefArr);$i++) {?>
	<tr><td class=ListRowRight2>
	<span style="font-size:9px;"><b><?php echo date('Y-m-d H:i', $RefArr[$i]->STAMP)?></b>&nbsp;</span>
	<a href="<?php echo htmlspecialchars($RefArr[$i]->REFERER)?>" target=_blank>
	<?php echo urldecode(urldecode($RefArr[$i]->REFERER))?>
	</a>
	</td></tr>
	<?}?>
</table>
</div>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">
<?}?>


<?if (count($KeyArr)>0) {?>
<div class=ListDiv>
<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $Lang['KeyList']?>
</td></tr>
</table>
<table class=ListTable2 width=100%>
	<?for($i=0;$i<count($KeyArr);$i++) {?>
	<tr><td class=ListRowRight2>
	<a href="<?php echo getURL('natural_constructor', "CpId=$CpId&WhereArr[0][Mode]=Key&WhereArr[0][Id]=" . $KeyArr[$i]->NATURAL_KEY . '&WhereArr[0][OrderTo]=DESC&WhereArr[0][OrderBy]=CNT&GroupBy=Vis', 'report')?>" title="<?php echo $Lang['ShowKeyStat']?>">
	<?php echo urldecode(urldecode($KeyArr[$i]->KEYWORD))?>
	</a>
	</td></tr>
	<?}?>
</table>
</div>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">

<?}?>


<?}?>
<?//}?>




<?include $nsTemplate->Inc("inc/footer");?>