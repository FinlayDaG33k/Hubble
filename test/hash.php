<?php
echo password_hash($_GET['str'],PASSWORD_BCRYPT);
?>