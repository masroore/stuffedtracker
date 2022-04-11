<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>


<?PostFORM();?>
<input type="hidden" name="EditId" value="<?php echo $EditId?>">
<input type="hidden" name="Mode" value="<?php echo $Mode?>">


<table class=CaptionTable>
<tr><td class=CaptionTd>
<?php echo $TableCaption?>
</td></tr>
</table>



<table  class=FormTable>

<tr><td class=FormLeftTd>
<?php echo $Lang['Domen']?>
<?FormError("Host")?>
</td><td class=FormRightTd>
<input type=text name="EditArr[Host]" value="<?php echo $EditArr['Host']?>" style="width:100%;">
</td></tr>


<tr><td class=FormLeftTd>
<?php echo $Lang['KeyVarName']?>
<?FormError("KeyVar")?>
</td><td class=FormRightTd>
<input type=text name="EditArr[KeyVar]" value="<?php echo $EditArr['KeyVar']?>" style="width:100%;">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['StatHostIgnor']?>
<?FormError("Ban")?>
</td><td class=FormRightTd>
<input type=checkbox name="EditArr[Ban]" value=1 <?php echo (($EditArr['Ban'] == 1) ? 'checked' : '')?>>
</td></tr>

</table>

<table class=SubmitTable>
<tr><td class=SubmitLeftTd>
</td><td class=SubmitRightTd>
<input type=submit value="<?php echo $Lang['Save']?>">
</td></tr>
</table>

</form>



<?if (ValidArr($Refs)&&count($Refs)>0) {?>
<div class=ListDiv>
<table class=ListTable>
<?for ($i=0;$i<count($Refs);$i++) {
	$Row=$Refs[$i];?>
	<tr><td class=ListRowRight>
	<a href="<?php echo $Row->REFERER?>" target=_blank><?php echo urldecode(urldecode($Row->REFERER))?></a>
	</td></tr>
<?}?>
</table>
</div>
<?}?>

<?include $nsTemplate->Inc("inc/footer");?>