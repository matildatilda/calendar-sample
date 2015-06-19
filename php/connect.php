<?php
    //https://docs.c9.io/v1.0/docs/setting-up-mysql
    
    // A simple PHP script demonstrating how to connect to MySQL.
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console.

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "sandbox";
    $dbport = 3306;

    // Create connection
    $mysqli = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error."\n");
    } 
    //echo "Connected successfully (".$mysqli->host_info.")\n";

    $mysqli->select_db('sandbox');
    $mysqli->query("SET NAMES utf8");
    
    $mon = $_GET["month"];
    $sql = "SELECT * FROM holidays WHERE month = ". $mon;
    //echo $sql;
    
    $result = $mysqli->query($sql);
    if (!$result) {
        die("Query failed. (" .mysql_error(). ")\n");
    }
    
    header("Content-Type: text/html; charset=UTF-8");
    
    while ($row = $result->fetch_row()) {
        printf ("%s/%s:%s\n", $row[0], $row[1], $row[2]);
    }

    $result->close();
    $mysqli->close();
?>