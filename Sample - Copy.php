<?php require_once('nest.class.php'); ?>
<?php include_once "Config.php" ?>
<?php include_once('phpMyGraph5.0.php'); ?>
    
    

<?php
	//Set content-type header
    
	//header("Content-type: image/png");

	//Set config directives
	
    $cfg['title'] = 'Example graph';
    $cfg['width'] = 500;
    $cfg['height'] = 250;


	$nest = new Nest($username, $password);
	
	$energy_report = ($nest->getEnergyLatest());
	$jsondata=jlog($energy_report);
	$erport = json_decode($jsondata ,true);
	//$json = '{"countryId":"84","productId":"1","status":"0","opId":"134"}';
	//$json = json_decode($json, true);
	//print_r($json);
	//echo '\n';
	print_r($erport);
	$data=[];
	/*foreach($arrayOfEmails as $item)
	{
			
	}*/


	//Create phpMyGraph instance
    //$graph = new phpMyGraph();

    //Parse 
    //$graph->parseVerticalPolygonGraph($data, $cfg);

	
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
