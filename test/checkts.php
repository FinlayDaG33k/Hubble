<?php
//Load Framework
require_once("/var/www/html/lib/TeamSpeak3/TeamSpeak3.php");

try {
   //Connect
   $ts3 = TeamSpeak3::factory("serverquery://query_user:SjaxXM84kX63IRbm7myc9RUzm0TqcPRBE2fokctA@server.woutervanderloop.nl:10011/?server_port=9987");

   //Server Status
   echo "Server Status: online";
}
catch(Exception $e) {
   //Errors (No connection)
   echo "Server Status: offline";
}
?>