<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


 <!-- bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>



<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<!-- custom stylesheet -->
<link rel="stylesheet" href="css/bootstrap-switch.css">

<!-- custom JS -->
<script src="js/bootstrap-switch.js"></script>

<?php
if($_SESSION['skin'] == "classic"){
?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<?php
}else{
?>
	<link rel="stylesheet" href="css/superhero.css">
	
<?php
}
?>
