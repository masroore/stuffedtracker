

<table  class=FormTable>

<tr><td class=FormLeftTd>
<?php echo $Lang['CompanyName']?> *
</td><td class=FormRightTd>
<input type=text  name="CompName" value="<?php echo $CompName?>">
</td></tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['CompanyDescr']?>
</td><td class=FormRightTd>
<textarea style="width:100%" rows=6 name="CompDescr">
<?php echo $CompDescr?>
</textarea>
</td></tr>


<tr><td colspan=2></td></tr>
<tr><td></td>
<td><p><?php echo $Lang['SiteDomainDescr']?></p></td>
</tr>

<tr><td class=FormLeftTd>
<?php echo $Lang['SiteDomain']?>
</td><td class=FormRightTd>
<input type=text  name="SiteDomain" value="<?php echo $SiteDomain?>">
</td></tr>



</table>
