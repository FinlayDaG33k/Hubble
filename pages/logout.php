<?php
session_start();
session_destroy();
session_regenerate_id();

echo " <script>window.open('?action=home','_self')</script>";

?>