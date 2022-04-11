<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>
<script language=javascript>

function ChangeTZ(oSelect) {
	if (oSelect.selectedIndex!=0) return;
	setSessionCookie('<?php echo COOKIE_PFX?>auto_tz', UserTZ(), '/');
}

</script>


<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><td width=70% valign=top>



<?PostFORM();?>
<input type="hidden" name="EditUid" value="<?php echo $EditUid?>">
<?if (!$nsUser->ADMIN||$nsProduct->LICENSE==2) {?>
<input type=hidden name="EditArr[Company]" value=<?php echo $nsUser->COMPANY_ID?>>
<?}?>
<?if (!$nsUser->ADMIN&&!$nsUser->SUPER_USER) {?>
<input type=hidden name="EditArr[Super]" value=0>
<?}?>

<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $TableCaption?>
</td></tr>
</table>



<table  class=FormTable>

<tr><td class=FormLeftTd>
<?php echo $Lang['Login']?>
<?FormError("Login")?>
</td><td class=FormRightTd>
<input type=text  name="EditArr[Login]" value="<?php echo $EditArr['Login']?>" style="width:100%;">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['Pass']?>
<?FormError("Pass")?>
</td><td class=FormRightTd>
<input type=password  name="EditArr[Pass]" style="width:100%;">
</td></tr>


<tr><td class=FormLeftTd>
<?php echo $Lang['Pass2']?>
<?FormError("Pass2")?>
</td><td class=FormRightTd>
<input type=password  name="EditArr[Pass2]" style="width:100%;">
</td></tr>


<tr><td class=FormLeftTd>
<?php echo $Lang['FullName']?>
<?FormError("Name")?>
</td><td class=FormRightTd>
<input type=text  name="EditArr[Name]" value="<?php echo $EditArr['Name']?>" style="width:100%;">
</td></tr>


<tr><td class=FormLeftTd>
<?php echo $Lang['Email']?>
<?FormError("Email")?>
</td><td class=FormRightTd>
<input type=text  name="EditArr[Email]" value="<?php echo $EditArr['Email']?>" style="width:100%;">
</td></tr>

<?if ($nsUser->ADMIN&&$nsProduct->LICENSE!=2) {?>
<tr><td class=FormLeftTd>
<?php echo $Lang['Company']?>
<?FormError("Company")?>
</td><td class=FormRightTd>
<?GenSelect($CompList, "EditArr[Company]", $EditArr['Company'])?>
</td></tr>
<?}?>

<?if (($nsUser->ADMIN||$nsUser->SUPER_USER)&&$nsUser->UserId()!=$EditUid) {?>
<tr><td class=FormLeftTd>
<?php echo $Lang['Super']?>
<?FormError("Super")?>
</td><td class=FormRightTd>
<input type=checkbox name="EditArr[Super]" value=1 name="" <?php echo (($EditArr['Super']) ? 'checked' : '')?>>
</td></tr>

<?if ($nsProduct->LICENSE==3) {?>
<tr><td class=FormLeftTd>
<?php echo $Lang['Demo']?>
</td><td class=FormRightTd>
<input type=checkbox name="EditArr[Demo]" value=1 name="" <?php echo (($EditArr['Demo']) ? 'checked' : '')?>>
</td></tr>
<?}?>

<?}?>

