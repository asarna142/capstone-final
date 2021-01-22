  <?php

include_once ("./DBConnect.php");

try{

	$conn = databaseConnect("Pet"); 
	
	$sql = "UPDATE Pets SET name = ?, species = ?, birthdate = ?, weight = ?, street = ?, city = ?, state = ?, zip = ?, chipId = ? WHERE id = ?";
	
	$statement = sqlsrv_prepare($conn,$sql,array($_POST["pet_name"], $_POST["pet_species"], $_POST["pet_birthdate"], $_POST["pet_weight"], $_POST["pet_street"], $_POST["pet_city"], $_POST["pet_state"],$_POST["pet_zip"], $_POST["pet_chip"], $_POST["pet_ID"]));
	if (sqlsrv_execute($statement)) {
		echo 'Successful';
	} else {
		echo 'Error';
	}
	
} catch (Throwable $e){
	
	echo "Throwable error " . $e;
	
}

?>
