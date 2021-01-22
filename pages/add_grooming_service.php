<?php
    session_start();
    include_once ("../php/DBConnect.php");
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
					echo "<option id = " . $row->id . " value = " . $row->name . ">" . $row->name . "</option>";
				}
			}
		} catch (Throwable $e) {
			echo "Throwable Error: " . $e;
		}
        sqlsrv_close($conn);
    }

     //Groomer Select?
     function groomerOptions() {
		$conn = databaseConnect("Pet");
		try {
			$sql = "select id, businessName from Locations WHERE  groomerChecked = 1 and visible = 1";
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

<head>
</head>
<script type="text/javascript">
    $(document).ready(function() {

        $("#signup").click(function() {
            new UserLogin('..').signup();
        });

        $("#login").click(function() {
            new UserLogin('..').userLogin();
        });

        $('#logout').click(function() {
            new UserLogin('..').userLogOut();
        });

        $("#save_grooming_service").click(function() {

            //assign form pieces to variables
            var petChosen = document.getElementById("select_pet_control");
            var grooming_date = document.getElementById("grooming_date_id").value;
            var locationName = document.getElementById("select_groomer_control");
            var text = document.getElementById("detail_entry").value;
            var nailsClipped = document.getElementById("nailsClipped");

            //send to file to send to DB
            $.post({
                url: "../php/add_gooming_serviceDB.php",
                data: {
                    pet_id: petChosen.options[petChosen.selectedIndex].id,
                    serviceDate: grooming_date,
                    locationId: locationName.options[locationName.selectedIndex].id,
                    nails_trimmed: nailsClipped.checked,
                    details: text

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
            <img src=" ../images/title_banner/Add_Grooming_Service.png" class="img-fluid mx-auto" alt="Add Grooming Service">
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
                    <legend class="control-legend" id="select_groomer">Groomer Location</legend>
                    <select class="form-control col-8" id="select_groomer_control" required>
                        <!-- Select Groomer Dropdown Options -->
                        <option value="" selected disabled>Select Groomer</option>
                        <?php groomerOptions(); ?>
                    </select>
                </div>
                <!-- Grooming Service Date -->
                <div class="form-group col-lg-10">
                    <legend class="control-legend">Date of Grooming Service</legend>
                    <input class="form-control col-5 col-sm-7 col-md-6 col-lg-5 col-xl-4" type="date" id="grooming_date_id">
                </div>
            </div>
            <!-- Right Column-->
            <div class="col-md-6">
                <!-- Service Checkbox -->
                <div class="form-group col-sm-10">
                    <legend class="control-legend">Service Provided</legend>
                    <div class="custom-control custom-checkbox mb-3">
                        <!-- Nails Trimmed Service -->
                        <input type="checkbox" class="custom-control-input" id="nailsClipped" value="nails_trimmed">
                        <label class="custom-control-label" for="nailsClipped">Nails Trimmed</label>
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
        <button class="btn btn-primary" id="save_grooming_service">Submit</button>
    </div>

</body>

</html>
