<?php require_once('nest.class.php'); ?>
<?php include_once "Config.php" ?>
    
    

<?php
	//Initialize Nest with credentails from config
	$nest = new Nest($username, $password);
	
	//Set Temperature from String
	$temp = 75;
	
	//Convert Temp from Farenheight to Celsius
	$ctemp =  ($temp -32) * (5/9);
	
	//Set Nest Status to Home 
	$action = $_GET['action'];
	if ($action = 'home')
	{
		$success = $nest->setAway(AWAY_MODE_ON); // Available: AWAY_MODE_ON, AWAY_MODE_OFF
		var_dump($success);
	}
	//Set Nest Status to Away
	if ($action = 'away')
	{
		$success = $nest->setAway(AWAY_MODE_OFF); // Available: AWAY_MODE_ON, AWAY_MODE_OFF
		var_dump($success);
	}
	
		//Set Nest Temperatue
	if ($action = 'temp')
	{
		
		$devices_serials = $nest->getDevices();
		//print_r($devices_serials);
		foreach ($devices_serials as $serial)
		{
			echo "Setting target temperatures ($ctemp) for $serial... \r\n";
			//$success = $nest->setTargetTemperature($ctemp,"02AA01AC311303CZ");
			//var_dump($success);
			$infos = $nest->getDeviceInfo($devices_serials[0]);	
			//$serial_number = $this->getDefaultSerial($serial_number);
			print_r($infos);
				var_dump($success);
		}
		unset($serial);
		//echo "Setting target temperatures ($ctemp)...\n";
		
	}


	
//echo "Setting target temperature mode...\n";
//$success = $nest->setTargetTemperatureMode(TARGET_TEMP_MODE_HEAT); // Available: TARGET_TEMP_MODE_COOL, TARGET_TEMP_MODE_HEAT, TARGET_TEMP_MODE_RANGE
//var_dump($success);
	
	function json_format($json) { 
    $tab = "  "; 
    $new_json = ""; 
    $indent_level = 0; 
    $in_string = false; 

    $json_obj = json_decode($json); 

    if($json_obj === false) 
        return false; 

    $json = json_encode($json_obj); 
    $len = strlen($json); 

    for($c = 0; $c < $len; $c++) 
    { 
        $char = $json[$c]; 
        switch($char) 
        { 
            case '{': 
            case '[': 
                if(!$in_string) 
                { 
                    $new_json .= $char . "\n" . str_repeat($tab, $indent_level+1); 
                    $indent_level++; 
                } 
                else 
                { 
                    $new_json .= $char; 
                } 
                break; 
            case '}': 
            case ']': 
                if(!$in_string) 
                { 
                    $indent_level--; 
                    $new_json .= "\n" . str_repeat($tab, $indent_level) . $char; 
                } 
                else 
                { 
                    $new_json .= $char; 
                } 
                break; 
            case ',': 
                if(!$in_string) 
                { 
                    $new_json .= ",\n" . str_repeat($tab, $indent_level); 
                } 
                else 
                { 
                    $new_json .= $char; 
                } 
                break; 
            case ':': 
                if(!$in_string) 
                { 
                    $new_json .= ": "; 
                } 
                else 
                { 
                    $new_json .= $char; 
                } 
                break; 
            case '"': 
                if($c > 0 && $json[$c-1] != '\\') 
                { 
                    $in_string = !$in_string; 
                } 
            default: 
                $new_json .= $char; 
                break;                    
        } 
    } 

    return $new_json; 
}

function jlog($json) {
    if (!is_string($json)) {
        $json = json_encode($json);
    }
    return json_format($json);
}

?>
