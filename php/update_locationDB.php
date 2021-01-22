
  
<?php

include_once ("./DBConnect.php");

try{

	$conn = databaseConnect("Pet"); 
	
	$sql = "UPDATE Locations SET businessName = ?, address = ?, city = ?, state = ?, zip = ?, email = ?, phoneNumber = ?, vetChecked = ?, groomerChecked = ?, boarderChecked = ? WHERE id = ?";
	
	$statement = sqlsrv_prepare($conn,$sql,array($_POST["business_name"], $_POST["business_street"], $_POST["business_city"], $_POST["business_state"], $_POST["business_zip"], 
		$_POST["business_email"], $_POST["business_phone"],$_POST["business_vetservice"], $_POST["business_groomingservice"], $_POST["business_boardservice"], $_POST["location_ID"]));
	
	sqlsrv_execute($statement);	
	
} catch (Throwable $e){
	
	echo "Throwable error " . $e;
	
}
?>