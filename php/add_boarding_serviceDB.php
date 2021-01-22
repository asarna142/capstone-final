<?php

require_once ("./DBConnect.php");

try {
    $conn = databaseConnect("Pet");

    //sql statement

    $sql = "INSERT INTO PetHistory (petId, serviceName, date, locationId, details) VALUES (?, ?, ?, ?, ?)";

    //data to pass into DB
    $params = array($_POST["pet_id"], "Boarding", $_POST["service_date"], $_POST["boarding_location"], $_POST["details"]);

    

    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if (sqlsrv_execute($stmt) === false) {
        echo "SQL Statement Error: " . sqlsrv_errors(); 
    }


} catch (Exception $e) {
    echo "Throwable Caught: " . $e;
} catch (Throwable $ee) {
    echo "Exception caught: " . $ee;
}

sqlsrv_close($conn);

?>