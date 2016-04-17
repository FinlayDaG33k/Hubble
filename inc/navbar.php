<?php
                if(isset($_SESSION['user'])){
					include('inc/getapikey.php');
				}
            ?>

<script>
function showAPIkey() {
    window.prompt("Below is your API key.\nThere is no need to keep the key secret (yet), but don't go all YOLO and share it everywhere!\nAPI Key:","<?php echo $apikey; ?>");
}
</script>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Hubble</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if($_GET['action'] == "home"){?>class="active"<?php }?>><a href="?action=home">Home <span class="sr-only">(current)</span></a></li>
		<li <?php if($_GET['action'] == "donate"){?>class="active"<?php }?>><a href="?action=donate">Donate <?php if($_GET['action'] == "donate"){?><span class="sr-only">(current)</span><?php }?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
            <?php
                if(!isset($_SESSION['user'])){
            ?>
                        <a href="?action=login"><?php echo LANG_LOGIN; ?></a>
            <?php
                }
            ?>
        </li>
		<li>
		    <?php
                if(!isset($_SESSION['user'])){
            ?>
                        <a href="?action=register">Register</a>
            <?php
                }
            ?>
		</li>
        <?php
         if(isset($_SESSION['user'])){
        ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo LANG_WELCOME_LOGIN_LOGGEDIN . $_SESSION['user'] ."! ";?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="?action=addserver">Add Server</a></li>
                  <li><a href="?action=changepassword">Change Password</a></li>
				  <li><a href="#" onclick="showAPIkey()">View API key</a></li>
				  <?php 
					include('inc/checkadmin.php');
					if($is_admin == true){?>
					<li role="separator" class="divider"></li>
					<li><a href="?action=adduser">Add User</a></li>
					<?php
					}
				  ?>
                  <li role="separator" class="divider"></li>
                  <li><a href="?action=logout">Logout</a></li>
                </ul>
            </li>
        <?php
         }
        ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>