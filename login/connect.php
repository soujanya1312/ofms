<?php
//creating a connection with the database
$connection=mysqli_connect("localhost","root","");
    if(!$connection)
    {
        echo"failed to connect to the database".mysqli_error($connection);
    }
    //else
   // {
       // echo"connected to database";
   // }

$dbselect=mysqli_select_db($connection,'ofms');
if(!$dbselect)
    {
        echo"cannot connect to the database";
    }
?>