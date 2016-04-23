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
			$getserver = "SELECT server_ID, server_IP, server_Port, server_name, server_protocol FROM `servers` WHERE `server_ID`='".$_GET['server_id']."' AND `server_owner`='".$user_row[0]."'";
			if($server_row = $con->query($getserver)) {
				$server_row = $server_row->fetch_row();
            } else{
				echo "Error fetching server: " . $conn->error;
			}
        }
    }
?>
<form action="inc/editserver.php" method="post">
    <table width="500">
        <tr align="center">
            <td colspan="3"><h2>Edit Server</h2></td>
        </tr>
		<tr>
            <td align="right"><b>Server Name</b></td>
            <td><input type="text" name="servername" required="required" value="<?php echo $server_row[3]; ?>"/></td>
        </tr>
        <tr>
            <td align="right"><b>Server IP</b></td>
            <td><input type="text" name="serverip" required="required" value="<?php echo $server_row[1]; ?>"/></td>
        </tr>
        <tr>
            <td align="right"><b>Server port</b></td>
            <td><input type="text" name="serverport" required="required" value="<?php echo $server_row[2]; ?>"></td>
        </tr>
		<tr>
            <td align="right"><b>Server protocol</b></td>
            <td>
				<select name="serverprotocol" required="required">
					<option value="http" <?php if($server_row[4] == "http"){ ?> selected="selected" <?php } ?>>HTTP</option>
					<option value="https" <?php if($server_row[4] == "https"){ ?> selected="selected" <?php } ?>>HTTPS</option>
					<option value="ts3" <?php if($server_row[4] == "ts3"){ ?> selected="selected" <?php } ?>>Teamspeak 3</option>
					<option value="other" <?php if($server_row[4] == "other" || $server_row[4] == ""){ ?> selected="selected" <?php } ?>>Other</option>
				</select>
			</td>
        </tr>
		<tr>
			<input type="hidden" name="serverid" value="<?php echo $server_row[0]; ?>">
		</tr>
        <tr align="center">
            <td colspan="3">
                <input type="submit" name="add" value="Edit Server"/>
            </td>
        </tr>
    </table>
</form>