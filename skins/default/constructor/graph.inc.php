<table ID="<?php echo $this->ID?>" style="page-break-inside:avoid;display:<?php echo (($this->Display) ? '' : 'none')?>;" width=100% cellpadding=10 cellspacing=0 border=0>
<tr><td width="100%">
<p style="color:#000000"><b><?php echo $this->Name?></b></p>
</td></tr>
<tr>
<td width="100%">

		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
		codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0"
		width="100%" height="330"  align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="movie" value="<?php echo $this->Path?>" />
		<param name="flashVars" value="<?php echo $this->FlashVars?>" />
		<param name="quality" value="high" />
		<param name="bgcolor" value="#ffffff" />
		<embed src="<?php echo $this->Path?>" quality="high" bgcolor="#ffffff"
		flashvars="<?php echo $this->FlashVars?>"
		width="100%" height="330" align="middle"
		allowScriptAccess="sameDomain" type="application/x-shockwave-flash"
		pluginspage="http://www.macromedia.com/go/getflashplayer" />
		</object>

</td></tr>
</table>
		<?if ($this->Display) {?>
		<SCRIPT LANGUAGE="JavaScript">
		<!--
		CurGraph=GetObj('<?php echo $this->ID?>');
		//-->
		</SCRIPT>
		<?}?>