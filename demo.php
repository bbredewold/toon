<?php

include('toon.class.php');

$toon = new Toon('email','password');

$temperatuur = $toon->get_thermostat_info()['currentTemp'] / 100;
echo 'Temperatuur: '.round($temperatuur, 1).'&deg;c';
// echo number_format($temperatuur, 2, ',', '');

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



?>