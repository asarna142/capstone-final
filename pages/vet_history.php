<?php
    session_start();
    include_once("../php/DBConnect.php");
    
    //Fill Table
	$connect = databaseConnect("Pet");
	$query = "SELECT * FROM VetHistory";
	$result = sqlsrv_query($connect, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Companion Vault</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="../js/LoginClass.js" type="text/ecmascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/secondnav_toggle.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-table.min.js"></script>
    <script src="../js/bootstrap-table-filter-control.min.js"></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap-table-filter-control.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<script type="text/javascript">
    $(document).ready(function() {
        var $table = $('#table');
        $table.bootstrapTable();

        $("#signup").click(function() {
            new UserLogin('..').signup();
        });

        $("#login").click(function() {
            new UserLogin('..').userLogin();
        });

        $('#logout').click(function() {
            new UserLogin('..').userLogOut();
        });
    });

</script>

<body>
    <!-- Do Not Move - php headernav from here-->
    <?php require_once '../navigation/pages-navbar.php'; ?>

    <div class="container">
        <div class="row">
            <img src=" ../images/title_banner/Veterinary_History.png" class="img-fluid mx-auto" alt="Veterinary History">
        </div>
    </div>

    <div class="container">
        <!-- data-search="true" -->
        <table id="table" class="table table-hover" data-toggle="table" data-filter-control="true">
            <thead>
                <tr>
                    <th data-field="id" data-visible="false">Id</th>
                    <th data-field="date" data-sortable="true">Date</th>
                    <th data-field="name" data-filter-control="select">Pet</th>
                    <th data-field="location" data-filter-control="select">Location</th>
                    <th data-field="details" data-filter-control="input">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = sqlsrv_fetch_array($result))
            {echo
                "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["date"]."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["location"]."</td>
                    <td>".$row["details"]."</td>
                </tr>";
            }
        ?>
            </tbody>
        </table>
    </div>


    <form id="filled_form" hidden>
        <div class="row">
            <!-- Left Column-->
            <div class="col-md-6">
                <!-- Pet Name -->
                <div class="form-group col-md-12">
                    <legend class="control-legend" id="select_pet">Pet</legend>
                    <div class="card bg-light col-4 p-1">
                        <p class="mb-0" id="name_card"></p>
                    </div>
                </div>
                <div class="form-group col-12">
                    <legend class="control-legend" id="select_location">Veterinary Location</legend>
                    <div class="card bg-light col-4 p-1">
                        <p class="mb-0" id="location_card"></p>
                    </div>
                </div>
                <!-- Veterinary Service Date -->
                <div class="form-group col-lg-10">
                    <legend class="control-legend">Date of Veterinary Service</legend>
                    <div class="card bg-light col-4 p-1">
                        <p class="mb-0" id="date_card"></p>
                    </div>
                </div>
            </div>
            <!-- Right Column-->
            <div class="col-md-6">
            <div class="container">
            <!-- K9 Vaccines-->
                <div class="row" id="k9_vaccine_checkboxes" style="display: none">
                    <div class="form-group col-lg-12">
                        <legend class="control-legend">Canine Vaccines</legend>
                    </div>
                        <!-- K9 Vaccines Left Column-->
                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_rabies_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label">Rabies</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_distemper_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label">Distemper</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_parvo_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label">Parvovirus</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_adeno1_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label">Adenovirus, Type 1</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_adeno2_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label">Adenovirus, Type 2</label>
                        </div>
                    </div>
                    <!-- K9 Vaccines Right Column-->
                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_parainfluenza_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label">Parainfluenza</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_bordetella_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label">Bordetella</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_lyme_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label">Lyme Disease</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_leptospirosis_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label">Leptospirosis</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_influenza_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label">Canine Influenza</label>
                        </div>
                    </div>
                </div>
                <!-- Feline Vaccines-->
                <div class="row" id="feline_vaccine_checkboxes" style="display: none">
                <div class="col">
                        <div class="form-group col-lg-10">
                            <legend class="control-legend">Feline Vaccines</legend>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="feline_rabies_Id" name="feline_vaccines" value="">
                            <label class="custom-control-label">Rabies</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="feline_distemper_Id" name="feline_vaccines" value="">
                            <label class="custom-control-label">Feline Distemper</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="feline_herpes_Id" name="feline_vaccines" value="">
                            <label class="custom-control-label">Feline Herpesvirus</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="feline_calici_Id" name="feline_vaccines" value="">
                            <label class="custom-control-label">Calicivirus</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="feline_leukemia_Id" name="feline_vaccines" value="">
                            <label class="custom-control-label">Feline Leukemia Virus</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="feline_bordetella_Id" name="feline_vaccines" value="">
                            <label class="custom-control-label">Bordetella</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Details -->
        <div class="col-md-6 mx-auto">
            <div class="form-group">
                <legend class="control-legend">Enter Details</legend>
                <textarea class="form-control no-gray" rows="9" cols="50" id="detail_entry" readonly></textarea>
            </div>
        </div>
    </form>

    <script>
        var $table = $('#table')

        $(function() {
            $table.on('click-row.bs.table', function(e, row, $element) {

                $('#filled_form').addClass('d-block');

                $.post({
                    url: "../php/retrieve_vetHistory.php",
                    data: {
                        vet_ID: row.id
                    },
                    success: function(feedback) {
                        var json = JSON.parse(feedback);
                        document.getElementById("date_card").innerHTML = json["date"];
                        document.getElementById("location_card").innerHTML = json["location"];
                        document.getElementById("name_card").innerHTML = json["name"];
                        document.getElementById("detail_entry").innerHTML = json["details"];

                        if (json["Species"] == "Dog") {
                            $('#k9_vaccine_checkboxes').show();
                            $('#feline_vaccine_checkboxes').hide();
                        } else if (json["Species"] == "Cat") {
                            $('#k9_vaccine_checkboxes').hide();
                            $('#feline_vaccine_checkboxes').show();
                        } else {
                            $('#k9_vaccine_checkboxes').hide();
                            $('#feline_vaccine_checkboxes').hide();
                        };


                        // K9 Vaccine Left Column
                        if (json["k9_rabies"] == "1") {
                            document.getElementById("k9_rabies_Id").checked = true;
                        } else {
                            document.getElementById("k9_rabies_Id").checked = false;
                        };
                        if (json["k9_distemper"] == "1") {
                            document.getElementById("k9_distemper_Id").checked = true;
                        } else {
                            document.getElementById("k9_distemper_Id").checked = false;
                        };
                        if (json["k9_parvo"] == "1") {
                            document.getElementById("k9_parvo_Id").checked = true;
                        } else {
                            document.getElementById("k9_parvo_Id").checked = false;
                        };
                        if (json["k9_adeno1"] == "1") {
                            document.getElementById("k9_adeno1_Id").checked = true;
                        } else {
                            document.getElementById("k9_adeno1_Id").checked = false;
                        };
                        if (json["k9_adeno2"] == "1") {
                            document.getElementById("k9_adeno2_Id").checked = true;
                        } else {
                            document.getElementById("k9_adeno2_Id").checked = false;
                        };
                        // K9 Vaccine Right Column
                        if (json["k9_parainfluenza"] == "1") {
                            document.getElementById("k9_parainfluenza_Id").checked = true;
                        } else {
                            document.getElementById("k9_parainfluenza_Id").checked = false;
                        };
                        if (json["k9_bordetella"] == "1") {
                            document.getElementById("k9_bordetella_Id").checked = true;
                        } else {
                            document.getElementById("k9_bordetella_Id").checked = false;
                        };
                        if (json["k9_lyme"] == "1") {
                            document.getElementById("k9_lyme_Id").checked = true;
                        } else {
                            document.getElementById("k9_lyme_Id").checked = false;
                        };
                        if (json["k9_leptospirosis"] == "1") {
                            document.getElementById("k9_leptospirosis_Id").checked = true;
                        } else {
                            document.getElementById("k9_leptospirosis_Id").checked = false;
                        };
                        if (json["k9_influenza"] == "1") {
                            document.getElementById("k9_influenza_Id").checked = true;
                        } else {
                            document.getElementById("k9_influenza_Id").checked = false;
                        };
                        // Feline Vaccine Column
                        if (json["feline_rabies"] == "1") {
                            document.getElementById("feline_rabies_Id").checked = true;
                        } else {
                            document.getElementById("feline_rabies_Id").checked = false;
                        };
                        if (json["feline_distemper"] == "1") {
                            document.getElementById("feline_distemper_Id").checked = true;
                        } else {
                            document.getElementById("feline_distemper_Id").checked = false;
                        };
                        if (json["feline_herpes"] == "1") {
                            document.getElementById("feline_herpes_Id").checked = true;
                        } else {
                            document.getElementById("feline_herpes_Id").checked = false;
                        };
                        if (json["feline_calici"] == "1") {
                            document.getElementById("feline_calici_Id").checked = true;
                        } else {
                            document.getElementById("feline_calici_Id").checked = false;
                        };
                        if (json["feline_leukemia"] == "1") {
                            document.getElementById("feline_leukemia_Id").checked = true;
                        } else {
                            document.getElementById("feline_leukemia_Id").checked = false;
                        };
                        if (json["feline_bordetella"] == "1") {
                            document.getElementById("feline_bordetella_Id").checked = true;
                        } else {
                            document.getElementById("feline_bordetella_Id").checked = false;
                        };
                    }
                });
            })
        })

    </script>
</body>

</html>
