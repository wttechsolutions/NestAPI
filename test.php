<?php

// Your Nest username and password.
$username = 'mbadali25@gmail.com';
$password = 'D3adye325';

// The timezone you're in.
// See http://php.net/manual/en/timezones.php for the possible values.
date_default_timezone_set('America/Chicago');

// Here's how to use this class:

require_once 'autoload.php'; // Or use composer
autoloader(array( 'Nest'));
$cached_paths = autoloader(); 

// print array of class autoload paths: 
print_r($cached_paths); 


?>