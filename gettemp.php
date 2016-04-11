<?php require_once('nest.class.php'); ?>
<?php include_once "Config.php" ?>
    
    

<?php

	$nest = new Nest($username, $password);
	
	$devices_serials = $nest->getDevices();
	$infos = $nest->getDeviceInfo($devices_serials[0]);
	printf("%.02f", $infos->current_state->temperature, $infos->scale);
	


?>
