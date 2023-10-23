<?php
$TenantID =$_REQUEST['id'];

 require_once("config.php");

 $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
  or die("<strong style = 'color: red;'>Could not connect to database!</strong>");

  //issue query instructions
  $query = "DELETE FROM tenants WHERE tenant_id = $TenantID";

  $results = mysqli_query($conn, $query)
  or die("<strong style = 'color: red;'>Unable to exequte query</strong>");

  header("Location:userM.php");

  mysqli_close($conn);
?>