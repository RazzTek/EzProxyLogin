<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use DevSite\Processor\EZproxyTicket;
use RazzTek\SSOClient\Processor\SsoClient;
use DevSite\Handler\EzCasErr;

require_once __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', 1); //Display error 1 or not 0
if (session_id() == '') {
    session_start();
}

// Create the logger
$logger = new Logger('EzProxy: ');
// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__.'/../log/my_app.log', Logger::DEBUG));
$logger->pushHandler(new FirePHPHandler());

//Create SSO
$sso = new SsoClient();
$results = $sso->authenticate();

$attributes = $sso->get_attributes();

$ezproxy = new EZproxyTicket("https://login.dist.lib.usu.edu", EZSECRET, $userCN, $passGroups);

if ($passGroups !== "None") {
    //$logger->info("Successful Login -- " . $userCN . " and " . $passGroups);
    header("Location: " . $ezproxy->URL($url));
} else {
    $logger->info("Failed Login -- " . $userCN . " and " . $passGroups);
    //include 'error_inc.php';
}


 ?>
