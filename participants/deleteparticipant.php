<?php
require('connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
		$sql="DELETE  FROM participants WHERE pid=$id";
		$result = mysqli_query($connection, $sql);
		if($result)
		{
			echo "Deleted successfully.";
			//echo '<script> window.location="edit.php?id="; </script>';
		}
		else
		{
			echo "Error!".mysqli_error($connection);
		}
  }
}
?>
