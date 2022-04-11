<?include $nsTemplate->Inc("inc/header");?>




<div style="width:500">

<?PostFORM();?>
<input type="hidden" name="go_auth" value="go_auth">
<input type="hidden" name="xref" value="<?php echo $xref?>">

<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $TableCaption?>
</td></tr>
</table>

<table class=FormTable>


<tr><td class=FormLeftTd>
<p><b><?php echo $Lang['Login']?></b></p>
</td>
<td class=FormRightTd>
<input type=text  name="xlogin" value="<?php echo $xlogin?>" style="width:100%;">
</td></tr>

<tr><td class=FormLeftTd>
<p><b><?php echo $Lang['Pass']?></b></p>
</td>
<td class=FormRightTd>
<input type=password  name="xpwd" style="width:100%;">
</td></tr>

<tr><td class=FormLeftTd>
<p><b><?php echo $Lang['Remember']?></b></p>
</td>
<td class=FormRightTd>
<input type=checkbox value=1 name=recall>
</td></tr>

<tr><td class=FormLeftTd>
</td>
<td class=FormRightTd>
<p><a href="<?php echo getURL('remind', '', 'pub')?>">&raquo;&nbsp;<?php echo $Lang['ForgotPass']?></a></p>
</td></tr>


</table>

<table class=SubmitTable>
<tr><td class=SubmitLeftTd>
</td><td class=SubmitRightTd>
<input type=submit value="<?php echo $Lang['Enter']?>">
</td></tr>
</table>

</form>

</div>

<?include $nsTemplate->Inc("inc/footer");?>