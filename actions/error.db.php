<?php

/////////////////////////////////////////////
///////// permission check here

/////////////////////////////////////////////
///////// require libraries here

/////////////////////////////////////////////
///////// prepare any variables
$PageTitle = $Lang['ErrorName'];
$Logs->Clear();
$Logs->Err($Lang['DbError']);

/////////////////////////////////////////////
///////// call any process functions

/////////////////////////////////////////////
///////// display section here
include $nsTemplate->Inc('clear');

/////////////////////////////////////////////
///////// process functions here

/////////////////////////////////////////////
///////// library section
