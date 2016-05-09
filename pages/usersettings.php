<?php 
if(!isset($_SESSION['user'])){
	header('Location: ?action=login');
}
?>
    <script>
    $(function(argument) {
      $('[type="checkbox"]').bootstrapSwitch();
    })
    </script>

<div class="row">
<div class="col-lg-4">
<div class="bs-component">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">User Settings</h3>
  </div>
  <div class="panel-body">
    <form action="inc/savesettings.php" method="post" >
			<div class="form-group">
		<div class="checkbox">
          <label>
           Get desktop notifications <input type="checkbox" name="desktopnotifications" <?php if($_SESSION['desktopnotifications'] == true){ ?>checked <?php } ?>> 
          </label>
        </div>
		</div>
		<div class="form-group">		
			<button type="reset" class="btn btn-default">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
</form>
  </div>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="bs-component">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">change password</h3>
  </div>
  <div class="panel-body">
<form action="login/changepassword.php" method="post" >
  <fieldset>
	   <div class="form-group">
            <label class="col-sm-6 control-label" for="currpass">Current Password</label>
                <input type="password" class="col-sm-2 form-control" name="currpass" required="required"/>
            </div>
			<div class="form-group">
			<label class="col-sm-6 control-label" for="newpass">New Password</label>
                <input type="password" class="form-control" name="newpass" required="required">
				</div>
				<div class="form-group">
            <label class="col-sm-6 control-label" for="newpassconf">New Password (Confirm)</label>
                <input type="password" class="form-control" name="newpassconf" required="required">
				</div>
				<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
				<button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Change Password</button>
				</div>
				</div>
	</fieldset>
</form>
  </div>
  </div>
  </div>
    </div>
	
	<div class="col-lg-4">
<div class="bs-component">

<div class="panel panel-warning">
  <div class="panel-heading">
    <h3 class="panel-title">Experimental Stuff</h3>
  </div>
  <div class="panel-body">
    Seems empty to me...
  </div>
</div>
</div>
	  </div>
