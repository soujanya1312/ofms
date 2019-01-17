<?php
include '../login/accesscontrolhead.php';
require('connect.php');
$ausername=$_SESSION['husername'];
?>
<html>
    <head>
    </head>
    <body>
        
        <h1>welcome <?php echo $ausername;
            ?></h1>
    </body>
</html>