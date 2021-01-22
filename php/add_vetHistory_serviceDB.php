<?php
	
require_once "./DBConnect.php";

$connection = databaseConnect("Pet");
try {
	$sql = "Insert into VetHistory (date, name, location, details, k9_rabies, k9_distemper, k9_parvo, k9_adeno1, k9_adeno2, k9_parainfluenza, k9_bordetella, k9_lyme, k9_leptospirosis, k9_influenza, feline_rabies,
		feline_distemper, feline_herpes, feline_calici, feline_leukemia, feline_bordetella, species) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

	$params = array($_POST["serviceDate"], $_POST["petName"], $_POST["locationName"], $_POST["details"], $_POST["k9_rabies"],  $_POST["k9_distemper"],  $_POST["k9_parvo"],  $_POST["k9_adeno1"],  $_POST["k9_adeno2"],
					$_POST["k9_parainfluenza"], $_POST["k9_bordetella"], $_POST["k9_lyme"], $_POST["k9_leptospirosis"], $_POST["k9_influenza"], $_POST["feline_rabies"], $_POST["feline_distemper"], $_POST["feline_herpes"],
					$_POST["feline_calici"], $_POST["feline_leukemia"], $_POST["feline_bordetella"], $_POST["species"]);
					
	$statement = sqlsrv_prepare($connection, $sql, $params);
	$final = sqlsrv_execute($statement);
	
} catch (Throwable $e) {
	return "Throwable error: " . $e;	
}

?>