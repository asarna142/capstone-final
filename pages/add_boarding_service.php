<?php
    session_start();
    include_once("../php/DBConnect.php");

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
    
    function boardingLocations() {
        $conn = databaseConnect("Pet");
		try {
			$sql = "select id, businessName as name from Locations where boarderChecked = 1 and visible = 1";
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
        var currentMonth = new Date().getMonth();
        if (currentMonth > 0 && currentMonth < 10) {
            currentMonth = "0" + currentMonth;
        } else {
            currentMonth += 1;
        }
        var currentDay = new Date().getDate();
        if (currentDay < 10) {
            currentDay = "0" + currentDay;
        }
        document.getElementById("service_date_id").setAttribute("min", new Date().getFullYear() + "-" + currentMonth + "-" + currentDay);

        $("#signup").click(function() {
            new UserLogin('..').signup();
        });

        $("#login").click(function() {
            new UserLogin('..').userLogin();
        });

        $('#logout').click(function() {
            new UserLogin('..').userLogOut();
        });

        $("#save_service").click(function() {

            if (document.getElementById("select_pet_control").value == "" && document.getElementById("select_boarding_location").value == "" && document.getElementById("service_date_id").value == "") {
                alert("You must select a pet name, boarding location and service date.");
                return;
            } else if (document.getElementById("select_pet_control").value == "" && document.getElementById("select_boarding_location").value == "") {
                alert("You must select a pet name and boarding location.");
                return;
            } else if (document.getElementById("select_boarding_location").value == "" && document.getElementById("service_date_id").value == "") {
                alert("You must select a boarding location and a service date.");
                return;
            } else if (document.getElementById("service_date_id").value == "") {
                alert("You must select a service date.");
                return;
            } else if (document.getElementById("select_pet_control").value == "") {
                alert("You must select a pet name.");
                return;
            } else if (document.getElementById("select_boarding_location").value == "") {
                alert("You must select a boarding location.");
                return;
            }

            var startDate = document.getElementById("service_date_id").value;
            var petChosen = document.getElementById("select_pet_control");
            var boardingChosen = document.getElementById("select_boarding_location");
            var text = document.getElementById("detail_entry").value;

            $.post({
                url: "../php/add_boarding_serviceDB.php",
                data: {
                    service_date: startDate,
                    boarding_location: boardingChosen.options[boardingChosen.selectedIndex].id,
                    pet_id: petChosen.options[petChosen.selectedIndex].id,
                    details: text

                },
                success: function(response) {
                    if (response !== "") {
                        alert(response);
                    } else {
                        alert(petChosen.value + "'s boarding session added for " + startDate + ". See you then!", "Boarding Service");
                    }
                    location.reload();
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
            <img src=" ../images/title_banner/Add_Boarding_Service.png" class="img-fluid mx-auto" alt="Add Boarding Service">
        </div>
    </div>

    <form>
        <div class="row">
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
                    <legend class="control-legend" id="select_pet">Boarding Location</legend>
                    <select class="form-control col-8" id="select_boarding_location" required>
                        <!-- Select Pet Dropdown Options -->
                        <option value="" selected disabled>Select Boarder</option>
                        <?php boardingLocations(); ?>
                    </select>
                </div>
                <!-- Service Date -->
                <div class="form-group col-lg-10">
                    <legend class="control-legend">Start Date for Boarding Service</legend>
                    <input class="form-control col-5 col-sm-7 col-md-6 col-lg-5 col-xl-4" type="date" id="service_date_id">
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
