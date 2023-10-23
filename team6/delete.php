<?php
$ID =$_REQUEST['id'];

 require_once("config.php");

 $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
  or die("<strong style = 'color: red;'>Could not connect to database!</strong>");

  //issue query instructions
  $query = "DELETE FROM digs WHERE digs_id = $ID";

  $results = mysqli_query($conn, $query)
  or die("<strong style = 'color: red;'>Unable to exequte query</strong>");

  header("Location:agent.php");

  mysqli_close($conn);
?>