<script src='https://www.google.com/recaptcha/api.js'></script>

<form action="login/register.php" method="post" >
       <div class="form-group form-group-sm col-sm-4">
            <label class="col-sm-12 control-label" for="user">Username</label>
                <input type="text" class="col-sm-2 form-control" name="user" required="required"/>
            <label class="col-sm-12 control-label" for="pass">Password</label>
                <input type="password" class="form-control" name="pass" required="required">
            <label class="col-sm-12 control-label" for="passconf">Password (Confirm)</label>
                <input type="password" class="form-control" name="passconf" required="required">
			<input type="checkbox" name="agreetos" required="required"> I have read and agree with the <a href="?action=tos" target="_new">Terms of Service</a><br>
			<label class="col-sm-12 control-label" for="inputchapta">Please solve the Captcha below</label>
			<div class="g-recaptcha" data-sitekey="6Lfmax4TAAAAAL9RH7iR5wshGLORW_89QtVHvq4h"></div><br /><br />	
			<input type="submit" class="form-control" name="login" value="Add User"/>
</form>