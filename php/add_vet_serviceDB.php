<?php
	
require_once "./DBConnect.php";

$connection = databaseConnect("Pet");
try {
	$sql = "Insert into PetHistory (petId, serviceName, date, locationId, details) values (?, ?, ?, ?, ?)";

	$params = array($_POST["petId"], "Veterinary", $_POST["serviceDate"], $_POST["locationId"], $_POST["details"]);

	$statement = sqlsrv_prepare($connection, $sql, $params);
	$final = sqlsrv_execute($statement);

	if ($final === false){
		return "SQL Server Error: " . sqlsrv_errors();
	}

} catch (Throwable $e) {
	return "Throwable error: " . $e;
	
	
}



?>