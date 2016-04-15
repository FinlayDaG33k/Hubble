<?php
$items = Array('+','-','*');
$chapta1 = rand(0, 10);
$chapta2 = rand(0, 10);
$chapta_operator = $items[array_rand($items)];
?>
<form action="login/register.php" method="post" >
       <div class="form-group form-group-sm col-sm-3">
            <label class="col-sm-12 control-label" for="user">Username</label>
                <input type="text" class="col-sm-2 form-control" name="user" required="required"/>
            <label class="col-sm-12 control-label" for="pass">Password</label>
                <input type="password" class="form-control" name="pass" required="required">
            <label class="col-sm-12 control-label" for="passconf">Password (Confirm)</label>
                <input type="password" class="form-control" name="passconf" required="required">
			<label class="col-sm-12 control-label" for="inputchapta">Enter the answer to the question below in digits (eg. 42)</label>
			<label class="col-sm-12 control-label" for="passconf"><?php echo $chapta1;?> <?php echo $chapta_operator;?> <?php echo $chapta2;?></label>
				<input type="text" class="form-control" name="inputchapta" required="required">
				<input type="submit" class="form-control" name="login" value="Add User"/>
				<input type="hidden" class="form-control" name="chapta1" value="<?php echo $chapta1;?>"/>
				<input type="hidden" class="form-control" name="chapta2" value="<?php echo $chapta2;?>"/>
				<input type="hidden" class="form-control" name="chaptaoperator" value="<?php echo $chapta_operator;?>"/>
        </div>
        
</form>