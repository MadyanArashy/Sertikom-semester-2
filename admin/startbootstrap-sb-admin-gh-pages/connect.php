<?php
$hostname = "localhost"; //SQL Server database (DBMS)
$username = "root"; //Root server name to access database
$password = ""; //Database password (none by default)
$database_name = "db_expro-hotel"; //choose database to access

$connect = mysqli_connect($hostname, $username, $password, $database_name); // variable to access database

// validate connection
if (mysqli_connect_errno()) {
    echo "Connection Error: " . mysqli_connect_error();
    exit();
};

?>