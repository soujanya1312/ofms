<?php
include_once('connect.php');
session_start();
if(!isset($_SESSION['host']))
{
    echo'<script> window.location="403.php"</script>';
    
}
?>
