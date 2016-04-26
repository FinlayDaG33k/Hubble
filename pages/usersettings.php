
<h4>change password</h4>
<form action="login/changepassword.php" method="post" >
       <div class="form-group form-group-sm col-sm-4">
            <label class="col-sm-6 control-label" for="currpass">Current Password</label>
                <input type="password" class="col-sm-2 form-control" name="currpass" required="required"/>
            <label class="col-sm-6 control-label" for="newpass">New Password</label>
                <input type="password" class="form-control" name="newpass" required="required">
            <label class="col-sm-6 control-label" for="newpassconf">New Password (Confirm)</label>
                <input type="password" class="form-control" name="newpassconf" required="required">
                <input type="submit" class="form-control" name="login" value="Change Password"/>
        </div>
        
</form>