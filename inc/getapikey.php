<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config.inc.php');
require($_SERVER['DOCUMENT_ROOT'] . '/lang/'. CONF_LANG . '.php');
session_start();

$con = mysqli_connect(CONF_MYSQL_SERVER,CONF_MYSQL_USER,CONF_MYSQL_PASS,CONF_MYSQL_DB);
    
    if (mysqli_connect_errno()){
        echo "MySQLi Connection was not established: " . mysqli_connect_error();
    }
	
	if(isset($_SESSION['user'])){
		$getrole = "select authkey from users where username='".$_SESSION['user']."' LIMIT 1";
		if($user_row = $con->query($getrole)){
			$user_row = $user_row->fetch_row(); // Convert the row to Array
            $apikey = $user_row[0];
		}else{
			$apikey = "Unable to get API key, please try again later!";
		}
	}
?>