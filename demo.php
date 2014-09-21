<?php

include('toon.class.php');

$toon = new Toon('your_email','your_password');
$toon->login();

$tempinfo 	= $toon->get_thermostat_info();


var_dump($tempinfo);
// Output something like:

// array (size=16)
//   'currentTemp' => int 2275			--> Like 22,75 degrees celsius
//   'currentSetpoint' => int 1600
//   'currentDisplayTemp' => int 2250
//   'programState' => int 1
//   'activeState' => int 2 			--> Program 2 is active
//   'nextProgram' => int 1
//   'nextState' => int 1
//   'nextTime' => int 1411369200
//   'nextSetpoint' => int 1900
//   'randomConfigId' => int 1804289383
//   'errorFound' => int 255
//   'zwaveOthermConnected' => int 0
//   'burnerInfo' => string '0' (length=1)
//   'otCommError' => string '0' (length=1)
//   'currentModulationLevel' => int 0
//   'haveOTBoiler' => int 1


$toon->logout(); //Don't skip the logout!

?>