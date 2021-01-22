<?php
    session_start();
    include_once("../php/DBConnect.php");
    include (__DIR__ . "/../php/modals/Modals.html");

    //Pet Selector
	function comboboxOptions() {
		$conn = databaseConnect("Pet");
		try {
			$sql = "select id, name from Pets where visible = 1";
			$stmt = sqlsrv_query($conn, $sql);
			if ($stmt === false) {
				echo "Error Occurred: " . sqlsrv_errors();
			} else {
				$storeValueId;
				while ($row = sqlsrv_fetch_object($stmt)) {
					echo "<option id = " . $row->id . " value = ". $row->name .">" . $row->name . "</option>";
				}
			}
		} catch (Throwable $e) {
			echo "Throwable Error: " . $e;
		}
        sqlsrv_close($conn);
    }

    //Vet Selector
	function chooseLocation() {
		$conn = databaseConnect("Pet");
		try {
			$sql = "select id, businessName from Locations WHERE vetChecked = 1 and visible = 1";
			$stmt = sqlsrv_query($conn, $sql);
			if ($stmt === false) {
				echo "Error Occurred: " . sqlsrv_errors();
			} else {
				$storeValueId;
				while ($row = sqlsrv_fetch_object($stmt)) {
					echo "<option id = " . $row->id . " value = " . $row->businessName . ">" . $row->businessName . "</option>";
				}
			}
		} catch (Throwable $e) {
			echo "Throwable Error: " . $e;
		}
        sqlsrv_close($conn);

    }
        
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

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<script type="text/javascript">
    $(document).ready(function() {
        var idNum = document.getElementById("select_pet_control");
        var species;

        $("#signup").click(function() {
            new UserLogin('..').signup();
        });

        $("#login").click(function() {
            new UserLogin('..').userLogin();
        });

        $('#logout').click(function() {
            new UserLogin('..').userLogOut();
        });

        $("#select_pet_control").change(function() {
            $.post({
                url: "../php/retrieve_pet.php",
                data: {
                    pet_ID: idNum.options[idNum.selectedIndex].id
                },
                success: function(feedback) {
                    var json = JSON.parse(feedback);
                    species = json["Species"];
                    if (json["Species"] == "Dog") {
                        $('#k9_vaccine_checkboxes').show();
                        $('#feline_vaccine_checkboxes').hide();
                    } else if (json["Species"] == "Cat") {
                        $('#k9_vaccine_checkboxes').hide();
                        $('#feline_vaccine_checkboxes').show();
                    } else {
                        $('#k9_vaccine_checkboxes').hide();
                        $('#feline_vaccine_checkboxes').hide();
                    }
                }
            });
        });
        $("#save_service").click(function() {


            var petChosen = (document.getElementById("select_pet_control"));
            var location = document.getElementById("select_location_control");
            var text = document.getElementById("detail_entry").value;

            var k9_vaccines_list = document.getElementsByName("k9_vaccines");
            for (i = 0; i < k9_vaccines_list.length; i++) {
                if (k9_vaccines_list[i].checked) {
                    k9_vaccines_list[i].value = 1;
                } else {
                    k9_vaccines_list[i].value = 0;
                }
            }
            var feline_vaccines_list = document.getElementsByName("feline_vaccines");
            for (i = 0; i < feline_vaccines_list.length; i++) {
                if (feline_vaccines_list[i].checked) {
                    feline_vaccines_list[i].value = 1;
                } else {
                    feline_vaccines_list[i].value = 0;
                }
            }

            $.post({
                url: "../php/add_vet_serviceDB.php",
                data: {
                    petId: petChosen.options[petChosen.selectedIndex].id,
                    serviceDate: document.getElementById("service_date_id").value,
                    locationId: location.options[location.selectedIndex].id,
                    details: text
                },
                success: function() {
                    $('#addition_successful').modal();
                },
                error: function(err) {
                    alert("Err " + err);
                }
            });

            $.post({
                url: "../php/add_vetHistory_serviceDB.php",
                data: {
                    petName: document.getElementById("select_pet_control").value,
                    serviceDate: document.getElementById("service_date_id").value,
                    locationName: document.getElementById("select_location_control").value,
                    details: text,
                    k9_rabies: document.getElementById("k9_rabies_Id").value,
                    k9_distemper: document.getElementById("k9_distemper_Id").value,
                    k9_parvo: document.getElementById("k9_parvo_Id").value,
                    k9_adeno1: document.getElementById("k9_adeno1_Id").value,
                    k9_adeno2: document.getElementById("k9_adeno2_Id").value,
                    k9_parainfluenza: document.getElementById("k9_parainfluenza_Id").value,
                    k9_bordetella: document.getElementById("k9_bordetella_Id").value,
                    k9_lyme: document.getElementById("k9_lyme_Id").value,
                    k9_leptospirosis: document.getElementById("k9_leptospirosis_Id").value,
                    k9_influenza: document.getElementById("k9_influenza_Id").value,
                    feline_rabies: document.getElementById("feline_rabies_Id").value,
                    feline_distemper: document.getElementById("feline_distemper_Id").value,
                    feline_herpes: document.getElementById("feline_herpes_Id").value,
                    feline_calici: document.getElementById("feline_calici_Id").value,
                    feline_leukemia: document.getElementById("feline_leukemia_Id").value,
                    feline_bordetella: document.getElementById("feline_bordetella_Id").value,
                    species: species
                },
                success: function() {
                    $('#addition_successful').modal();
                },
                error: function(err) {
                    alert("Err " + err);
                }
            });
        });
    });

