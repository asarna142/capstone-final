
<?php

include_once ("../php/DBConnect.php");
//require_once ("../pages/pet_history.php");


try 
{
    $conn = databaseConnect("Pet");

    
    $param = array($_POST["pet_id"]);
    
    $sql = "SELECT * FROM PetHistory WHERE petId=? ORDER BY date";
    //$stmt = sqlsrv_query($conn, $sql);
    $stmt = sqlsrv_prepare($conn,$sql,$param);

    $execute = sqlsrv_execute($stmt);

    $rowKeyValues = array();
    if($execute){
            
            $num = 0;
            while($row = sqlsrv_fetch_object($stmt)) {
                
                $jsonService = "Service" . $num;
                $jsonDate = "Date" . $num;
                $jsonLocation = "Location" . $num;
                $jsonDetails = "Details" . $num;
                $jsonNails = "Nails" . $num;

                //change date format to string
                $sqlDate = $row->date;
                $dateString =$sqlDate->format('Y-m-d');

                //check for null details
                $detailString  = $row->details;
                if(is_null($detailString)) 
                    $detailString = "No Details";

                //check nails trimmed
                $nailsTrimmed = $row->nailsClipped;
                if($nailsTrimmed == 1){
                    $nailString = "Yes";
                } else {
                    $nailString = "No";
                }


                $instance = array(
                                    $jsonService =>$row->serviceName, 
                                    $jsonDate =>$dateString, 
                                    $jsonLocation =>$row->locationId,
                                    $jsonDetails =>$detailString,
                                    $jsonNails => $nailString
                                );
                $rowKeyValues = array_merge($rowKeyValues, $instance);

                $num++;
            }
    
    } else {
        $rowKeyValues = array("Service0" => "No Services");
    }

    //print_r($rowKeyValues);
        
    //send array of files to pet_history.php;
    echo json_encode($rowKeyValues);
    
} catch (Throwable $e) {
    echo "Throwable Caught: " . $e;
} catch (Exception $ee) {
    echo "Exception Caught: " . $ee;
}

sqlsrv_close($conn);
