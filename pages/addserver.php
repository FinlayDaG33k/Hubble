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
        <tr align="center">
            <td colspan="3">
                <input type="submit" name="add" value="Add Server"/>
            </td>
        </tr>
    </table>
</form>