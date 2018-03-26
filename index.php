<?php

require("config/config.php");
//We need to use an autoloader to import PHPOnCouch classes
//I will use composer's autoloader for this demo

//We create the database if required
try {
    $info = $client->getDatabaseInfos();
} catch (Exception $e) {
    echo "Error:".$e->getMessage()." (errcode=".$e->getCode().")\n";
    exit(1);
}
print_r($info);

?>