<form action="inc/addserver.php" method="post">
    <table width="500">
        <tr align="center">
            <td colspan="3"><h2>Add Server</h2></td>
        </tr>
		<tr>
            <td align="right"><b>Server Name</b></td>
            <td><input type="text" name="servername" required="required"/></td>
        </tr>
        <tr>
            <td align="right"><b>Server IP</b></td>
            <td><input type="text" name="serverip" required="required"/></td>
        </tr>
        <tr>
            <td align="right"><b>Server port</b></td>
            <td><input type="text" name="serverport" required="required"></td>
        </tr>
		<tr>
            <td align="right"><b>Server protocol</b></td>
            <td>
				<select name="serverprotocol" required="required">
					<option value="http"selected="selected">HTTP</option>
					<option value="https">HTTPS</option>
					<option value="ts3">Teamspeak 3</option>
					<option value="minecraft">Minecraft</option>
					<option value="other">Other</option>
				</select>
			</td>
        </tr>
        <tr align="center">
            <td colspan="3">
                <input type="submit" name="add" value="Add Server"/>
            </td>
        </tr>
    </table>
</form>