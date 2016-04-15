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
                        $updateserver = "UPDATE `servers` SET `server_status` = '".pingServer($server[2],$server[3])."',last_check='".date("d-m-y H:i:s")."' WHERE `servers`.`server_id` = ". $server[0].";"; // SQL to get the user
						$result = $con->query($updateserver);
                }
            }

?>

