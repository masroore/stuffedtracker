<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>
<?require_once SELF."/lib/calendar.func.php"?>


<div class=FormDiv>

<table width=100%>
<tr>
<?GetFORM();?>
<input type=hidden name=SplitId value=<?php echo $SplitId?>>


<td class=ReportSimpleTd2>
<?php echo $Lang['Date']?>:
<input type=text size=10 id="ViewDate" name="ViewDate" value="<?php echo $ViewDate?>">
<a href="javascript:;" onclick="ShowCalendar('ViewDate');">
<IMG SRC="<?php echo FileLink('images/icon_date.gif'); ?>"  WIDTH=18 HEIGHT=18 BORDER=0 ALT="" align=absmiddle>&nbsp;
</a>
</td>

<td class=ReportSimpleTd2>
<?php echo $Lang['Period']?>:

	<input type=text size=10 id="StartDate" name="StartDate" value="<?php echo $StartDate?>">
	<a href="javascript:;" onclick="ShowCalendar('StartDate');">
	<IMG SRC="<?php echo FileLink('images/icon_date.gif'); ?>"  WIDTH=18 HEIGHT=18 BORDER=0 ALT="" align=absmiddle>&nbsp;
	</a>&mdash;
	<input type=text size=10 id="EndDate" name="EndDate" value="<?php echo $EndDate?>">
	<a href="javascript:;" onclick="ShowCalendar('EndDate');">
	<IMG SRC="<?php echo FileLink('images/icon_date.gif'); ?>"  WIDTH=18 HEIGHT=18 BORDER=0 ALT="" align=absmiddle>&nbsp;
	</a>
</td>

<td class=ReportSimpleTd2 align=right>
<input type=submit value="<?php echo $Lang['Refresh']?>">
</td>
</form>
</tr>

</table>
</div>

<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="20" BORDER="0" ALT="">



<table border="0" cellpadding="0" cellspacing="0" width=100%>




<tr height=15>
<td width=20% class="ReportHeaderTd2" rowspan=2 valign=middle style="padding-left:5px;">
<p class="ReportHeaderName"><?php echo $Lang['SplitStat']?></p>
</td>

<?if ($nsUser->Columns->CLICKS) {?>
	<td class="ReportHeaderTd3" colspan="2"  width=5%>
		<p class="ReportHeaderName"><?php echo $Lang['RHeaderClick']?></p>
	</td>
<?}?>


<?if ($nsUser->Columns->SALES) {?>
<td class="ReportHeaderTd3" colspan="3"  width=5%>
	<p class="ReportHeaderName"><?php echo $Lang['RHeaderSale']?></p>
</td>
<?}?>

<?if ($nsUser->Columns->ACTIONS) {?>
<td class="ReportHeaderTd3" colspan="2"  width=5%>
	<p class="ReportHeaderName"><?php echo $Lang['RHeaderAction']?></p>
</td>
<?}?>


<?if ($nsUser->Columns->CONVERSIONS) {?>
<td class="ReportHeaderTd3" colspan="2"  width=5%>
	<p class="ReportHeaderName"><?php echo $Lang['RHeaderConversion']?></p>
</td>
<?}?>

</tr>


<tr height=15>
<?if ($nsUser->Columns->CLICKS) {?>
	<td class="ReportHeaderTd4"   width=5%>
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderTotal']?></p>
		</td><td class="ReportHeaderTd3"   width=5%>
		<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderUni']?></p>
	</td>
<?}?>


<?if ($nsUser->Columns->SALES) {?>
<td class="ReportHeaderTd4"  width=5%>
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderTotal']?></p>
	</td><td class="ReportHeaderTd4"   width=5%>
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderUni']?></p>
	</td><td class="ReportHeaderTd3"   width=5%>
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderIncome']?></p>
</td>
<?}?>

<?if ($nsUser->Columns->ACTIONS) {?>
<td class="ReportHeaderTd4"   width=5%>
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderTotal']?></p>
	</td><td class="ReportHeaderTd3"  width=5%>
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderUni']?></p>
</td>
<?}?>


