<?php

include_once ("../php/DBConnect.php");

$conn = databaseConnect("Pet");
if ($conn) {
    echo "Database Connection Successful!";
}

try {
    
    $sql = "INSERT INTO Locations (businessName, address, city, state, zip, email, phoneNumber, vetChecked, groomerChecked, boarderChecked) VALUES (?,?,?,?,?,?,?,?,?,?)";

    $params = array($_POST["business_name"], $_POST["business_street"],$_POST["business_city"],$_POST["business_state"],
        $_POST["business_zip"],$_POST["business_email"],$_POST["business_phone"], $_POST["business_vetservice"],$_POST["business_groomingservice"], $_POST["business_boardservice"]);
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