<?if ($nsUser->UserId()==$EditUid) {?>
	<tr><td class=FormLeftTd>
	<?php echo $Lang['IgnoreMe']?>
	</td><td class=FormRightTd>
	<input type=checkbox name="EditArr[Ignore]" value=1 name="" <?php echo (($EditArr['Ignore']) ? 'checked' : '')?>>
	</td></tr>

	<tr><td class=FormLeftTd>
	<?php echo $Lang['AdvMode']?>
	</td><td class=FormRightTd>
	<input type=checkbox name="EditArr[AdvMode]" value=1 name="" <?php echo (($EditArr['AdvMode']) ? 'checked' : '')?>>
	</td></tr>

	<?if (count($SkinsArr)>1) {?>
	<tr><td class=FormLeftTd>
	<?php echo $Lang['Skin']?>
	</td><td class=FormRightTd>
	<select name="EditArr[DefSkin]">
	<?for($i=0;$i<count($SkinsArr);$i++) {?>
		<option value="<?php echo $SkinsArr[$i]?>" <?php echo (($SkinsArr[$i] == $nsUser->USKIN) ? 'selected' : '')?>><?php echo $SkinsArr[$i]?></option>
	<?}?>
	</select>
	</td></tr>
	<?}?>


	<?if (count($LangsArr)>1) {?>
	<tr><td class=FormLeftTd>
	<?php echo $Lang['Lang']?>
	</td><td class=FormRightTd>
	<select name="EditArr[DefLang]">
	<?for($i=0;$i<count($LangsArr);$i++) {?>
		<option value="<?php echo $LangsArr[$i]['name']?>" <?php echo (($LangsArr[$i]['name'] == $nsUser->ULANG) ? 'selected' : '')?>><?php echo $LangsArr[$i]['caption']?></option>
	<?}?>
	</select>
	</td></tr>
	<?}?>

	<tr><td class=FormLeftTd>
	<?php echo $Lang['HelpMode']?>
	</td><td class=FormRightTd>
	<select name="EditArr[HelpMode]">
	<option value=0 <?php echo (($EditArr['HelpMode'] == 0) ? 'selected' : '')?>><?php echo $Lang['HelpMode0']?></option>
	<option value=1 <?php echo (($EditArr['HelpMode'] == 1) ? 'selected' : '')?>><?php echo $Lang['HelpMode1']?></option>
	<option value=2 <?php echo (($EditArr['HelpMode'] == 2) ? 'selected' : '')?>><?php echo $Lang['HelpMode2']?></option>
	</select>
	</td></tr>

	<tr><td class=FormLeftTd>
	<?php echo $Lang['Timezone']?>
	</td><td class=FormRightTd>
	<select id="TZSelect" name="EditArr[TZ]" onchange="ChangeTZ(this)">
	<option value='a' <?php echo (($EditArr['TZ'] == 'a') ? 'selected' : '')?>><?php echo $Lang['AutoTZ']?></option>

	<option value='-12' <?php echo (($EditArr['TZ'] == '-12') ? 'selected' : '')?>>(GMT - 12:00 hours) Enitwetok, Kwajalien</option>
	<option value='-11' <?php echo (($EditArr['TZ'] == '-11') ? 'selected' : '')?>>(GMT - 11:00 hours) Midway Island, Samoa</option>
	<option value='-10' <?php echo (($EditArr['TZ'] == '-10') ? 'selected' : '')?>>(GMT - 10:00 hours) Hawaii</option>
	<option value='-9' <?php echo (($EditArr['TZ'] == '-9') ? 'selected' : '')?>>(GMT - 9:00 hours) Alaska</option>
	<option value='-8' <?php echo (($EditArr['TZ'] == '-8') ? 'selected' : '')?>>(GMT - 8:00 hours) Pacific Time (US &amp; Canada)</option>
	<option value='-7' <?php echo (($EditArr['TZ'] == '-7') ? 'selected' : '')?>>(GMT - 7:00 hours) Mountain Time (US &amp; Canada)</option>
	<option value='-6' <?php echo (($EditArr['TZ'] == '-6') ? 'selected' : '')?>>(GMT - 6:00 hours) Central Time (US &amp; Canada), Mexico City</option>
	<option value='-5' <?php echo (($EditArr['TZ'] == '-5') ? 'selected' : '')?>>(GMT - 5:00 hours) Eastern Time (US &amp; Canada), Bogota, Lima</option>
	<option value='-4' <?php echo (($EditArr['TZ'] == '-4') ? 'selected' : '')?>>(GMT - 4:00 hours) Atlantic Time (Canada), Caracas, La Paz</option>
	<option value='-3.5' <?php echo (($EditArr['TZ'] == '-3.5') ? 'selected' : '')?>>(GMT - 3:30 hours) Newfoundland</option>
	<option value='-3' <?php echo (($EditArr['TZ'] == '-3') ? 'selected' : '')?>>(GMT - 3:00 hours) Brazil, Buenos Aires, Falkland Is.</option>
	<option value='-2' <?php echo (($EditArr['TZ'] == '-2') ? 'selected' : '')?>>(GMT - 2:00 hours) Mid-Atlantic, Ascention Is., St Helena</option>
	<option value='-1' <?php echo (($EditArr['TZ'] == '-1') ? 'selected' : '')?>>(GMT - 1:00 hours) Azores, Cape Verde Islands</option>
	<option value='0' <?php echo (($EditArr['TZ'] == '0') ? 'selected' : '')?>>(GMT) Casablanca, Dublin, London, Lisbon, Monrovia</option>
	<option value='1' <?php echo (($EditArr['TZ'] == '1') ? 'selected' : '')?>>(GMT + 1:00 hours) Brussels, Copenhagen, Madrid, Paris</option>
	<option value='2' <?php echo (($EditArr['TZ'] == '2') ? 'selected' : '')?>>(GMT + 2:00 hours) Kaliningrad, South Africa</option>
	<option value='3' <?php echo (($EditArr['TZ'] == '3') ? 'selected' : '')?>>(GMT + 3:00 hours) Baghdad, Riyadh, Moscow, Nairobi</option>
	<option value='3.5' <?php echo (($EditArr['TZ'] == '3.5') ? 'selected' : '')?>>(GMT + 3:30 hours) Tehran</option>
	<option value='4' <?php echo (($EditArr['TZ'] == '4') ? 'selected' : '')?>>(GMT + 4:00 hours) Abu Dhabi, Baku, Muscat, Tbilisi</option>
	<option value='4.5' <?php echo (($EditArr['TZ'] == '4.5') ? 'selected' : '')?>>(GMT + 4:30 hours) Kabul</option>
	<option value='5' <?php echo (($EditArr['TZ'] == '5') ? 'selected' : '')?>>(GMT + 5:00 hours) Ekaterinburg, Karachi, Tashkent</option>
	<option value='5.5' <?php echo (($EditArr['TZ'] == '5.5') ? 'selected' : '')?>>(GMT + 5:30 hours) Bombay, Calcutta, Madras, New Delhi</option>
	<option value='6' <?php echo (($EditArr['TZ'] == '6') ? 'selected' : '')?>>(GMT + 6:00 hours) Almaty, Colomba, Dhakra</option>
	<option value='7' <?php echo (($EditArr['TZ'] == '7') ? 'selected' : '')?>>(GMT + 7:00 hours) Bangkok, Hanoi, Jakarta</option>
	<option value='8' <?php echo (($EditArr['TZ'] == '8') ? 'selected' : '')?>>(GMT + 8:00 hours) Hong Kong, Perth, Singapore, Taipei</option>
	<option value='9' <?php echo (($EditArr['TZ'] == '9') ? 'selected' : '')?>>(GMT + 9:00 hours) Osaka, Sapporo, Seoul, Tokyo, Yakutsk</option>
	<option value='9.5' <?php echo (($EditArr['TZ'] == '9.5') ? 'selected' : '')?>>(GMT + 9:30 hours) Adelaide, Darwin</option>
	<option value='10' <?php echo (($EditArr['TZ'] == '10') ? 'selected' : '')?>>(GMT + 10:00 hours) Melbourne, Papua New Guinea, Sydney</option>
	<option value='11' <?php echo (($EditArr['TZ'] == '11') ? 'selected' : '')?>>(GMT + 11:00 hours) Magadan, New Caledonia, Solomon Is.</option>
	<option value='12' <?php echo (($EditArr['TZ'] == '12') ? 'selected' : '')?>>(GMT + 12:00 hours) Auckland, Fiji, Marshall Island</option>
	</select>
	</td></tr>


	<tr><td class=FormLeftTd>
	<?php echo $Lang['PageEnc']?>
	</td><td class=FormRightTd>
	<input type=text  name="EditArr[Enc]" value="<?php echo $EditArr['Enc']?>" style="width:100%;">
	</td></tr>

<?}?>






