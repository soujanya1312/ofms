
<?php
include_once 'connect.php';
session_start();
if(!(isset($_SESSION['husername'])))
{
	echo'<script> window.location="403.php";</script>';
}
?>