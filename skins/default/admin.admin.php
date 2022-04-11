<?$PageTitle=$Lang['Title']?>
<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>


<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><td width=18%>

</td><td width=82%>


	<table  cellpadding=6 cellspacing=0 border=0 width=100%>
	<?if ($nsUser->ADMIN||($nsUser->MERCHANT&&$nsUser->SUPER_USER)) {?>
	<tr>
	<td valign=top width=32><p><IMG SRC="<?php echo FileLink('images/admin_account.gif'); ?>" WIDTH="32" align=middle vspace=2 hspace=5 HEIGHT="24" BORDER="0" ALT=""></p></td>
	<td  width="100%" valign="top"><span class=SectionName><?php echo $Lang['AdmAcc']?></span>

	<table width=100% cellpadding=0 cellspacing=0 border=0 class=SectionTable>

	<?if ($nsUser->ADMIN&&$nsProduct->LICENSE==3) {?>
	<tr><td class=SectionTd>
	<a href="<?php echo getURL('company', '', 'admin')?>"><?php echo $Lang['AdmClnt']?></a>
	</td></tr>
	<?}?>

	<?if ($nsUser->MERCHANT||$nsProduct->LICENSE!=3) {?>
	<tr><td class=SectionTd>
	<a href="<?php echo getURL('company', 'EditId=' . $nsUser->COMPANY_ID, 'admin')?>"><?php echo $Lang['ClientEdit']?></a>
	</td></tr>
	<?}?>

	<?if ($nsUser->ADMIN||($nsUser->MERCHANT&&$nsUser->SUPER_USER)) {?>
	<tr><td class=SectionTd>
	<a href="<?php echo getURL('users', '', 'admin')?>"><?php echo $Lang['AdmUsers']?></a>
	</td></tr>
	<?}?>

	<?if ($nsUser->ADMIN&&$nsUser->SUPER_ADMIN&&$nsProduct->LICENSE==3) {?>
	<tr><td class=SectionTd>
	<a href="<?php echo getURL('agents', '', 'admin')?>"><?php echo $Lang['AdmAgents']?></a>
	</td></tr>
	<?}?>

	</table>

	</td>
	</tr>
	<?}?>


	<?if (($nsProduct->LICENSE!=3&&$nsUser->SUPER_USER)||$nsUser->ADMIN) {?>
	<tr>
	<td valign=top width=32><p><IMG SRC="<?php echo FileLink('images/admin_db.gif'); ?>" WIDTH="32" align=middle vspace=2 hspace=5 HEIGHT="24" BORDER="0" ALT=""></p></td>
	<td  width="100%" valign="top"><span class=SectionName><?php echo $Lang['BaseStruct']?></span>

	<table width=100% cellpadding=0 cellspacing=0 border=0 class=SectionTable>

	<tr><td class=SectionTd>
	<a href="<?php echo getURL('natural_host', '', 'admin')?>"><?php echo $Lang['NaturalHosts']?></a>
	</td></tr>

	<tr><td class=SectionTd>
	<a href="<?php echo getURL('user_agent', '', 'admin')?>"><?php echo $Lang['UserAgents']?></a>
	</td></tr>

	<tr><td class=SectionTd>
	<a href="<?php echo getURL('base_stat', '', 'admin')?>"><?php echo $Lang['Database']?></a>
	</td></tr>

	<tr><td class=SectionTd>
	<a href="<?php echo getURL('ip_ignore', '', 'admin')?>"><?php echo $Lang['IpIgnore']?></a>
	</td></tr>

	<tr><td class=SectionTd>
	<a href="<?php echo getURL('countries', '', 'admin')?>"><?php echo $Lang['ImportCountries']?></a>
	</td></tr>

	</table>
	</td></tr>
	<?}?>

	<?if ($nsUser->ADMIN&&$nsProduct->LICENSE==3) {?>
	<tr>
	<td valign=top width=32><p><IMG SRC="<?php echo FileLink('images/admin_track.gif'); ?>" WIDTH="32" align=middle vspace=2 hspace=5 HEIGHT="24" BORDER="0" ALT=""></p></td>
	<td  width="100%" valign="top"><span class=SectionName><?php echo $Lang['TrackSets']?></span>

	<table width=100% cellpadding=0 cellspacing=0 border=0 class=SectionTable>

	<tr><td class=SectionTd>
	<a href="<?php echo getURL('group_order', 'Mode=NATURAL', 'admin')?>"><?php echo $Lang['NaturalGroupOrder']?></a>
	</td></tr>

	<tr><td class=SectionTd>
	<a href="<?php echo getURL('group_order', 'Mode=PAID', 'admin')?>"><?php echo $Lang['PaidGroupOrder']?></a>
	</td></tr>

	<tr><td class=SectionTd>
	<a href="<?php echo getURL('stat_config', '', 'admin')?>"><?php echo $Lang['CatchSets']?></a>
	</td></tr>

	<tr><td class=SectionTd>
	<a href="<?php echo getURL('stat_dbl_click', '', 'admin')?>"><?php echo $Lang['DblClickSets']?></a>
	</td></tr>

	</table>

	</td></tr>
	<?}?>

	<?if ($nsUser->ADMIN||($nsUser->SUPER_USER&&$nsProduct->LICENSE!=3)) {?>
	<tr>
	<td valign=top width=32><p><IMG SRC="<?php echo FileLink('images/admin_general.gif'); ?>" WIDTH="32" align=middle hspace=5 HEIGHT="28" BORDER="0" ALT=""></p></td>
	<td  width="100%" valign="top"><span class=SectionName><?php echo $Lang['ProgramSets']?></span>

	<table width=100% cellpadding=0 cellspacing=0 border=0 class=SectionTable>

	<tr><td class=SectionTd>
	<a href="<?php echo getURL('misc_config', '', 'admin')?>"><?php echo $Lang['GeneralSets']?></a>
	</td></tr>

	<tr><td class=SectionTd>
	<a href="<?php echo getURL('license', '', 'admin')?>"><?php echo $Lang['LicenseKeys']?></a>
	</td></tr>

	<?if ($UpdatesAvailable>0) {?>
		<tr><td class=SectionTd>
		<a href="<?php echo getURL('update', '', 'admin')?>"><?php echo $Lang['Updates']?></a>
		</td></tr>
	<?}?>

		<tr><td class=SectionTd>
		<a href="<?php echo getURL('versioncheck', '', 'admin')?>"><?php echo $Lang['CheckUpdates']?></a>
		</td></tr>

	</table>

	</td></tr>
	<?}?>

	</table>


	</td>
	</tr>
</table>



<?include $nsTemplate->Inc("inc/footer");?>