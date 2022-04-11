<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>

<script language="javascript">

var IpsArr= new Array();
<?for ($i=0;$i<count($IpList);$i++) {
	echo "IpsArr[$i]='".$IpList[$i]->IP."';\n";
}?>
function SelectAll()
{
	for (i=0;i<IpsArr.length;i++) {
		Obj=GetObj("RemoveIP["+IpsArr[i]+"]");
		Obj.checked=true;
	}
}

function DeselectAll()
{
	for (i=0;i<IpsArr.length;i++) {
		Obj=GetObj("RemoveIP["+IpsArr[i]+"]");
		Obj.checked=false;
	}
}
</script>

<div class=FormDiv>
<table width=100%>
<tr><td class=FormHeader>
<?GetFORM();?>
<B style="color:#000000"><?php echo $Lang['AddIgnore']?>:</B>&nbsp;
<input type=text size=15 name="NewIp" id="NewIp">
&nbsp;<span style="color:#000000"><?php echo $Lang['AddIgnoreDescr']?>:</span>&nbsp;
<input type=text size=20 name="NewIpDescr">
<input type=submit value="<?php echo $Lang['Add']?>">&nbsp;
<input type=button value="<?php echo $Lang['MyIp']?>" onclick="GetObj('NewIp').value='<?php echo $MyIP?>';">
</form>
</td></tr></table></div>
<IMG SRC="<?php echo FileLink('images/0.gif'); ?>" WIDTH="1" HEIGHT="10" BORDER="0" ALT="">


<?if (count($IpList)>0) {?>
<table class=ListTable>
	<?PostFORM();?>
		<tr height=30><td colspan=2 style="padding-left:10px;">
		<a href="javascript:;" onclick="SelectAll();"><?php echo $Lang['SelectAll']?></a> / <a href="javascript:;" onclick="DeselectAll();"><?php echo $Lang['DeselectAll']?></a>
		</td></tr>
	<?for($i=0;$i<count($IpList);$i++) {?>

		<tr height=30><td style="padding-left:10px;">
		<input type=hidden name="RemoveIP[<?php echo $IpList[$i]->IP?>]" value=0>
		<input type=checkbox id="RemoveIP[<?php echo $IpList[$i]->IP?>]" name="RemoveIP[<?php echo $IpList[$i]->IP?>]" value=1>
		</td>
		<td width=100%>
		<b><?php echo $IpList[$i]->IP?></b>
		<?if ($IpList[$i]->DESCRIPTION) {echo "&nbsp;".$IpList[$i]->DESCRIPTION;}?>
		</td></tr>

	<?}?>
		<tr height=30><td colspan=2 style="padding-left:10px;">
		<input type=submit value="<?php echo $Lang['DeleteSelected']?>">
		</td></tr>
	</form>
</table>
<?}?>


<?include $nsTemplate->Inc("inc/footer");?>
