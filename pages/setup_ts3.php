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
			$getserver = "SELECT * FROM `servers` WHERE `server_ID`='".$_GET['server_id']."' AND `server_owner`='".$user_row[0]."'";
			if($server_row = $con->query($getserver)) {
				$server_row = $server_row->fetch_row();
            } else{
				echo "Error fetching server: " . $conn->error;
			}
        }
    }
?>

Inorder to get the teamspeak to working, we need you to do the following:<br />
1. Create a ServerQuery Login with the name "fdghubble". (Tools -> ServerQuery Login)<br />
2. Paste the password you get below
3. That's it, just hit "Setup Server" and wait for the next poll!<br />
<br />

<form action="inc/setup_ts3.php" method="post">
    <table width="500">
        <tr>
            <td align="right"><b>Server IP</b></td>
            <td><input type="text" name="serverip" required="required" value="<?php echo $server_row[2]; ?>"/></td>
        </tr>
        <tr>
            <td align="right"><b>Server port</b></td>
            <td><input type="text" name="serverport" required="required" value="<?php echo $server_row[3]; ?>"></td>
        </tr>
		<tr>
            <td align="right"><b>Server key</b></td>
            <td><input type="text" name="serverkey" required="required" value="<?php echo $server_row[10]; ?>"></td>
        </tr>
		<tr>
			<input type="hidden" name="serverid" value="<?php echo $server_row[0]; ?>">
		</tr>
        <tr align="center">
            <td colspan="3">
                <input type="submit" name="add" value="Setup Server"/>
            </td>
        </tr>
    </table>
</form>