</script>

<body>

    <?php require_once '../navigation/pages-navbar.php'; ?>

    <div class="container">
        <div class="row">
            <img src=" ../images/title_banner/Add_Veterinary_Service.png" class="img-fluid mx-auto" alt="Add Veterinary Service">
        </div>
    </div>

    <form>
        <div class="row">
            <!-- Left Column-->
            <div class="col-md-6">
                <!-- Pet Name -->
                <div class="form-group col-md-12">
                    <legend class="control-legend" id="select_pet">For</legend>
                    <select class="form-control col-8" id="select_pet_control" required>
                        <!-- Select Pet Dropdown Options -->
                        <option value="" selected disabled>Select Pet</option>
                        <?php comboboxOptions(); ?>
                    </select>
                </div>
                <div class="form-group col-12">
                    <legend class="control-legend" id="select_location">Veterinary Location</legend>
                    <select class="form-control col-8" id="select_location_control" required>
                        <!-- Select Location Dropdown Options -->
                        <option value="" selected disabled>Select Veterinary</option>
                        <?php chooseLocation(); ?>
                    </select>
                </div>
                <!-- Veterinary Service Date -->
                <div class="form-group col-lg-10">
                    <legend class="control-legend">Date of Veterinary Service</legend>
                    <input class="form-control col-5 col-sm-7 col-md-6 col-lg-5 col-xl-4" type="date" id="service_date_id">
                </div>
            </div>
            <!-- Right Column-->
            <div class="col-md-6">
                <div class="row" id="k9_vaccine_checkboxes" style="display: none">
                    <legend>Canine Vaccines</legend>
                    <!-- K9 Vaccines Left Column-->
                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_rabies_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label" for="k9_rabies_Id">Rabies</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_distemper_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label" for="k9_distemper_Id">Distemper</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_parvo_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label" for="k9_parvo_Id">Parvovirus</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_adeno1_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label" for="k9_adeno1_Id">Adenovirus, Type 1</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_adeno2_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label" for="k9_adeno2_Id">Adenovirus, Type 2</label>
                        </div>
                    </div>
                    <!-- K9 Vaccines Right Column-->
                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_parainfluenza_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label" for="k9_parainfluenza_Id">Parainfluenza</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_bordetella_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label" for="k9_bordetella_Id">Bordetella</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_lyme_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label" for="k9_lyme_Id">Lyme Disease</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_leptospirosis_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label" for="k9_leptospirosis_Id">Leptospirosis</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="k9_influenza_Id" name="k9_vaccines" value="">
                            <label class="custom-control-label" for="k9_influenza_Id">Canine Influenza</label>
                        </div>
                    </div>
                </div>
                <!-- Feline Vaccines-->
                <div class="row" id="feline_vaccine_checkboxes" style="display: none">
                    <legend>Feline Vaccines</legend>
                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="feline_rabies_Id" name="feline_vaccines" value="">
                            <label class="custom-control-label" for="feline_rabies_Id">Rabies</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="feline_distemper_Id" name="feline_vaccines" value="">
                            <label class="custom-control-label" for="feline_distemper_Id">Feline Distemper</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="feline_herpes_Id" name="feline_vaccines" value="">
                            <label class="custom-control-label" for="feline_herpes_Id">Feline Herpesvirus</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="feline_calici_Id" name="feline_vaccines" value="">
                            <label class="custom-control-label" for="feline_calici_Id">Calicivirus</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="feline_leukemia_Id" name="feline_vaccines" value="">
                            <label class="custom-control-label" for="feline_leukemia_Id">Feline Leukemia Virus</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="feline_bordetella_Id" name="feline_vaccines" value="">
                            <label class="custom-control-label" for="feline_bordetella_Id">Bordetella</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details -->
        <div class="col-md-6 mx-auto">
            <div class="form-group">
                <legend class="control-legend">Enter Details</legend>
                <textarea class="form-control" rows="9" cols="50" id="detail_entry" placeholder="Enter Details..."></textarea>
            </div>
        </div>
    </form>

    <!-- Save Button -->
    <div class="form-group text-center">
        <button class="btn btn-primary" id="save_service">Submit</button>
    </div>

</body>

</html>
