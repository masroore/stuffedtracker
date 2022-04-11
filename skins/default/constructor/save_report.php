<?PostFORM("save_report", "", "admin");?>
<?for($i=0;$i<count($WhereArr);$i++) {?>
<input type=hidden name="WhereArr[<?php echo $i?>][Mode]" value="<?php echo $WhereArr[$i]['Mode']?>">
<input type=hidden name="WhereArr[<?php echo $i?>][Id]" value="<?php echo $WhereArr[$i]['Id']?>">
<input type=hidden name="WhereArr[<?php echo $i?>][OrderBy]" value="<?php echo $WhereArr[$i]['OrderBy']?>">
<input type=hidden name="WhereArr[<?php echo $i?>][OrderTo]" value="<?php echo $WhereArr[$i]['OrderTo']?>">
<?}?>
<input type=hidden name="SaveReport[SaveMode]" value="<?php echo $SaveMode?>">
<input type=hidden name="SaveReport[CpId]" value="<?php echo $CpId?>">
<input type=hidden name="SaveReport[GroupBy]" value="<?php echo $GroupBy?>">
<input type=hidden name="SaveReport[DatesUsed]" value="<?php echo (($DatesUsed) ? '1' : '0')?>">
<input type=hidden name="SaveReport[ViewDate]" value="<?php echo $ViewDate?>">
<input type=hidden name="SaveReport[StartDate]" value="<?php echo $StartDate?>">
<input type=hidden name="SaveReport[EndDate]" value="<?php echo $EndDate?>">
<input type=hidden name="SaveReport[Filter]" value="<?php echo $Filter?>">
<input type=hidden name="SaveReport[Limit]" value="<?php echo $Limit?>">
<input type=hidden name="SaveReport[ShowAll]" value="<?php echo $ShowAll?>">
<input type=hidden name="SaveReport[OrderBy]" value="<?php echo $OrderBy?>">
<input type=hidden name="SaveReport[OrderTo]" value="<?php echo $OrderTo?>">

<table class=CaptionTable>
<tr><td  >
<?php echo $Lang['Title']?>
</td></tr>
</table>

<table  class=FormTable>

<?if (!$DatesUsed) {?>
<tr><td  class=ReportSimpleTd2>
<input type=checkbox value=1 ID="CurrentDate" name="SaveReport[CurrentDate]" <?php echo ((ValidVar($SaveReport['CurrentDate']) == 1) ? 'checked' : '')?>><label for="CurrentDate">&nbsp;<?php echo $Lang['UseCurrentDate']?></label>&nbsp;&nbsp;
</td></tr>
<?}?>

<tr><td  class=ReportSimpleTd2>
<input type=checkbox value=1 ID="AddToMy" name="SaveReport[AddToMy]" <?php echo ((ValidVar($SaveReport['AddToMy']) == 1) ? 'checked' : '')?>><label for="AddToMy">&nbsp;<?php echo $Lang['AddToMy']?></label>&nbsp;&nbsp;
</td></tr>

<tr><td  class=ReportSimpleTd2>
<input type=text size=30 name="SaveReport[Name]" value="<?php echo htmlspecialchars(stripslashes(ValidVar($SaveReport['Name'])))?>">&nbsp;<?php echo $Lang['ReportName']?>
</td></tr>

<tr><td  class=ReportSimpleTd2>
<input type=submit value="<?php echo $Lang['Save']?>">
</td></tr>

</form>
</table>
