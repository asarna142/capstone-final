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

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">


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

        $("#addBusiness").click(function() {

            //assign form pieces to variables
            var name = document.getElementById("businessname_id").value;
            var street = document.getElementById("street_id").value;
            var city = document.getElementById("city_id").value;
            var state = document.getElementById("state_id").value;
            var zip = document.getElementById("zip_id").value;
            var email = document.getElementById("email_id").value;
            var phone = document.getElementById("phone_id").value;
            if (document.getElementById('vetservice_id').checked) {
                var vetserivce = 1
            } else {
                var vetserivce = 0
            }
            if (document.getElementById('boardingservice_id').checked) {
                var boardingserivce = 1
            } else {
                var boardingserivce = 0
            }
            if (document.getElementById('groomingservice_id').checked) {
                var groomingserivce = 1
            } else {
                var groomingserivce = 0
            }
            //send to file to send to DB
            $.post({
                url: "../php/add_locationDB.php",
                data: {
                    business_name: name,
                    business_street: street,
                    business_city: city,
                    business_state: state,
                    business_zip: zip,
                    business_email: email,
                    business_phone: phone,
                    business_vetservice: vetserivce,
                    business_groomingservice: groomingserivce,
                    business_boardservice: boardingserivce,
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
            <img src=" ../images/title_banner/Add_Location.png" class="img-fluid mx-auto" alt="Add Location">
        </div>
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

    <!-- Submit Button -->
    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary" id="addBusiness">Submit</button>
    </div>

</body>

</html>
