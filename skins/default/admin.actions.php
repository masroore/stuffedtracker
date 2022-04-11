<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>




<SCRIPT LANGUAGE="JavaScript">
<!--

function ChangeForm()
{
	oSelect=GetObj("RedirOnly");
	var Mode=oSelect.value;

	//oTextVar=GetObj('ItemVar');
	oTextUrl=GetObj('RedirUrl');
	oCheckDyn=GetObj('DynamicRedir');
	oCheck=GetObj('DynamicCheck');
	oHelpOnPage=GetObj('ActionHelpOnPage');
	oHelpRedir=GetObj('ActionHelpRedir');
	oHelpCode=GetObj('ActionHelpCode');
	oInputUrl=GetObj('RedirUrlText');
	oPageTempl=GetObj('PageTempl');

	if (Mode==0) {
		//oTextVar.style.display="";
		oTextUrl.style.display="none";
		oCheckDyn.style.display="none";
		if (oHelpOnPage.innerHTML!="") oHelpOnPage.style.display="";
		oHelpRedir.style.display="none";
		oHelpCode.style.display="none";
		oPageTempl.style.display='';
	}

	if (Mode==1) {
		//oTextVar.style.display="none";
		oTextUrl.style.display="";
		oInputUrl.disabled=oCheck.checked;
		oInputUrl.readonly=oCheck.checked;
		oCheckDyn.style.display="";
		oHelpOnPage.style.display="none";
		oHelpCode.style.display="none";
		if (oHelpRedir.innerHTML!="") oHelpRedir.style.display="";
		oPageTempl.style.display='';
	}

	if (Mode==2) {
		oTextUrl.style.display="none";
		oInputUrl.disabled=oCheck.checked;
		oInputUrl.readonly=oCheck.checked;
		oCheckDyn.style.display="none";
		oHelpOnPage.style.display="none";
		oHelpRedir.style.display="none";
		oHelpCode.style.display="";
		oPageTempl.style.display='none';
	}

	ChangePageName(Mode);

}

<?for ($i=0;$i<count($SitesArr);$i++) {
	if ($SitesArr[$i]->ID==$SiteId) echo "var PrevIndex=$i;\n";
}?>

var PageName1='<?php echo $Lang['Template']?>';
var PageName2='<?php echo $Lang['Template2']?>';

function ChangePageName(Mode)
{
	oDiv=GetObj("PageName");
	oDiv.innerHTML=(Mode==1)?PageName2:PageName1;
}

function ChangeSiteOnFly(oSelect)
{
	if (PrevIndex==oSelect.value) return false;
	oText=GetObj("Templ");
	oHidden=GetObj("HidSiteId");
	var NewHost="";
	var PrevHost="";
	NewHost=oSelect.options[oSelect.selectedIndex].text;
	PrevHost=oSelect.options[PrevIndex].text;
	oText.value=ReplaceHost(oText.value, NewHost, PrevHost);
	oHidden.value=oSelect.value;
	PrevIndex=oSelect.selectedIndex;
}

function ReplaceHost(URL, NewHost, PrevHost)
{
	if (!NewHost||!PrevHost) return URL;
	return URL.replace("http://"+PrevHost, "http://"+NewHost);
}
//-->
</SCRIPT>




<?if (count($SitesArr)>1) {?>
<div class=FormDiv>
<table width=100%>
<tr><td class=FormHeader>
<?GetFORM();?>
<input type=hidden name="CpId" value="<?php echo $CpId?>">
<?if ($EditId=="new") {?>
<input type=hidden name="EditId" value="<?php echo $EditId?>">
<input type=hidden name="Mode" value="new">
<?}?>
<input type=hidden name=fc value=1>
<B style="color:#000000"><?php echo $Lang['ChooseSite']?>:</B>&nbsp;
<select name=SiteId <?php echo (($SiteId > 0 && ValidId($EditId)) ? 'disabled' : '')?> <?php echo (($EditId == 'new') ? 'onchange="ChangeSiteOnFly(this);"' : '')?>>
<?if ($EditId!="new") {?><option></option><?}?>
<?for ($i=0;$i<count($SitesArr);$i++) {?>
	<option value=<?php echo $SitesArr[$i]->ID?> <?php echo (($SitesArr[$i]->ID == $SiteId) ? 'selected' : '')?>><?php echo $SitesArr[$i]->HOST?></option>
<?}?>
</select>&nbsp;
<input type=submit value="<?php echo $Lang['Choose']?>" <?php echo (($SiteId > 0 && ValidId($EditId)) ? 'disabled' : '')?>>
</form>
</td></tr></table></div>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">
<?}?>



