<table border="0" cellpadding="0" cellspacing="0" width="100%" height="62" bgcolor="#707070">

<tr><td width="20" height="28"><p></p></td>
<td height="28">
	<table width=100% cellpadding=0 cellspacing=0 border=0 height=28>
	<tr><td style="padding-bottom:7px;" valign=bottom>
	<p class=HeaderWelcome style="line-height:8px;"><?php echo $Lang['Welcome']?> <?php echo $nsUser->UserInfo['NAME']?></p>
	</td><td style="padding-bottom:6px;" valign=bottom>

		<table width=100% cellpadding=0 cellspacing=0 border=0>
		<tr><td valign=bottom style="padding-bottom:1px;" align=right nowrap>
		<p class=HeaderMenu>&nbsp;<a href="<?php echo getURL('logoff', '', 'admin')?>"><?php echo $Lang['Logout']?></a>&nbsp;</p>
		</td><td valign=bottom width=11>
		<p><img src="<?php echo FileLink('images/close_01.gif'); ?>" width="11" height="11" border="0" style="margin:0px"></p>
		</td></tr></table>

	</td></tr>
	</table>

</td>
<td width="20" height="28"><p></p></td>
</tr>

<tr><td width="20" height="1">
<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="20" height="1" border="0"></p>
</td><td height="1" bgcolor="#9B9B9B">
<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="1" height="1" border="0"></p>
</td><td width="20" height="1" bgcolor="#9B9B9B">
<p><img src="<?php echo FileLink('images/0.gif'); ?>" width="20" height="1" border="0"></p>
</td></tr>

<tr>
<td width="20" height="33"><p></p></td>
<td height="33" valign="top">

	<table width=100% cellpadding=0 cellspacing=0 border=0>
	<tr><td style="padding-top:5px;" valign=top nowrap>
	<p class=HeaderMenu>
	<a href="<?php echo getURL('default', '', 'admin'); ?>"><?php echo $Lang['Home']?></a> |
	<a href="<?php echo getURL($nsUser->EditFile, 'EditUid=' . $nsUser->UserId(), 'admin')?>"><?php echo $Lang['Profile']?></a> |
	<B><a href="<?php echo getURL('my_tracker', '', 'admin'); ?>"><?php echo $Lang['MyTracker']?>&nbsp;<IMG SRC="<?php echo FileLink('images/close_05.gif'); ?>" WIDTH="7" HEIGHT="5" BORDER="0" ALT=""></a></B>
	</p>
	</td><td align=right style="padding-top:5px;" valign=top>

		<table width=100% cellpadding=0 cellspacing=0 border=0>
		<tr><td valign=top align=right nowrap>
		<?if (!($nsUser->MERCHANT&&!$nsUser->SUPER_USER)) {?>
		<p class=HeaderMenu>&nbsp;<a href="<?php echo getURL('admin', '', 'admin'); ?>"><?php echo $Lang['Administr']?></a>&nbsp;</p>
		<?}?>
		</td><td width=11 valign=top style="padding-top:1px;">
		<?if (!($nsUser->MERCHANT&&!$nsUser->SUPER_USER)) {?>
		<p><img src=" <?php echo FileLink('images/close_02.gif'); ?>" width="11" height="11" border="0" style="margin:0px"></p>
		<?}?>
		</td></tr>
		</table>

	</td></tr>
	</table>

</td>
<td width="20" height="33"><p></p></td>
</tr>
</table>