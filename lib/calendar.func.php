<script language="JavaScript" src="<?php echo FileLink('dobj.js'); ?>"></script>
<SCRIPT LANGUAGE="JavaScript">

var WeekDays = new Array();
WeekDays[1] = '<?php echo $Lang['DayOfWeekCal'][1]?>';
WeekDays[2] = '<?php echo $Lang['DayOfWeekCal'][2]?>';
WeekDays[3] = '<?php echo $Lang['DayOfWeekCal'][3]?>';
WeekDays[4] = '<?php echo $Lang['DayOfWeekCal'][4]?>';
WeekDays[5] = '<?php echo $Lang['DayOfWeekCal'][5]?>';
WeekDays[6] = '<?php echo $Lang['DayOfWeekCal'][6]?>';
WeekDays[7] = '<?php echo $Lang['DayOfWeekCal'][0]?>';

var Months = new Array();
Months[1] = '<?php echo $Lang['MonthName'][1]?>';
Months[2] = '<?php echo $Lang['MonthName'][2]?>';
Months[3] = '<?php echo $Lang['MonthName'][3]?>';
Months[4] = '<?php echo $Lang['MonthName'][4]?>';
Months[5] = '<?php echo $Lang['MonthName'][5]?>';
Months[6] = '<?php echo $Lang['MonthName'][6]?>';
Months[7] = '<?php echo $Lang['MonthName'][7]?>';
Months[8] = '<?php echo $Lang['MonthName'][8]?>';
Months[9] = '<?php echo $Lang['MonthName'][9]?>';
Months[10] = '<?php echo $Lang['MonthName'][10]?>';
Months[11] = '<?php echo $Lang['MonthName'][11]?>';
Months[12] = '<?php echo $Lang['MonthName'][12]?>';

var DF = "Y-m-d";
var DFD = "-";
var MinYear=<?php echo ((isset($MinYear)) ? $MinYear : 2005)?>;
var MaxYear=<?php echo ((isset($MaxYear)) ? $MaxYear : date('Y'))?>;
var CloseAfterSelect=true;
var CalendarShowed=true;
var PrevReturnField=false;
var TodayIs="<?php echo $Lang['TodayIs']?>";
var SelectedTZ=false;

if (getCookie('<?php echo COOKIE_PFX?>auto_tz')) SelectedTZ=0;
else SelectedTZ = <?php echo $nsUser->TZ?>;



</SCRIPT>
<script language="JavaScript" src="<?php echo FileLink('calendar.js'); ?>"></script>
