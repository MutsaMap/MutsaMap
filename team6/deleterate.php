<?php
$ID =$_REQUEST['id'];

require_once("config.php");

$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
 or die("<strong style = 'color: red;'>Could not connect to database!</strong>");

 //issue query instructions
 $query = "DELETE FROM ratings INNER JOIN tenants ON ratings.tenant_id = tenants.tenant_id WHERE digs_id = $ID";

 $results = mysqli_query($conn, $query)
 or die("<strong style = 'color: red;'>Unable to exequte query</strong>");

 header("Location:review.php");

 mysqli_close($conn);
?>
