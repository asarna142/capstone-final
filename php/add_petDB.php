<?php

include_once ("../php/DBConnect.php");

$conn = databaseConnect("Pet");
if ($conn) {
    echo "Database Connection Successful!";
}

try {
    
    $sql = "INSERT INTO Pets (name, species, birthdate, weight, street, city, state, zip, chipId) VALUES (?,?,?,?,?,?,?,?,?)";

    //var_dump($_POST["pet_name"]);
    $params = array($_POST["pet_name"], $_POST["pet_species"],$_POST["pet_birthday"],$_POST["pet_weight"],
        $_POST["pet_street"],$_POST["pet_city"],$_POST["pet_state"], $_POST["pet_zip"], $_POST["pet_chip"]);
    $stmt = sqlsrv_prepare($conn, $sql, $params);
    if (sqlsrv_execute($stmt) === false) {
        echo "SQL Statement Error: " . sqlsrv_errors(); 
    }
} catch (Throwable $e) {
    echo "Throwable Caught: " . $e;
} catch (Exception $ee) {
    echo "Exception Caught: " . $ee;
}

sqlsrv_close($conn);