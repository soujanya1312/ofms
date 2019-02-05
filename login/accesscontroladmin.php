<?php
include_once('connect.php');
session_start();
if(!isset($_SESSION['admin']))
{
    echo'<script> window.location="403.php"</script>';
    
}
?>
