<?php
    require('/var/www/html/config.inc.php');
    require('/var/www/html/lib/lib_socketpingonoff.php');
    
    $con = mysqli_connect(CONF_MYSQL_SERVER,CONF_MYSQL_USER,CONF_MYSQL_PASS,CONF_MYSQL_DB);
    
    if (mysqli_connect_errno()){
        echo "MySQLi Connection was not established: " . mysqli_connect_error();
    }
	

	/*
		$getusers = "select * from servers";
	if ($users=mysqli_query($con,$getusers)){
		while ($user = mysqli_fetch_row($users)){
			if($user[7] < strtotime('-30 days')){
				echo $user[1];
			}
		}
	}
	*/

    
    $getservers = "select * from servers";
            if ($servers=mysqli_query($con,$getservers)){
                while ($server = mysqli_fetch_row($servers)){
					//echo $server[2] . "<br />";
					if($server[9] == "http" ){
						$output = exec("/home/servermonitor/plugins/check_http -I ". $server[2] . " --port=". $server[3] . " --hostname=". $server[2] . " --onredirect=follow --no-body");
						$http_status = preg_split("/[: -]/", $output);
						if($http_status[4] == "200"){
							$server_status = "2";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', server_message='".$output."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}elseif($http_status[4] == "403"){
							$server_status = "1";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', last_error='".date("d-m-y H:i:s")."', server_message='".mysqli_real_escape_string($con,$output)."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}elseif($http_status[4] == "302"){
							$server_status = "1";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', last_error='".date("d-m-y H:i:s")."', server_message='".mysqli_real_escape_string($con,$output)."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}else{
							$server_status = "0";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', last_error='".date("d-m-y H:i:s")."', server_message='".mysqli_real_escape_string($con,$output)."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}
					}elseif($server[9] == "https"){
						$output = exec("/home/servermonitor/plugins/check_http --ssl --sni -I ". $server[2] . " --port=". $server[3] . " --hostname=". $server[2] . " --onredirect=follow --no-body -C 30");
						$http_status = preg_split("/[: -]/", $output);
						if($http_status[0] == "OK"){
							$server_status = "2";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', server_message='".mysqli_real_escape_string($con,$output)."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}elseif($http_status[0] == "WARNING" || $http_status[0] == "CRITICAL"){
							$server_status = "1";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', last_error='".date("d-m-y H:i:s")."', server_message='".mysqli_real_escape_string($con,$output)."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}else{
							$server_status = "0";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', last_error='".date("d-m-y H:i:s")."', server_message='".mysqli_real_escape_string($con,$output)."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}
					}elseif($server[9] == "ts3"){
						//Load Framework
						require_once("/var/www/html/lib/TeamSpeak3/TeamSpeak3.php");

						try {
							//Connect
							$ts3 = TeamSpeak3::factory("serverquery://fdghubble:".$server[10]."@".$server[2].":10011/?server_port=".$server[3]);

							//Server Status
							$server_status = "2";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}
						catch(Exception $e) {
							$server_status = "0";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', last_error='".date("d-m-y H:i:s")."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}
					}elseif($server[9] == "minecraft"){
						require_once("/var/www/html/lib/lib_mcstatus.php");
						$output = new MCServerStatus($server[2], $server[3]);
						if($output->online == 2){
							$updateserver = "UPDATE `servers` SET `server_status` = '".$output->online."',server_message='".mysqli_real_escape_string($con,$output->output)."',last_check='".date("d-m-y H:i:s")."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}elseif($output->online == 1){
							$updateserver = "UPDATE `servers` SET `server_status` = '".$output->online."',server_message='".mysqli_real_escape_string($con,$output->output)."',last_check='".date("d-m-y H:i:s")."',last_error='".date("d-m-y H:i:s")."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}else{
							$updateserver = "UPDATE `servers` SET `server_status` = '".$output->online."',server_message='".mysqli_real_escape_string($con,$output->output)."',last_check='".date("d-m-y H:i:s")."',last_error='".date("d-m-y H:i:s")."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}	
					}else{
						$server_status = pingServer($server[2],$server[3]);
						if ($server_status == 2){
							$updateserver = "UPDATE `servers` SET `server_status` = '2',last_check='".date("d-m-y H:i:s")."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						} else {
							$updateserver = "UPDATE `servers` SET `server_status` = '0',last_check='".date("d-m-y H:i:s")."', last_error='".date("d-m-y H:i:s")."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}
					}
                }
            }
?>