<?if ($nsUser->Columns->CONVERSIONS) {?>
<td class="ReportHeaderTd4"   width=5%>
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderAction']?></p>
	</td><td class="ReportHeaderTd3"   width=5%>
	<p class="ReportSubHeaderName"><?php echo $Lang['RHeaderSale']?></p>
</td>
<?}?>

</tr>


<tr>
<td width="100%" height="2" colspan="12" bgcolor="#E1E1E1">
<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="2" border="0"></p>
</td>
</tr>




	<tr>
	<td class=ReportNameTd width=20%><p class=ReportColumn><?php echo $Lang['General']?></td>

	<?if ($nsUser->Columns->CLICKS) {?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $SplitStat['CntClick']?></td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $SplitStat['UniClick']?></td>
	<?}?>

	<?if ($nsUser->Columns->SALES) {?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $SplitStat['CntSale']?></td>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $SplitStat['UniSale']?></td>
	<td class=ReportSimpleTd><p class=ReportColumn>
	<?php echo ($SplitStat['Income'] > 0) ? ShowCost($SplitStat['Income'], $CurrentCompany->CUR) : '&nbsp;'?>
	</td>
	<?}?>

	<?if ($nsUser->Columns->ACTIONS) {?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $SplitStat['CntAction']?></td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $SplitStat['UniAction']?></td>
	<?}?>

	<?if ($nsUser->Columns->CONVERSIONS) {?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $SplitStat['ActionConv']?>% (<?php echo $Report->OneOf($SplitStat['UniAction'], $SplitStat['UniClick'])?>)</td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $SplitStat['SaleConv']?>% (<?php echo $Report->OneOf($SplitStat['UniSale'], $SplitStat['UniClick'])?>)</td>
	<?}?>

	</tr>

	<tr>
	<td width="100%" height="1" colspan="12" bgcolor="#E1E1E1">
	<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
	</td></tr>




<?if ($Report->ShowPages&&count($Report->PageStat)>0) {?>
<?if (ValidArr($Report->PageStat)&&count($Report->PageStat)>0) {?>
<?foreach ($Report->PageStat as $PageId => $PageStat)  {?>
	<tr>
	<td class=ReportNameTd width=20%><p class=ReportColumn><?php echo $PageStat['Obj']->HOST . $PageStat['Obj']->PATH?></td>

	<?if ($nsUser->Columns->CLICKS) {?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $PageStat['CntClick']?></td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $PageStat['UniClick']?></td>
	<?}?>

	<?if ($nsUser->Columns->SALES) {?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $PageStat['CntSale']?></td>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $PageStat['UniSale']?></td>
	<td class=ReportSimpleTd><p class=ReportColumn>
	<?php echo ($PageStat['Income'] > 0) ? ShowCost($PageStat['Income'], $CurrentCompany->CUR) : '&nbsp;'?>
	</td>
	<?}?>
	<?if ($nsUser->Columns->ACTIONS) {?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $PageStat['CntAction']?></td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $PageStat['UniAction']?></td>
	<?}?>
	<?if ($nsUser->Columns->CONVERSIONS) {?>
	<td class=ReportSimpleTd2><p class=ReportColumn><?php echo $PageStat['ActionConv']?>% (<?php echo $Report->OneOf($PageStat['UniAction'], $PageStat['UniClick'])?>)</td>
	<td class=ReportSimpleTd><p class=ReportColumn><?php echo $PageStat['SaleConv']?>% (<?php echo $Report->OneOf($PageStat['UniSale'], $PageStat['UniClick'])?>)</td>
	<?}?>
	</tr>
	<tr>
	<td width="100%" height="1" colspan="12" bgcolor="#E1E1E1">
	<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
	</td></tr>


<?}?>
<?}?>
<?}?>


</table>







<?include $nsTemplate->Inc("inc/footer");?>