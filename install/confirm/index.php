

<div  style="padding-left:10px;">

<br>
<B><?php echo $Lang['License']?></B><br><br>
<?php echo $Lang['Type']?>:
<?if (ValidVar($_REQUEST['Trial'])) {?>
<?php echo $Lang['TrialVersion']?>
<?}?>
<?if ($LcP==3&&!$Trial) {?>
<?php echo $Lang['AgencyVersion']?>
<?}?>
<?if ($LcP==2&&!$Trial) {?>
<?php echo $Lang['MerchantVersion']?>
<?}?>
<br>


<?if (!ValidVar($_REQUEST['Trial'])&&$_REQUEST['LcL']>0) {?>
<?php echo $Lang['NumOfSites']?>:<?php echo $_REQUEST['LcL']?><br>
<?}?>

<?if (!ValidVar($_REQUEST['Trial'])) {?>
<?php echo $Lang['RegisteredTo']?>: <?php echo $_REQUEST['LcCL']?><br>
<?}?>




<br>
<B><?php echo $Lang['DbSettings']?></B><br><br>
<?php echo $Lang['Host']?>: <?php echo $_REQUEST['DbHost']?><br>
<?php echo $Lang['Port']?>: <?php echo $_REQUEST['DbPort']?><br>
<?php echo $Lang['Db']?>: <?php echo $_REQUEST['DbName']?><br>
<?php echo $Lang['DbUsername']?>: <?php echo $_REQUEST['DbUser']?><br>
<?php echo $Lang['DbPass']?>: <?php echo $_REQUEST['DbPass']?><br>
<?php echo $Lang['TablePfx']?>: <?php echo $_REQUEST['DbPref']?><br>

<br>
<B><?php echo $Lang['User']?></B><br><br>
<?php echo $Lang['Login']?>: <?php echo $_REQUEST['RegLogin']?><br>
<?php echo $Lang['Pass']?>: <?php echo $_REQUEST['RegPass']?><br>
<?php echo $Lang['Name']?>: <?php echo $_REQUEST['RegName']?><br>
<?php echo $Lang['Email']?>: <?php echo $_REQUEST['RegEmail']?><br>

<br>
<B><?php echo $Lang['Company']?></B><br><br>
<?php echo $Lang['CompanyName']?>: <?php echo $_REQUEST['CompName']?><br>

<?if (ValidVar($_REQUEST['CompDescr'])) {?>
<span style="color:#aaaaaa"><?php echo $_REQUEST['CompDescr']?></span><br>
<?}?>

<?php echo $Lang['Site']?>: <?php echo $_REQUEST['SiteDomain']?><br>

<br>
<B><?php echo $Lang['More']?></B><br><br>
<?php echo $Lang['UseModR']?>: <?php echo (($_REQUEST['UseModR']) ? $Lang['Yes'] : $Lang['No'])?><br>
<?php echo $Lang['SendUseInfo']?>: <?php echo (($_REQUEST['SendUsage']) ? $Lang['Yes'] : $Lang['No'])?><br>

<br>

</div>