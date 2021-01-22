
<?php
	
require_once "./DBConnect.php";

$connection = databaseConnect("Pet");
try {
    $sql = "SELECT * FROM Locations WHERE id=?";
    
    $params = array($_POST["id"]);
    //$params = array(30);

	$statement = sqlsrv_prepare($connection, $sql, $params);
	$final = sqlsrv_execute($statement);

    $keyName;
    if($final) {
        while($row = sqlsrv_fetch_object($statement)) {
            $keyName = array("Location"=>$row->businessName);
        }
    }

    sqlsrv_close($connection);

    echo json_encode($keyName);

} catch (Throwable $e) {
	return "Throwable error: " . $e;
}

?>