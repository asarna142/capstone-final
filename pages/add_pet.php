<?php
    session_start();
	include (__DIR__ . "/../php/modals/Modals.html");
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
        //Toggle Other Species Text Input
        $('input[name="speciesRadios"]').on('click', function() {
            if ($(this).val() == '') {
                $('#speciesRadiosOther').show();
            } else {
                $('#speciesRadiosOther').hide();
            }
        });

        $("#signup").click(function() {
            new UserLogin('..').signup();
        });

        $("#login").click(function() {
            new UserLogin('..').userLogin();
        });

        $('#logout').click(function() {
            new UserLogin('..').userLogOut();
        });
        $("#addPet").click(function() {
            //assign form pieces to variables
            var name = document.getElementById("petname_id").value;

            if (document.getElementById("speciesRadios1").checked) {
                var species = document.getElementById("speciesRadios1").value
            } else if (document.getElementById("speciesRadios2").checked) {
                var species = document.getElementById("speciesRadios2").value
            } else {
                var species = document.getElementById("speciesRadiosOther").value
            }

            var birthdate = document.getElementById("birthday_id").value;
            var weight = document.getElementById("weight_id").value;
            var street = document.getElementById("street_id").value;
            var city = document.getElementById("city_id").value;
            var state = document.getElementById("state_id").value;
            var zip = document.getElementById("zip_id").value;
            var chipId = document.getElementById("chip_id").value;

            //send to file to send to DB
            $.post({
                url: "../php/add_petDB.php",
                data: {
                    pet_name: name,
                    pet_species: species,
                    pet_birthday: birthdate,
                    pet_weight: weight,
                    pet_street: street,
                    pet_city: city,
                    pet_state: state,
                    pet_zip: zip,
                    pet_chip: chipId
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
            <img src=" ../images/title_banner/Add_Pet.png" class="img-fluid mx-auto" alt="Add Location">
        </div>
    </div>

    <form>
        <div class="row">
            <!-- Left Column-->
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
                    <input class="form-control col-5 col-sm-7 col-md-6 col-lg-5 col-xl-4" type="date" id="birthday_id" name="birthday">
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

    <!-- Submit Button -->
    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary" id="addPet">Submit</button>
    </div>

</body>

</html>
