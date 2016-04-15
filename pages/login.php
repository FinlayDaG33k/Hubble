<?php
    if(isset($_SESSION['user'])){
        // Do something when there already is someone logged in
    }
    
    if($_GET['failed'] == true){
        echo LANG_ERROR_LOGIN_INVALID_USERPASSWORD;
    }
    ?>
<form action="login/checklogin.php" method="post">
    <table width="500">
        <tr align="center">
            <td colspan="3"><h2>User Login</h2></td>
        </tr>
        <tr>
            <td align="right"><b>Username</b></td>
            <td><input type="text" name="user" required="required"/></td>
        </tr>
        <tr>
            <td align="right"><b>Password:</b></td>
            <td><input type="password" name="pass" required="required"></td>
        </tr>
        <tr align="center">
            <td colspan="3">
                <input type="submit" name="login" value="Login"/>
            </td>
        </tr>
    </table>
</form>