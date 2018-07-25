<?php
// Figure out how to move this into a environment setting that can be overridden
/* CAS Protocol Configuration */
$cas_host = 'login.usu.edu';
$cas_port = 443;
$cas_context = '/cas';
$cas_server_ca_cert_path = '/var/www/letmein/login.usu.edu.pem';


/**
 * DEBUGGING CAS AND THIS TOOL
 *
 * Two PHP Constants can be defined to enable debug logging
 * define('SSO_DEBUG', true); //This enables phpCAS debugging
 * define('SSO_DEBUG_LOG', <path to debug log file>); //This is where the log will be written
 *
 */
$cas_debug_log = '/tmp/phpCAS.log';
if (defined('SSO_DEBUG')) {
    $cas_debug_log = SSO_DEBUG_LOG;
}
