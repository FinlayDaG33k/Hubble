<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/config.inc.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/lang/'. CONF_LANG . '.php');
    session_start();
    

    // establishing the MySQLi connection
    $con = mysqli_connect(CONF_MYSQL_SERVER,CONF_MYSQL_USER,CONF_MYSQL_PASS,CONF_MYSQL_DB);
    
    if (mysqli_connect_errno()){
        echo "MySQLi Connection was not established: " . mysqli_connect_error();
    }
    if(isset($_SESSION['user'])){
    $getid = "select ID from users where username='".$_SESSION['user']."' LIMIT 1";
        if($user_row = $con->query($getid)){
            $user_row = $user_row->fetch_row(); // Convert the row to Array
            $server_IP = mysqli_real_escape_string($con,$_POST['serverip']);
            $server_port = mysqli_real_escape_string($con,$_POST['serverport']);
			$server_name = mysqli_real_escape_string($con,$_POST['servername']);
            
            require($_SERVER['DOCUMENT_ROOT'] . '/lib/lib_socketpingonoff.php');
            $selectserver = "SELECT * FROM `servers` WHERE `server_owner`='".$user_row[0]."' AND `server_ip`='".$server_IP."' AND `server_port`='".$server_port."';"; // SQL to insert the server
            
			if (!mysqli_num_rows($con,$query) > 0) {
                $addserver = "INSERT INTO `servers` (`server_ip`, `server_port`, `server_owner`, `server_status`, `last_check`, `server_name`) VALUES ('$server_IP', '$server_port', '".$user_row['0']."', '".pingServer($server_IP,$server_port)."','".date("d-m-y H:i:s")."', '".$server_name."');"; // SQL to insert the server
				if ($con->query($addserver) === TRUE) {
					echo "Server Added succesfully!";
				} else {
                    echo "Error adding server: " . $conn->error;
				}
            } else {
                echo "You already have this server!";
            }

        }
    }
        
   