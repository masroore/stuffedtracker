<?include $nsTemplate->Inc("inc/header");?>
<?include $nsTemplate->Inc("inc/submenu");?>



<?if (isset($AgentsList)&&is_array($AgentsList)) {?>


<table class=ListTable>

<?for ($i=0;$i<count($AgentsList);$i++) {
	$Row=$AgentsList[$i];?>

	<tr>
	<td  class=<?php echo $Row->_STYLE?>>
	<table width=100% cellpadding=0 cellspacing=0 border=0>
	<tr><td width=100%><p>


	<B><?php echo $Row->NAME?></B> (<?php echo $Row->EMAIL?>)<br>
	<I><?php echo $Row->LOGIN?></I>
	</td><td>

	<?php
    $nsButtons->Add('redo.gif', $Lang['MakeAdmin'], getURL('agents', 'MakeAdmin=' . $Row->ID));
    $nsButtons->Dump();
    ?>
	</td></tr></table>

	</td></tr>
<?}?>


</table>
</div>

<?}?>


<?include $nsTemplate->Inc("inc/footer");?>