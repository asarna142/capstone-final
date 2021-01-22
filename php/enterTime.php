<?php
    function databaseConnect() {
            
        $username = "teampurple2999capstone";
        $password = "$" . "teamPurple" . "!";
        $database = "HelloWorld";
        // Assign $connectionInfo to array of key-value pairs
        $connectionInfo = array("UID" => $username,
                                "PWD" => $password,
                                "Database" => $database);
        return sqlsrv_connect("aa4fbu4uhl27r3.coyntr3y4wn1.us-east-1.rds.amazonaws.com", $connectionInfo);
    }
​;
	$conn = databaseConnect();
    echo "$('#enterTime').click(function() {";
    try {
        $sql = "insert into TimeStamp (time) values (GETDATE())";
              
        // Query execute using sql server function.
        $stmt = sqlsrv_prepare($conn, $sql, array($_POST["enter_time"]));
              
        if (sqlsrv_execute($stmt) === false):
        
            echo "Sql Server Error: " . sqlsrv_errors();
              
        endif;
    } catch (Exception $e) {
        echo "<p>" . $e . "</p>";
    } catch (Throwable $ee) {
        echo "<p>" . $ee . "</p>";
    }
    echo "});";
    // Close connection to database.
    sqlsrv_close($conn);
​
?>