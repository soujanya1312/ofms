<?php
include_once('connect.php');
session_start();
if(!isset($_SESSION['pusername']))
{
    echo'<script> window.location="403.php"</script>';
    
}
?>
