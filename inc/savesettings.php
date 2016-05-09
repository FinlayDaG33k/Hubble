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
			if($_POST['desktopnotifications'] == "on"){
				$desktopnotifications = 1;
			}else{
				$desktopnotifications = 0;
			}
			$json = array(
				"desktopnotifications"=> $desktopnotifications
			);
            $settings = mysqli_real_escape_string($con,json_encode($json));
				$editsettings = "UPDATE `users` SET `user_settings`='$settings' WHERE ID='".$user_row[0]."';"; // SQL to update the server
				if ($con->query($editsettings) === TRUE) {
                    echo "Settings saves succesfully!";
					$_SESSION['desktopnotifications'] = $desktopnotifications;
                } else {
                    echo "Error saving settings: " . $conn->error;
				}
        }
    }else{
		echo 'Please login to do this!';
	}
?>
   