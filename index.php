<?php

    session_start();
    // loadup the config file
    require('config.inc.php');

    // loadup the language file
    include('lang/'. CONF_LANG . '.php');
    
    // Get page based on `?action=` variable
	$disallowed_paths = array('header', 'footer'); 
	if (!empty($_GET['action'])) {
		$tmp_action = basename($_GET['action']);
			if (!in_array($tmp_action, $disallowed_paths) && file_exists("pages/{$tmp_action}.php")) {
				$action = $tmp_action;
			} else {
				$action = 404;
			}
	} else {
		$action = home;
	}
?>
<html>
    <head>
        <title>Hubble</title>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/inc/head.php') ?>
    </head>
    <body>
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/inc/navbar.php') ?>
			<div class="content">
			<div class="container">
				<?php include("pages/$action.php"); ?>
			</div>
			</div>
			<div class="container">
			<footer class="footer">
				
					<p class="text-muted"><?php include("inc/footer.php"); ?></p>
				
			</footer>
			</div>
    </body>
</html>

