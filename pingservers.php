<?php
    require('/var/www/html/config.inc.php');
    require('/var/www/html/lib/lib_socketpingonoff.php');
    
    $con = mysqli_connect(CONF_MYSQL_SERVER,CONF_MYSQL_USER,CONF_MYSQL_PASS,CONF_MYSQL_DB);
    
    if (mysqli_connect_errno()){
        echo "MySQLi Connection was not established: " . mysqli_connect_error();
    }
    
    $getservers = "select * from servers";
            if ($servers=mysqli_query($con,$getservers)){
                while ($server = mysqli_fetch_row($servers)){
					if($server[3] == 80){
						$output = exec("/home/servermonitor/plugins/check_http -I ". $server[2]);
						echo $output;
						echo $useragent;
						$http_status = preg_split("/[: -]/", $output);
						if($http_status[1] == "OK"){
							$server_status = "1";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', server_message='".$http_status[3] . " " . $http_status[4] . " " . $http_status[5]."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}else{
							$server_status = "0";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', last_error='".date("d-m-y H:i:s")."', server_message='".$http_status[3] . " " . $http_status[4] . " " . $http_status[5]."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);

						}
					}elseif($server[3] == 443){
						$output = exec("/home/servermonitor/plugins/check_http --ssl -I ". $server[2]);
						echo $output;
						echo $useragent;
						$http_status = preg_split("/[: -]/", $output);
						if($http_status[1] == "OK"){
							$server_status = "1";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', server_message='".$http_status[3] . " " . $http_status[4] . " " . $http_status[5]."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}else{
							$server_status = "0";
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', last_error='".date("d-m-y H:i:s")."', server_message='".$http_status[3] . " " . $http_status[4] . " " . $http_status[5]."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);

						}
					}else{
						$server_status = pingServer($server[2],$server[3]);
						if ($server_status == 1){
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						} else {
							$updateserver = "UPDATE `servers` SET `server_status` = '".$server_status."',last_check='".date("d-m-y H:i:s")."', last_error='".date("d-m-y H:i:s")."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
							$result = $con->query($updateserver);
						}
					}
                }
            }

?>

