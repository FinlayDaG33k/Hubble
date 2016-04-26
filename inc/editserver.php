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
    $getid = "select id from users where username='".$_SESSION['user']."' LIMIT 1";
        if($user_row = $con->query($getid)){
            $user_row = $user_row->fetch_row(); // Convert the row to Array
            $server_IP = mysqli_real_escape_string($con,$_POST['serverip']);
            $server_port = mysqli_real_escape_string($con,$_POST['serverport']);
            $server_ID = mysqli_real_escape_string($con,$_POST['serverid']);
			$server_name = mysqli_real_escape_string($con,$_POST['servername']);
			$server_protocol = mysqli_real_escape_string($con,$_POST['serverprotocol']);
			
            require($_SERVER['DOCUMENT_ROOT'] . '/lib/lib_socketpingonoff.php');
            if ( ! filter_var($_GET['ip'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE) ){
				echo 'This server is not allowed! please go back and check the IP!';
			}else{
				$editserver = "UPDATE `servers` SET `server_IP`='$server_IP', `server_Port`='$server_port', `server_status`='".pingServer($server_IP,$server_port)."',last_check='".date("d-m-y H:i:s")."', server_name='".$server_name."', server_protocol='".$server_protocol."' WHERE server_ID='$server_ID' AND server_owner='".$user_row[0]."';"; // SQL to update the server
				if ($con->query($editserver) === TRUE) {
                    echo "Server editted succesfully!";
                } else {
                    echo "Error editted server: " . $conn->error;
				}
			}
        }
    }else{
		echo 'Please login to do this!';
	}
?>
   