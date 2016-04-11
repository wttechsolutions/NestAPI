<?php

// Your Nest username and password.
$username = 'mbadali25@gmail.com';
$password = 'D3adye325';

// The timezone you're in.
// See http://php.net/manual/en/timezones.php for the possible values.
date_default_timezone_set('America/Chicago');

// Here's how to use this class:

require_once 'autoload.php'; // Or use composer

use Nest\Nest as Nest;

$nest = new Nest($username, $password);

echo "Location information:\n";
$locations = $nest->getUserLocations();
jlog($locations);
echo "----------\n\n";

echo "Devices list (thermostats):\n";
$devices_serials = $nest->getDevices();
jlog($devices_serials);
echo "----------\n\n";

echo "Devices list (Nest Protect):\n";
$protects_serials = $nest->getDevices(Nest::DEVICE_TYPE_PROTECT);
jlog($protects_serials);
echo "----------\n\n";

echo "Device information:\n";
$infos = $nest->getDeviceInfo($devices_serials[0]);
jlog($infos);
echo "----------\n\n";

echo "Current temperature:\n";
printf("%.02f degrees %s\n", $infos->current_state->temperature, $infos->scale);
echo "----------\n\n";

echo "Setting target temperature...\n";
// Note: setting temperatures will use the units you set on the device. I'm using celsius on my device, so I'm using celsius here.
$success = $nest->setTargetTemperature(26);
var_dump($success);

echo "Setting target temperatures (range)...\n";
$success = $nest->setTargetTemperatures(23.0, 26.0);
var_dump($success);

echo "Setting target temperature mode...\n";
$success = $nest->setTargetTemperatureMode(Nest::TARGET_TEMP_MODE_HEAT, 26.0); // Available: TARGET_TEMP_MODE_COOL, TARGET_TEMP_MODE_HEAT, TARGET_TEMP_MODE_RANGE
var_dump($success);

/*echo "Setting target temperature mode (range)...\n";
$success = $nest->setTargetTemperatureMode(Nest::TARGET_TEMP_MODE_RANGE, array(23.0, 26.0)); // Available: TARGET_TEMP_MODE_COOL, TARGET_TEMP_MODE_HEAT, TARGET_TEMP_MODE_RANGE
var_dump($success);

echo "Setting fan mode...\n";
$success = $nest->setFanMode(Nest::FAN_MODE_ON); // Available: FAN_MODE_AUTO or FAN_MODE_EVERY_DAY_OFF, FAN_MODE_ON or FAN_MODE_EVERY_DAY_ON
// setFanMode() can also take an array as it's argument. See the comments below for examples (FAN_MODE_TIMER, FAN_MODE_MINUTES_PER_HOUR).
var_dump($success);

echo "Setting fan mode: on with timer (15 minutes)...\n";
$success = $nest->setFanModeOnWithTimer(Nest::FAN_TIMER_15M); // Available: FAN_TIMER_15M, FAN_TIMER_30M, FAN_TIMER_45M, FAN_TIMER_1H, FAN_TIMER_2H, FAN_TIMER_4H, FAN_TIMER_8H, FAN_TIMER_12H
//$success = $nest->setFanMode(array(FAN_MODE_TIMER, 900)); // Same as above. See the FAN_TIMER_* defines for the possible values.
var_dump($success);

echo "Canceling timer that was just set...\n";
$success = $nest->cancelFanModeOnWithTimer();
var_dump($success);

echo "Setting fan mode to 30 minutes per hour...\n";
$success = $nest->setFanModeMinutesPerHour(Nest::FAN_MODE_MINUTES_PER_HOUR_30); // Available: FAN_MODE_MINUTES_PER_HOUR_15, FAN_MODE_MINUTES_PER_HOUR_30, FAN_MODE_MINUTES_PER_HOUR_45, FAN_MODE_MINUTES_PER_HOUR_ALWAYS_ON
//$success = $nest->setFanMode(array(FAN_MODE_MINUTES_PER_HOUR, 1800)); // Same as above. See the FAN_MODE_MINUTES_PER_HOUR_* defines for the possible values.
var_dump($success);

echo "Setting fan mode to run every day, but only between 5am and 10pm...\n";
$success = $nest->setFanEveryDaySchedule(5, 22); // Send 0,0 to run all day long
var_dump($success);

echo "Turning system off...\n";
$success = $nest->turnOff();
var_dump($success);

echo "Setting away mode...\n";
$success = $nest->setAway(Nest::AWAY_MODE_ON); // Available: AWAY_MODE_ON, AWAY_MODE_OFF
var_dump($success);

echo "Enabling (Nest Sense) Auto-Away...\n";
$success = $nest->setAutoAwayEnabled(TRUE);
var_dump($success);

echo "Setting dual-fuel breakpoint (use alternative heat when the outdoor temperature is below -5°)...\n";
// Note: when using temperatures, it will use the units you set on the device. I'm using celsius on my device, so I'm using celsius here.
$success = $nest->setDualFuelBreakpoint(-5); // Available: DUALFUEL_BREAKPOINT_ALWAYS_PRIMARY, DUALFUEL_BREAKPOINT_ALWAYS_ALT, or a temperature between -12°C and 9°C (10-50°F)
var_dump($success);
echo "----------\n\n";

sleep(1);

echo "Device information:\n";
$infos = $nest->getDeviceInfo();
jlog($infos);
echo "----------\n\n";

echo "Device schedule:\n";
// Returns as array, one element for each day of the week for which there has at least one scheduled event.
// Array keys are a textual representation of a day, three letters, as returned by `date('D')`. Array values are arrays of scheduled temperatures, including a time (in minutes after midnight), and a mode (one of the TARGET_TEMP_MODE_* defines).
$schedule = $nest->getDeviceSchedule();
jlog($schedule);
echo "----------\n\n";

echo "Device next scheduled event:\n";
$next_event = $nest->getNextScheduledEvent();
jlog($next_event);
echo "----------\n\n";

echo "Last 10 days energy report:\n";
$energy_report = $nest->getEnergyLatest();
jlog($energy_report);
echo "----------\n\n";
*/
/* Helper functions */

function jlog($json) {
    if (!is_string($json)) {
        $json = json_encode($json, JSON_PRETTY_PRINT);
    }
    echo $json . "\n";
}

?>