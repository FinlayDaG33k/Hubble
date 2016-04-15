<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config.inc.php');
require($_SERVER['DOCUMENT_ROOT'] . '/lib/lib_randomstr.php');
require($_SERVER['DOCUMENT_ROOT'] . '/lang/'. CONF_LANG . '.php');
session_start();
$chaptasolution = $_POST['chapta1'] . $_POST['chaptaoperator'] . $_POST['chapta2'];
if($_POST['chaptaoperator'] == "+"){
	$chaptasolution = $_POST['chapta1'] + $_POST['chapta2'];
}elseif($_POST['chaptaoperator'] == "-"){
	$chaptasolution = $_POST['chapta1'] - $_POST['chapta2'];
}elseif($_POST['chaptaoperator'] == "*"){
	$chaptasolution = $_POST['chapta1'] * $_POST['chapta2'];
}

if($_POST['inputchapta'] == $chaptasolution){
$con = mysqli_connect(CONF_MYSQL_SERVER,CONF_MYSQL_USER,CONF_MYSQL_PASS,CONF_MYSQL_DB);
    
    if (mysqli_connect_errno()){
        echo "MySQLi Connection was not established: " . mysqli_connect_error();
    }
				$username = mysqli_real_escape_string($con,$_POST['user']);
				$pass = mysqli_real_escape_string($con,$_POST['pass']);
				$passconf = mysqli_real_escape_string($con,$_POST['passconf']);
				if($pass == $passconf){
					$addserver = "INSERT INTO `users` (`username`, `password`, `role`, `registration_ip`, `authkey`) VALUES ('$username', '".password_hash($pass,PASSWORD_BCRYPT)."', '0','".$_SERVER["HTTP_CF_CONNECTING_IP"]."','".generateRandomString()."');"; // SQL to insert the server
						if ($con->query($addserver) === TRUE) {
							echo "Registration succesful!";
						} else {
							echo "Error Registering!: " . $conn->error;
						}
				} else {
					echo "Passwords did not match!";
				}
}else{
	echo "Invalid Chapta!";
}
?>