<?php
    if(!isset($_SESSION['user'])){
	header('Location: ?action=login');
	}
?>

<form action="inc/adduser.php" method="post" >
       <div class="form-group form-group-sm col-sm-3">
            <label class="col-sm-4 control-label" for="user">Username</label>
                <input type="text" class="col-sm-2 form-control" name="user" required="required"/>
            <label class="col-sm-4 control-label" for="pass">Password</label>
                <input type="password" class="form-control" name="pass" required="required">
            <label class="col-sm-4 control-label" for="passconf">Password (Confirm)</label>
                <input type="password" class="form-control" name="passconf" required="required">
                <input type="submit" class="form-control" name="login" value="Add User"/>
        </div>
        
</form>