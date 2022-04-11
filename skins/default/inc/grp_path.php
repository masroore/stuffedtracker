<div class=ListDiv>
<table class=FormTable>
<tr><td class=ReportSimpleTd>
<?for ($i=0;$i<count($PathArr);$i++) {
	if ($i>0) echo "&nbsp;&raquo;&nbsp;";?>
	<a href="<?php echo getURL('incampaign', 'CampId=' . $PathArr[$i]->ID, 'admin')?>"><?php echo ToUpper(stripslashes($PathArr[$i]->NAME))?></a>
<?}?>
</td></tr>
</table>
</div>