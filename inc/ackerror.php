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
			
			$removeserver = "UPDATE `servers` SET last_error='' WHERE `server_ID`='".$_GET['server_id']."' AND `server_owner`='".$user_row[0]."'";
            
            if ($con->query($removeserver) === TRUE) {
                        echo "Server error acknowledged!";
                    } else {
                        echo "Error acknowledging server: " . $conn->error;
            }
        }
    }else{
		echo "Please login to continue!";
	}
        
  ?>