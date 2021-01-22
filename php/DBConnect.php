<?php

function databaseConnect($database) {
            
    $username = "purple";
    $password = "$" . "teamPurple" . "!";
    // Assign $connectionInfo to array of key-value pairs
    $connectionInfo = array("UID" => $username,
                            "PWD" => $password,
                            "Database" => $database);
    return sqlsrv_connect("teampurple.cowm7eyucnpa.us-east-1.rds.amazonaws.com,1433", $connectionInfo);
}
