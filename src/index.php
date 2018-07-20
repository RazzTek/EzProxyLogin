<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use RazzTek\Processor\EZproxyTicket;
use RazzTek\Handler\EzCasErr;

require_once __DIR__ . '/vendor/autoload.php';

// Create the logger
$logger = new Logger('EzProxy: ');
// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__.'/../log/my_app.log', Logger::DEBUG));
$logger->pushHandler(new FirePHPHandler());

$ezproxy = new EZproxyTicket("https://login.dist.lib.usu.edu", EZSECRET, $userCN, $passGroups);

if ($passGroups !== "None") {
    //$logger->info("Successful Login -- " . $userCN . " and " . $passGroups);
    header("Location: " . $ezproxy->URL($url));
} else {
    $logger->info("Failed Login -- " . $userCN . " and " . $passGroups);
    //include 'error_inc.php';
}


 ?>
