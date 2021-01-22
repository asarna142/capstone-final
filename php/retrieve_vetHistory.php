<?php
    include_once ("./DBConnect.php");
    
    try{
    $conn = databaseConnect("Pet"); 
    $sql = "select * from VetHistory where id=?";
    $statement = sqlsrv_prepare($conn,$sql,array($_POST["vet_ID"]));
    $execute = sqlsrv_execute($statement);

    $arrkeyvalues;
    if ($execute){
        while ($row = sqlsrv_fetch_object($statement)){
            $arrkeyvalues = array("date" => $row->date, "name" => $row->name,  "location" => $row->location,  "details" => $row->details,  "k9_rabies" => $row->k9_rabies,  "k9_distemper" => $row->k9_distemper, "k9_parvo" => $row->k9_parvo,
                "k9_adeno1" => $row->k9_adeno1, "k9_adeno2" => $row->k9_adeno2, "k9_parainfluenza" => $row->k9_parainfluenza, "k9_bordetella" => $row->k9_bordetella, "k9_lyme" => $row->k9_lyme, "k9_leptospirosis" => $row->k9_leptospirosis,
                "k9_influenza" => $row->k9_influenza, "feline_rabies" => $row->feline_rabies, "feline_distemper" => $row->feline_distemper, "feline_herpes" => $row->feline_herpes, "feline_calici" => $row->feline_calici,
                "feline_leukemia" => $row->feline_leukemia, "feline_bordetella" => $row->feline_bordetella, "Species" => $row->species);
        }
    }
    
    sqlsrv_close($conn);
    
    echo json_encode($arrkeyvalues);

    } catch (Throwable $e){	
        echo "Throwable error " . $e;
    }
?>