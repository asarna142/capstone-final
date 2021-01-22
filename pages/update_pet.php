<?php
	session_start();

	include_once(__DIR__."/../php/DBConnect.php");
	include (__DIR__ . "/../php/modals/Modals.html");

	function comboboxOptions() {
		// This php code works, all values come out as normal.
		// No need to mess with this.
		$conn = databaseConnect("Pet");
		try {
			$sql = "select id, name from Pets where visible = 1";
			$stmt = sqlsrv_query($conn, $sql);
			if ($stmt === false) {
				echo "Error Occurred: " . sqlsrv_errors();
			} else {
				$storeValueId;
				while ($row = sqlsrv_fetch_object($stmt)) {
                    if ($row->hidepet !== 1) {
                        echo "<option id = " . $row->id . " value = " . $row->name . ">" . $row->name . "</option>";
                    }
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
    <script src="../js/LoginClass.js" type="text/ecmascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/secondnav_toggle.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
</head>

<script type="text/javascript">
    $(document).ready(function() {
        var idNum = document.getElementById("select_pet_control");      
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
            document.getElementById("speciesRadiosOther").value = ""
            $.post({
                url: "../php/retrieve_pet.php",
                data: {
                    pet_ID: idNum.options[idNum.selectedIndex].id
                },
                success: function(feedback) {
                    var json = JSON.parse(feedback);
                    document.getElementById("petname_id").value = json["Name"];
                    if (json["Species"] == "Dog") {
                        document.getElementById("speciesRadios1").checked = true;
                    } else if (json["Species"] == "Cat") {
                        document.getElementById("speciesRadios2").checked = true;
                    } else {
                        document.getElementById("speciesRadios3").checked = true;
                        document.getElementById("speciesRadiosOther").value = json["Species"];
                        $('#speciesRadiosOther').show();
                    }

                    document.getElementById("birthday_id").value = json["Birthdate"];
                    document.getElementById("weight_id").value = json["Weight"];
                    document.getElementById("street_id").value = json["Street"];
                    document.getElementById("city_id").value = json["City"];
                    document.getElementById("state_id").value = json["State"];
                    document.getElementById("zip_id").value = json["Zip"];
                    document.getElementById("chip_id").value = json["Chip"];
                }

            });
        });

        $("#remove_pet_btn").click(function() {
			$('#remove_pet_modal').modal();
		});

        $("#remove_pet").click(function() {
			var visible = 0;
			$.post({
                url: "../php/remove_petDB.php", 
				data: { visible: visible,
                        pet_ID: idNum.options[idNum.selectedIndex].id
				}, 
				success: function() {
						$('#update_successful').modal();
				}            
			});
		});

        $("#update_pet").click(function() {
            // Changed id assocaited with select html element.
            if (document.getElementById("speciesRadios1").checked) {
                var petSpecies = document.getElementById("speciesRadios1").value
            } else if (document.getElementById("speciesRadios2").checked) {
                var petSpecies = document.getElementById("speciesRadios2").value
            } else {
                var petSpecies = document.getElementById("speciesRadiosOther").value
            }
          
            // Used idNum.options[idNum.selectedIndex].id to fetch the id associated with the selected pet name.
            $.post({
                url: "../php/update_petDB.php",
                data: {
                    pet_name: document.getElementById("petname_id").value,
                    pet_species: petSpecies,
                    pet_birthdate: document.getElementById("birthday_id").value,
                    pet_weight: document.getElementById("weight_id").value,
                    pet_street: document.getElementById("street_id").value,
                    pet_city: document.getElementById("city_id").value,
                    pet_state: document.getElementById("state_id").value,
                    pet_zip: document.getElementById("zip_id").value,
                    pet_chip: document.getElementById("chip_id").value,
                    pet_ID: idNum.options[idNum.selectedIndex].id,
                },
                success: function() {
                    document.getElementById("petname_id").value = "";
                    document.getElementsByTagName("speciesRadios").checked = false;
                    document.getElementById("birthday_id").value = "";
                    document.getElementById("weight_id").value = "";
                    document.getElementById("street_id").value = "";
                    document.getElementById("city_id").value = "";
                    document.getElementById("state_id").value = "";
                    document.getElementById("zip_id").value = "";
                    document.getElementById("chip_id").value = "";
                }
            });
        });
    });

</script>


<body>

    <?php require_once '../navigation/pages-navbar.php'; ?>
                 
    <div class="container">
        <div class="row">
            <img src=" ../images/title_banner/Update_Pet.png" class="img-fluid mx-auto" alt="Update Pet">
        </div>
    </div>

    <div class="row">
        <!-- Left Column-->
        <div class="col-md-6 mx-auto">
            <div class="form-group col-md-12">
                <legend class="control-legend" id="select_pet">Select a Pet to Update</legend>
            </div>
            <div class="form-group col-lg-10">
                <select class="form-control" id="select_pet_control">
                    <option value="" selected disabled>Select Pet</option>
                    <?php comboboxOptions(); ?>
                </select>
            </div>
        </div>
        <hr class="form-group col-10 solid">
    </div>

    <form>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group col-md-12">
                    <legend class="control-legend">Pet</legend>
                </div>
                <!-- Name -->
                <div class="form-group col-lg-10">
                    <label class="control-label">Name</label>
                    <input type="text" class="form-control col-8" id="petname_id" name="petname">
                </div>

                <!-- Species -->
                <div class="form-group col-lg-10">
                    <label>Species</label>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="speciesRadios1" name="speciesRadios" class="custom-control-input" value="Dog">
                        <label class="custom-control-label m-2" for="speciesRadios1">Dog</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="speciesRadios2" name="speciesRadios" class="custom-control-input" value="Cat">
                        <label class="custom-control-label m-2" for="speciesRadios2">Cat</label>
                    </div>
                    <div class="form-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="speciesRadios3" name="speciesRadios" class="custom-control-input" value="">
                            <label class="custom-control-label m-2" for="speciesRadios3">Other</label>
                        </div>
                        <input class="form-control col-4" type="text" id="speciesRadiosOther" style="display: none">
                    </div>
                </div>

                <!-- Birth Date -->
                <div class="form-group col-lg-10">
                    <label class="control-label">Birth Date</label>
                    <input class="form-control col-5 col-sm-7 col-md-6 col-lg-5 col-xl-4" type="date" id="birthday_id">
                </div>

                <!-- Weight -->
                <div class="form-group col-lg-10">
                    <label class="col-form-label">Weight in lbs.</label>
                    <input class="form-control col-3 col-sm-4 col-md-5 col-lg-3" type="number" min="0" step="0.1" pattern="d+(.d{1})?" id="weight_id" placeholder="0.0">
                </div>

                <!-- Chip Id -->
                <div class="form-group col-lg-10">
                    <label class="control-label">Chip ID</label>
                    <input type="text" class="form-control col-8" id="chip_id" chipNum="chipId">
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
                            <?php
				include (__DIR__ . "/../php/data_lists/states.html");
				?>
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
    </form>

    <!-- Submit and Remove Button -->
    <div class="form-group text-center">
        <button class="btn btn-primary" id="update_pet">Submit</button>
    </div>
    <div class="form-group text-center">
	    <button type="submit" class="btn btn-danger  btn-sm" id="remove_pet_btn">Remove Pet</button>
    </div>
</div>  
</body>

</html>
