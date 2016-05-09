<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/config.inc.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/lang/'. CONF_LANG . '.php');
	ini_set("session.cookie_secure", 1);
	ini_set('session.cookie_httponly', 1);
	ini_set('session.hash_function', 'sha512');
	ini_set('session.entropy_file', '/dev/urandom');
    session_start();
	session_regenerate_id();
    

    // establishing the MySQLi connection
    $con = mysqli_connect(CONF_MYSQL_SERVER,CONF_MYSQL_USER,CONF_MYSQL_PASS,CONF_MYSQL_DB);
    
    if (mysqli_connect_errno()){
        echo "MySQLi Connection was not established: " . mysqli_connect_error();
    }
    
    // Checking the user
    if(isset($_POST['login'])){
        $user = mysqli_real_escape_string($con,$_POST['user']); // use the mysqli_real_escape_string to prevent SQLInjection
        $pass = $_POST['pass']; // Put the user entered password in a variable
        $sel_user = "select * from users where username='$user' LIMIT 1"; // SQL to get the user
        $run_user = mysqli_query($con, $sel_user);
        
        // Verify if the password is correct
        if($result = $con->query($sel_user)){
            $row = $result->fetch_row(); // Convert the row to Array
            
            // Check if the password is correct against the hash in the database
            if (password_verify($pass, $row[2])) {
                // User credentials are valid :D
				$_SESSION['timeout'] = time() + 600;
				$_SESSION['user'] = htmlentities($user);
				$user_settings = json_decode($row[6]);
				$_SESSION['desktopnotifications'] = $user_settings->desktopnotifications;
				$updateuser = "UPDATE `users` SET `last_login` = '".strtotime(date("d-m-y"))."' WHERE `ID` = ". $row[0].";"; // SQL to get the user
				$result = $con->query($updateuser);
				header ("Location: http://".$_SERVER['HTTP_HOST']); 
            } else {
                // Credentials are invalid :C
                header ("Location: http://".$_SERVER['HTTP_HOST']."?action=login&failed=true"); 
            }
        }
    }
?>