<?php
session_start();

session_destroy();

echo " <script>window.open('?action=home','_self')</script>";

?>