<?if ($Mode=="new"||$Mode=="edit") {?>


<!-- тнплю -->
<?if (ValidId($Site->ID)) {?>

<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $TableCaption?></td></tr>
</table>

<table  class=FormTable>
<?PostFORM();?>
<input type=hidden name="CpId" value="<?php echo $CpId?>">
<input type=hidden id="HidSiteId" name="SiteId" value="<?php echo $SiteId?>">
<input type=hidden name="EditId" value="<?php echo $EditId?>">
<input type=hidden name="Mode" value="<?php echo $Mode?>">





<tr><td class=FormLeftTd width=150>
<?php echo $Lang['Name']?>
</td><td class=FormRightTd>
<input type=text size=50 name="EditArr[Name]" value="<?php echo htmlspecialchars(stripslashes($EditArr['Name']))?>">
</td></tr>

<tr><td class=FormLeftTd width=150>
<?php echo $Lang['LangType']?>
</td><td class=FormRightTd>
<select Id="RedirOnly" name="EditArr[RedirOnly]" onchange="ChangeForm();" <?php echo ((ValidVar($Action->IsPathTempl)) ? 'disabled' : '')?>>
<option value=0 <?php echo (($EditArr['RedirOnly'] == 0 && !ValidVar($Action->IsPathTempl)) ? 'selected' : '')?>><?php echo $Lang['CatchPage']?></option>
<option value=1 <?php echo (($EditArr['RedirOnly'] == 1 && !ValidVar($Action->IsPathTempl)) ? 'selected' : '')?>><?php echo $Lang['CatchRedir']?></option>
<option value=2 <?php echo (($EditArr['CodeAction'] == 1) ? 'selected' : '')?>><?php echo $Lang['CatchCode']?></option>
</select>
</td></tr>

<tr id="PageTempl"><td class=FormLeftTd width=150>
<div id="PageName"><?php echo ((ValidVar($EditArr['RedirOnly']) == 1) ? $Lang['Template2'] : $Lang['Template'])?></div>
</td><td class=FormRightTd>
<input type=text size=70 id="Templ" name="EditArr[Templ]" value="<?php echo htmlspecialchars(stripslashes($EditArr['Templ']))?>">
</td></tr>





<tr ID="RedirUrl"><td class=FormLeftTd width=150>
<?php echo $Lang['RedirTo']?>
</td><td class=FormRightTd>
<input type=text ID="RedirUrlText" name="EditArr[RedirUrl]" value="<?php echo htmlspecialchars(stripslashes(urldecode($EditArr['RedirUrl'])))?>" size=70>
</td></tr>

<tr ID="DynamicRedir"><td class=FormLeftTd width=150>
<?php echo $Lang['DynamicUrl']?>
</td><td class=FormRightTd>
<input type=checkbox ID="DynamicCheck" name="EditArr[Dynamic]" value=1 <?php echo (ValidVar($EditArr['Dynamic'])) ? 'checked' : ''?> onclick="ChangeForm();">
</td></tr>

<tr><td class=FormLeftTd width=150>
<?php echo $Lang['ActionActive']?>
</td><td class=FormRightTd>
<input type=checkbox name="EditArr[Active]" value=1 <?php echo (ValidVar($EditArr['Active'])) ? 'checked' : ''?>>
</td></tr>


</table>


<table class=SubmitTable>
<tr><td class=SubmitLeftTd>
</td><td class=SubmitRightTd>
<input type=submit value="<?php echo $Lang['Save']?>">
</td></tr>
</table>

</form>

<div ID="ActionHelpOnPage" style="background:#ffffff;padding:14px;color:#000000"><?php echo $Lang['ActionHelpOnPage']?></div>
<div ID="ActionHelpRedir" style="background:#ffffff;padding:14px;color:#000000"><?php echo $Lang['ActionHelpRedir']?></div>
<div ID="ActionHelpCode" style="background:#ffffff;padding:14px;color:#000000"><?php echo $Lang['ActionHelpCode']?></div>


<SCRIPT LANGUAGE="JavaScript">
<!--
ChangeForm();
//-->
</SCRIPT>

<?}?>
<!---->


<?}?>

<?if (ValidArr($ActionsArr)&&$Mode=="list") {?>

<table class=ListTable>

<?for ($i=0;$i<count($ActionsArr);$i++) {
	$Row=$ActionsArr[$i];?>

	<tr>
	<td class=<?php echo $Row->_STYLE?>>
	<table width=100% cellpadding=0 cellspacing=0 border=0>

	<td width=100%>
	<span style="line-height:16px;">
	<B style="color:#000000">
	<?if ($Row->ACTIVE!=1) {?>
	<span style="font-size:10px;color:999999"><?php echo ToUpper($Lang['NotActive'])?></span>&nbsp;
	<?}?>
	<?php echo $Row->NAME?></B>
	<?if ($Row->PATH||$Row->QUERY) {?>
	(
	<?if ($Row->PATH) echo $Row->PATH?>
	<?if ($Row->QUERY) echo $Row->QUERY?>
	 )
	 <?}?>
	 <?if ($Row->REDIRECT_CATCH) {?>&nbsp;<B style="font-size:10px;"><?php echo $Lang['RedirOnly']?></B>&nbsp;<?}?>
	<?if ($Row->REDIRECT_URL) echo "<br>".urldecode($Row->REDIRECT_URL);?>

	<?if (!$SiteId) {?>
	<br><span style="font-size:10px;color:999999"><B>(<?php echo $Row->HOST?>)</B></span>
	<?}?>

	</span>
	</td>


	<td class=ListRowLeft>
	<?php
    if ($Row->CODE_ACTION) {
        $nsButtons->Add('icon_link.gif', $Lang['GenerateCode'], getURL('get_code', "CpId=$CpId&SiteId=" . $Row->SITE_ID . '&CodeType=1&CodePlace=3'));
    }
    $nsButtons->Add('edit.gif', $Lang['Edit'], getURL('actions', "CpId=$CpId&SiteId=" . $Row->SITE_ID . '&EditId=' . $Row->ID));
    $nsButtons->Add('delete.gif', $Lang['Delete'], getURL('actions', "CpId=$CpId&SiteId=$SiteId&DeleteId=" . $Row->ID), $Lang['YouSure']);
    $nsButtons->Dump();
    ?>
	</td>
	</tr></table>

	</td></tr>


<?}?>
</table>

<?}?>

<?if (count($ActionsArr)==0&&$Mode=="list") include $nsTemplate->Inc("inc/no_records");?>

<?include $nsTemplate->Inc("inc/footer");?>