
<p><B><?php echo $Lang['CodeDescription']?></B></p>

<textarea style="width:100%" rows=10 readonly  onclick="this.select();">
<?php echo $ResultCode?>
</textarea>


<br><br>
<p align=center style="font-size:13px;font-weight:bold;">
<span class=GlobalMsg><?php echo $Lang['InstallFinished']?></span><br>
<?php echo str_replace('{LINK}', GetUrl('default', 'admin'), $Lang['ClickHere'])?>

</p>