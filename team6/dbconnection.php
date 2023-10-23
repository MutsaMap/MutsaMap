<?php

    //insert the database information (similar to "config.php)
define("SERVERNAME", "is3-dev.ict.ru.ac.za");
define("USERNAME",  "Team_6");
define("PASSWORD", "Team_6$");
define("DATABASE", "team_6");
    //insert the database information
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("Cannot connect to the database");
?>