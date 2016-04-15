<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config.inc.php');
require($_SERVER['DOCUMENT_ROOT'] . '/lang/'. CONF_LANG . '.php');
session_start();

$con = mysqli_connect(CONF_MYSQL_SERVER,CONF_MYSQL_USER,CONF_MYSQL_PASS,CONF_MYSQL_DB);
    
    if (mysqli_connect_errno()){
        echo "MySQLi Connection was not established: " . mysqli_connect_error();
    }
	if(isset($_SESSION['user'])){
		$getrole = "select role from users where username='".$_SESSION['user']."' LIMIT 1";
		if($user_row = $con->query($getrole)){
			$user_row = $user_row->fetch_row(); // Convert the row to Array
            $user_role = $user_row[0];
			if($user_role == 1){
				$username = mysqli_real_escape_string($con,$_POST['user']);
				$pass = mysqli_real_escape_string($con,$_POST['pass']);
				$passconf = mysqli_real_escape_string($con,$_POST['passconf']);
				if($pass == $passconf){
					$addserver = "INSERT INTO `users` (`username`, `password`, `role`) VALUES ('$username', '".password_hash($pass,PASSWORD_BCRYPT)."', '0');"; // SQL to insert the server
						if ($con->query($addserver) === TRUE) {
							echo "User Added succesfully!";
						} else {
							echo "Error adding user: " . $conn->error;
						}
				} else {
					echo "Passwords did not match!";
				}
			} else {
				echo "You do not have the privilege to do this";
			}
		}
	}
        
?>