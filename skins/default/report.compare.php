<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>
<?require_once SELF."/lib/calendar.func.php"?>


<div class=FormDiv>
<table width=100% cellpadding=6>

<?if (count($SitesArr)>1) {?>
<tr><td class=FormHeader>
<?GetFORM();?>
<input type=hidden name="CpId" value="<?php echo $CpId?>">
<span style="color:#000000;font-weight:bold;"><?php echo $Lang['ChooseSite']?>:&nbsp;</span>
<select name=SiteId>
<option style="color:#999999" value=0><?php echo $Lang['AllSites']?></option>
<?for ($i=0;$i<count($SitesArr);$i++) {?>
	<option value=<?php echo $SitesArr[$i]->ID?> <?php echo (($SitesArr[$i]->ID == $SiteId) ? 'selected' : '')?>><?php echo $SitesArr[$i]->HOST?></option>
<?}?>
</select>&nbsp;
<input type=submit value="<?php echo $Lang['Choose']?>">
</form>
</td></tr>
<?}?>


<tr><td>
<?GetFORM();?>
<input type=hidden name="FormClicked" value="1">
<input type=hidden name=CpId value="<?php echo $CpId?>">
<input type=hidden name=SiteId value="<?php echo $SiteId?>">

<?php echo $Lang['Date']?>:&nbsp;<input type=text size=10 id="ViewDate" name="ViewDate" value="<?php echo $ViewDate?>" class=DateFld ondblclick="this.value=''">
<a href="javascript:;" onclick="ShowCalendar('ViewDate');">
<IMG SRC="<?php echo FileLink('images/icon_date.gif'); ?>"  WIDTH=18 HEIGHT=18 BORDER=0 ALT="" align=absmiddle>&nbsp;
</a>

&nbsp;&nbsp;|&nbsp;&nbsp;
<?php echo $Lang['Period']?>:&nbsp;
<input type=text size=10 id="StartDate" name="StartDate" value="<?php echo $StartDate?>" class=DateFld ondblclick="this.value=''">
<a href="javascript:;" onclick="ShowCalendar('StartDate');">
<IMG SRC="<?php echo FileLink('images/icon_date.gif'); ?>"  WIDTH=18 HEIGHT=18 BORDER=0 ALT="" align=absmiddle>&nbsp;
</a>&nbsp;—&nbsp;
<input type=text size=10 id="EndDate" name="EndDate" value="<?php echo $EndDate?>" class=DateFld ondblclick="this.value=''">
<a href="javascript:;" onclick="ShowCalendar('EndDate');">
<IMG SRC="<?php echo FileLink('images/icon_date.gif'); ?>"  WIDTH=18 HEIGHT=18 BORDER=0 ALT="" align=absmiddle>&nbsp;
</a>
&nbsp;
<input type=submit value="<?php echo $Lang['Refresh']?>">

</form>
</td></tr>

</table>
</div>


<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">



<table border="0" cellpadding="0" cellspacing="0" width=100%>


<tr height=30>
<td  class=ReportHeaderTd2 style="padding:5px;"><p class=ReportHeaderName><?php echo $Lang['VisTotal']?></td>
<td  class=ReportHeaderTd2 style="padding:5px;"><p class=ReportHeaderName><?php echo $Lang['VisWRef']?></td>
<td  class=ReportHeaderTd2 style="padding:5px;"><p class=ReportHeaderName><?php echo $Lang['VisNoRef']?></td>
<td  class=ReportHeaderTd2 style="padding:5px;"><p class=ReportHeaderName><?php echo $Lang['VisKey']?></td>
<td  class=ReportHeaderTd2 style="padding:5px;"><p class=ReportHeaderName><?php echo $Lang['VisPaid']?></td>
<td  class=ReportHeaderTd2 style="padding:5px;"><p class=ReportHeaderName><?php echo $Lang['VisAction']?></td>
<td  class=ReportHeaderTd2 style="padding:5px;"><p class=ReportHeaderName><?php echo $Lang['VisSale']?></td>
</tr>

<tr><td colspan=7><p>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="100%" HEIGHT="2" BORDER="0" ALT="" style="background:#E1E1E1">
</p></td></tr>

<tr>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $TotalCnt?></B></td>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $RefCnt?></B></td>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $NoRefCnt?></B></td>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $KeyCnt?></B></td>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $ClickCnt?></B></td>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $ActionCnt?></B></td>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $SaleCnt?></B></td>
</tr>

<tr><td colspan=7><p>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="100%" HEIGHT="1" BORDER="0" ALT="" style="background:#E1E1E1">
</p></td></tr>


<tr>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $TotalCntPerc?>%</B></td>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $RefCntPerc?>%</B></td>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $NoRefCntPerc?>%</B></td>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $KeyCntPerc?>%</B></td>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $ClickCntPerc?>%</B></td>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $ActionCntPerc?>%</B></td>
<td class=ReportSimpleTd><B style="color:#000000"><?php echo $SaleCntPerc?>%</B></td>
</tr>

<tr><td colspan=7><p>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="100%" HEIGHT="1" BORDER="0" ALT="" style="background:#E1E1E1">
</p></td></tr>



</table>



<?include $nsTemplate->Inc("inc/footer");?>