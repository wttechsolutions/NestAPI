<?php require_once('nest.class.php'); ?>
<?php include_once "Config.php" ?>

<?php
$nest = new Nest($username, $password);

echo "Setting away mode...\n";
$success = $nest->setAway(AWAY_MODE_ON); // Available: AWAY_MODE_ON, AWAY_MODE_OFF
var_dump($success);

