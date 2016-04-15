<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/config.inc.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/lang/'. CONF_LANG . '.php');
    session_start();
    

    // establishing the MySQLi connection
    $con = mysqli_connect(CONF_MYSQL_SERVER,CONF_MYSQL_USER,CONF_MYSQL_PASS,CONF_MYSQL_DB);
    
    if (mysqli_connect_errno()){
        echo "MySQLi Connection was not established: " . mysqli_connect_error();
    }
    
    // Checking the user
    if(isset($_POST['login'])){
        $currpass = mysqli_real_escape_string($con,$_POST['currpass']); // put the current password entered by the user in a variable, then use the mysqli_real_escape_string to prevent SQLInjection
        $newpass = mysqli_real_escape_string($con,$_POST['newpass']); // put the new password entered by the user in a variable, then use the mysqli_real_escape_string to prevent SQLInjection
        $newpassconf = mysqli_real_escape_string($con,$_POST['newpassconf']); // put the confirmation for the new password entered by the user in a variable, then use the mysqli_real_escape_string to prevent SQLInjection
        $sel_user = "select * from users where username='".$_SESSION['user']."' LIMIT 1"; // SQL to get the user
        
        // verify the new passwords match
        if (sha1($newpass)== sha1($newpassconf)){
            // Verify if the current password is correct
            if($result = $con->query($sel_user)){
                $row = $result->fetch_row(); // Convert the row to Array
            
                // Check if the password is correct against the hash in the database
                if (password_verify($currpass, $row[2])) {
                    // User credentials are valid, now go on and change it.
                    $passhash = password_hash($newpass,PASSWORD_BCRYPT);
                    $changepass = "UPDATE `users` SET `password` = '$passhash' WHERE `users`.`username` ='".$_SESSION['user']."';";
                    if ($con->query($changepass) === TRUE) {
                        echo "Password changed succesfully!";
                    } else {
                        echo "Error changing password: " . $conn->error;
                    }
                    header ("Location: http://".$_SERVER['HTTP_HOST']."?action=changepassword&success=true"); 
                } else {
                    // Credentials are invalid :C
                    header ("Location: http://".$_SERVER['HTTP_HOST']."?action=changepassword&success=false&reason=invalidpass"); 
                }
            }
        } else {
            header ("Location: http://".$_SERVER['HTTP_HOST']."?action=changepassword&success=false&reason=nonmatchingpass"); 
        }
    }
?>