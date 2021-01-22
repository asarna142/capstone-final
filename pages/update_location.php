<?php
    session_start();
	include_once(__DIR__."/../php/DBConnect.php");
	include (__DIR__ . "/../php/modals/Modals.html");
	
	function comboboxOptions() {
		// This php code works, all values come out as normal.
		// No need to mess with this.
		$conn = databaseConnect("Pet");
		try {
			$sql = "select id, businessName from Locations where visible = 1";
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
<html lang="en">

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
        var idNum = document.getElementById("select_location_control");

        $("#signup").click(function() {
            new UserLogin('..').signup();
        });

        $("#login").click(function() {
            new UserLogin('..').userLogin();
        });

        $('#logout').click(function() {
            new UserLogin('..').userLogOut();
        });

        $("#select_location_control").change(function() {
            $.post({
                url: "../php/retrieve_location.php",
                data: {
                    location_ID: idNum.options[idNum.selectedIndex].id
                },
                success: function(feedback) {
                    var json = JSON.parse(feedback);
                    document.getElementById("businessname_id").value = json["Name"];
                    document.getElementById("street_id").value = json["Street"];
                    document.getElementById("city_id").value = json["City"];
                    document.getElementById("state_id").value = json["State"];
                    document.getElementById("zip_id").value = json["Zip"];
                    document.getElementById("email_id").value = json["Email"];
                    document.getElementById("phone_id").value = json["Phone"];
                    // If Checkbox Statement
                    if (json["vetservice"] == "1") {
                        document.getElementById("vetservice_id").checked = true;
                    } else {
                        document.getElementById("vetservice_id").checked = false;
                    }
                    if (json["groomingservice"] == "1") {
                        document.getElementById("groomingservice_id").checked = true;
                    } else {
                        document.getElementById("groomingservice_id").checked = false;
                    }
                    if (json["boardingservice"] == "1") {
                        document.getElementById("boardingservice_id").checked = true;
                    } else {
                        document.getElementById("boardingservice_id").checked = false;
                    }

                }
            });
        });

        $("#remove_location_btn").click(function() {
			$('#remove_location_modal').modal();
		});

        $("#remove_location").click(function() {
			var visible = 0;
			$.post({
                url: "../php/remove_locationDB.php", 
				data: { visible: visible,
					    location_ID: idNum.options[idNum.selectedIndex].id
				}, 
				success: function() {
						$('#update_successful').modal();
				}            
			});
		});


        $("#update_location").click(function() {
            //assign form pieces to variables
            if (document.getElementById("vetservice_id").checked) {
                var vetserivce = 1
            } else {
                var vetserivce = 0
            }
            if (document.getElementById("groomingservice_id").checked) {
                var groomingserivce = 1
            } else {
                var groomingserivce = 0
            }
            if (document.getElementById("boardingservice_id").checked) {
                var boardingserivce = 1
            } else {
                var boardingserivce = 0
            }

            //send to file to send to DB
            $.post({
                url: "../php/update_locationDB.php",
                data: {
                    business_name: document.getElementById("businessname_id").value,
                    business_street: document.getElementById("street_id").value,
                    business_city: document.getElementById("city_id").value,
                    business_state: document.getElementById("state_id").value,
                    business_zip: document.getElementById("zip_id").value,
                    business_email: document.getElementById("email_id").value,
                    business_phone: document.getElementById("phone_id").value,
                    business_vetservice: vetserivce,
                    business_groomingservice: groomingserivce,
                    business_boardservice: boardingserivce,
                    location_ID: idNum.options[idNum.selectedIndex].id
                },
                success: function() {
                    $('#update_successful').modal();
                }
            });
        });
    });

</script>

<body>

    <?php require_once '../navigation/pages-navbar.php'; ?>

    <div class="container">
        <div class="row">
            <img src=" ../images/title_banner/Update_Location.png" class="img-fluid mx-auto" alt="Update Location">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="form-group col-md-12">
                <legend class="control-legend" id="select_location">Select a Location to Update</legend>
            </div>
            <div class="form-group col-lg-10">
                <select class="form-control" id="select_location_control">
                    <option value="" selected disabled>Select Location</option>
                    <?php comboboxOptions(); ?>
                </select>
            </div>
        </div>
        <hr class="form-group col-10 solid">
    </div>

    <form>
        <div class="row">
            <!-- Left Column-->
            <div class="col-md-6">
                <!-- Business Name -->
                <div class="form-group col-md-12">
                    <legend class="control-legend">Business Name</legend>
                </div>
                <div class="form-group col-lg-10">
                    <input type="text" class="form-control" id="businessname_id">
                </div>

                <!-- Business Service Checkboxes -->
                <div class="form-group col-sm-10">
                    <legend class="control-legend">Services</legend>
                    <div class="row">
                        <div class="col">
                            <div class="custom-control custom-checkbox mb-3">
                                <!-- Vet Service -->
                                <input type="checkbox" class="custom-control-input" id="vetservice_id" value="">
                                <label class="custom-control-label" for="vetservice_id">Veterinary</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                                <!-- Grooming Service -->
                                <input type="checkbox" class="custom-control-input" id="groomingservice_id" value="">
                                <label class="custom-control-label" for="groomingservice_id">Grooming</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                                <!-- Boarding Service -->
                                <input type="checkbox" class="custom-control-input" id="boardingservice_id" value="">
                                <label class="custom-control-label" for="boardingservice_id">Boarding</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column-->
            <div class="col-md-6">
                <!-- Address -->
                <div class="form-group col-md-12">
                    <legend class="control-legend">Address</legend>
                </div>
                <div class="form-group col-lg-10">
                    <!-- Street -->
                    <label class="control-label">Street</label>
                    <input type="text" class="form-control" id="street_id">
                </div>

                <div class="form-group col-lg-10">
                    <!-- City-->
                    <label class="control-label">City</label>
                    <input type="text" class="form-control" id="city_id">
                </div>

                <div class="row col-12">
                    <div class="form-group col-md-8 col-lg-6">
                        <!-- State  -->
                        <label class="control-label">State</label>
                        <select class="form-control" id="state_id">
                            <?php include (__DIR__ . "/../php/data_lists/states.html"); ?>
                        </select>
                    </div>

                    <div class="form-group col-md-4 col-lg-4">
                        <!-- Zip Code-->
                        <label class="control-label">Zip Code</label>
                        <input class="form-control" type="text" id="zip_id">
                    </div>
                </div>

            </div>
        </div>

        <!-- Contact-->
        <div class="col-md-6">
            <div class="form-group">
                <legend class="control-legend">Contact</legend>
            </div>
            <div class="form-group col-lg-10">
                <!-- Email -->
                <label class="control-label">Email</label>
                <input class="form-control" type="text" id="email_id">
            </div>
            <div class="form-group col-lg-10">
                <!-- Phone -->
                <label class="control-label">Phone Number</label>
                <input class="form-control" type="text" id="phone_id">
            </div>
        </div>
    </form>

    <!-- Submit and Remove Button -->
    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary" id="update_location">Submit</button>
    </div>
	<div class="form-group text-center">
		<button type="submit" class="btn btn-danger  btn-sm" id="remove_location_btn">Remove Location</button>
	</div>
</div>
</body>

</html>