</table>

<table class=SubmitTable>
<tr><td class=SubmitLeftTd>
</td><td class=SubmitRightTd>
<input type=submit value="<?php echo $Lang['Save']?>">
</td></tr>
</table>




</td>
<td><IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="10" HEIGHT="1" BORDER="0" ALT=""></td>
<td width=30% valign=top>

<?if ($nsUser->UserId()==$EditUid) {?>

<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $Lang['ShowCol']?>
</td></tr>
</table>


<table  class=FormTable>

<tr><td class=FormLeftTd>
<input type=checkbox ID=ColHits name="EditArr[ColHits]" value=1 <?php echo (($EditArr['ColHits'] == 1) ? 'checked' : '')?>><label for="ColHits">&nbsp;<?php echo $Lang['ColHits']?></label><br><br>

<input type=checkbox ID=ColClicks name="EditArr[ColClicks]" value=1 <?php echo (($EditArr['ColClicks'] == 1) ? 'checked' : '')?>><label for="ColClicks">&nbsp;<?php echo $Lang['ColClicks']?></label><br><br>


<input type=checkbox ID=ColSales name="EditArr[ColSales]" value=1 <?php echo (($EditArr['ColSales'] == 1) ? 'checked' : '')?>><label for="ColSales">&nbsp;<?php echo $Lang['ColSales']?></label><br><br>

<input type=checkbox ID=ColActions name="EditArr[ColActions]" value=1 <?php echo (($EditArr['ColActions'] == 1) ? 'checked' : '')?>><label for="ColActions">&nbsp;<?php echo $Lang['ColActions']?></label><br><br>

<input type=checkbox ID=ColROI name="EditArr[ColROI]" value=1 <?php echo (($EditArr['ColROI'] == 1) ? 'checked' : '')?>><label for="ColROI">&nbsp;<?php echo $Lang['ColROI']?></label><br><br>

<input type=checkbox ID=ColConv name="EditArr[ColConv]" value=1 <?php echo (($EditArr['ColConv'] == 1) ? 'checked' : '')?>><label for="ColConv">&nbsp;<?php echo $Lang['ColConv']?></label><br><br>


<input type=checkbox ID=Graphs name="EditArr[Graphs]" value=1 <?php echo (($EditArr['Graphs'] == 1) ? 'checked' : '')?>><label for="Graphs">&nbsp;<?php echo $Lang['Graphs']?></label><br><br>



</td></tr>


</table>


<?}?>

</td></tr></table>

</form>


<?include $nsTemplate->Inc("inc/footer");?>