<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config.inc.php');
require($_SERVER['DOCUMENT_ROOT'] . '/lang/'. CONF_LANG . '.php');

$con = mysqli_connect(CONF_MYSQL_SERVER,CONF_MYSQL_USER,CONF_MYSQL_PASS,CONF_MYSQL_DB);
    
    if (mysqli_connect_errno()){
        echo "MySQLi Connection was not established: " . mysqli_connect_error();
    }
	
	if(isset($_GET['authkey'])){
		$getuserid = "select ID, username from users where authkey='".mysqli_real_escape_string($con,$_GET['authkey'])."' LIMIT 1";
		if($user_row = $con->query($getuserid)){
			$user_row = $user_row->fetch_row(); // Convert the row to Array
            $user_id = $user_row[0];
			$username = $user_row[1];
			$getservers = "select * from servers where server_owner='".$user_id."' ORDER BY server_status asc";
            if ($servers=mysqli_query($con,$getservers)){
				$getofflineservers = "select * from servers where server_owner='".$user_id."' AND server_status=0";  
				$offlineservers = mysqli_num_rows(mysqli_query($con,$getofflineservers));
				$servers_array = array();
				while ($server = mysqli_fetch_row($servers)){
					$server_array = array(
					"name" => $server[6],
					"IP" => $server[2],
					"port" => $server[3],
					"status" => $server[4],
					"last_check" => $server[5]
					);
					$servers_array[] = $server_array;
				}
				$OUTPUT = array(
				"username" => $username,
				"servers" => array(
					"total" => mysqli_num_rows($servers),
					"offline"=> $offlineservers,
					"servers" => $servers_array
					)
				);
				
				echo json_encode($OUTPUT);
            }
		}
	}else{
		echo 'Empty authkey!';
	}
?>