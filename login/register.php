<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config.inc.php');
require($_SERVER['DOCUMENT_ROOT'] . '/lib/lib_randomstr.php');
require($_SERVER['DOCUMENT_ROOT'] . '/lib/lib_recaptcha.php');
require($_SERVER['DOCUMENT_ROOT'] . '/lang/'. CONF_LANG . '.php');
session_start();




$fileContent = '';
if (isset($_REQUEST['g-recaptcha-response']) && !empty($_REQUEST['g-recaptcha-response'])) {
    $fileContent = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".CAPTCHA_SECRET."&response=". $_REQUEST['g-recaptcha-response']);
}

$jsonArray = json_decode($fileContent, true);
if (isset($jsonArray['success']) && $jsonArray['success']==true) {
    $con = mysqli_connect(CONF_MYSQL_SERVER,CONF_MYSQL_USER,CONF_MYSQL_PASS,CONF_MYSQL_DB);
    if (mysqli_connect_errno()){
        echo "MySQLi Connection was not established: " . mysqli_connect_error();
    }
	$username = htmlentities(mysqli_real_escape_string($con,$_POST['user']));
	$pass = htmlentities(mysqli_real_escape_string($con,$_POST['pass']));
	$passconf = htmlentities(mysqli_real_escape_string($con,$_POST['passconf']));
	$sel_user = mysqli_query($con, "select ID from users where username='".$username."'");
	if(mysqli_num_rows($sel_user) > 0){
		echo "Username already exists!";
	}else{
		$sel_ip = mysqli_query($con, "select ID from users where registration_ip='".$_SERVER["HTTP_CF_CONNECTING_IP"]."'");
		if(mysqli_num_rows($sel_ip) > 5){
			echo "You have reached the limit of accounts for your IP!";
		}else{
			if($pass == $passconf){
				$addserver = "INSERT INTO `users` (`username`, `password`, `role`, `registration_ip`, `authkey`) VALUES ('$username', '".password_hash($pass,PASSWORD_BCRYPT,["cost" => HASHCOST])."', '0','".$_SERVER["HTTP_CF_CONNECTING_IP"]."','".generateRandomString()."');"; // SQL to insert the server
				if ($con->query($addserver) === TRUE) {
					echo "Registration succesful!";
				} else {
					echo "Error Registering!: " . $conn->error;
				}
			} else {
				echo "Passwords did not match!";
			}
		}	
	}
} else {
    echo 'Invalid verification code, please try again!';
}
?>