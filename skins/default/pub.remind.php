<?include $nsTemplate->Inc("inc/header");?>

<div style="width:500">

<?PostFORM();?>
<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $TableCaption?>
</td></tr>
</table>

<table class=FormTable>


<tr><td class=FormLeftTd>
<p><b><?php echo $Lang['Email']?></b></p>
</td>
<td class=FormRightTd>
<input type=text  name="Email" value="">
</td></tr>

<tr><td class=FormLeftTd>
</td>
<td class=FormRightTd>
<p><a href="<?php echo getURL('login', '', 'admin')?>">&raquo;&nbsp;<?php echo $Lang['Login']?></a></p>
</td></tr>


</table>

<table class=SubmitTable>
<tr><td class=SubmitLeftTd>

</td><td class=SubmitRightTd>
<input type=submit value="<?php echo $Lang['SendNewPass']?>">
</td></tr>
</table>

</form>

</div>

<?include $nsTemplate->Inc("inc/footer");?>