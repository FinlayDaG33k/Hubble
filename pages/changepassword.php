<?php
if($_GET['success'] == "false"){
    if($_GET['reason'] == "nonmatchingpass"){
        echo "The new password you have entered does match the confirmation.<br /> Please try again.";
    }
    if($_GET['reason'] == "invalidpass"){
        echo "The current password you have entered is invalid.<br /> Please try again.";
    }
} elseif($_GET['success'] == "true") {
    echo "Password changed succesfully!";
}
?>
<form action="login/changepassword.php" method="post" >
       <div class="form-group form-group-sm col-sm-3">
            <label class="col-sm-4 control-label" for="currpass">Current Password</label>
                <input type="password" class="col-sm-2 form-control" name="currpass" required="required"/>
            <label class="col-sm-4 control-label" for="newpass">New Password</label>
                <input type="password" class="form-control" name="newpass" required="required">
            <label class="col-sm-4 control-label" for="newpassconf">New Password (Confirm)</label>
                <input type="password" class="form-control" name="newpassconf" required="required">
                <input type="submit" class="form-control" name="login" value="Change Password"/>
        </div>
        
</form>