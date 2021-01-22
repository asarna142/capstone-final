
  
<?php

include_once ("./DBConnect.php");

try{

	$conn = databaseConnect("Pet"); 
	
	$sql = "UPDATE Locations SET visible = ? WHERE id = ?";
	
	$statement = sqlsrv_prepare($conn,$sql,array($_POST["visible"], $_POST["location_ID"]));
	
	sqlsrv_execute($statement);	
	
} catch (Throwable $e){
	
	echo "Throwable error " . $e;
	
}
?>