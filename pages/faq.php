<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Companion Vault</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="../js/LoginClass.js" type="text/ecmascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/secondnav_toggle.js"></script>

    <script>
        $(document).ready(function() {
            // Add down arrow icon for collapse element which is open by default
            $(".collapse.show").each(function() {
                $(this).prev(".card-header").find(".fa").addClass("fa-angle-down").removeClass("fa-angle-right");
            });

            // Toggle right and down arrow icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa").removeClass("fa-angle-right").addClass("fa-angle-down");
            }).on('hide.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa").removeClass("fa-angle-down").addClass("fa-angle-right");
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

        });

    </script>
</head>

<body>

    <?php require_once '../navigation/pages-navbar.php'; ?>

    <div class="container">
        <div class="row">
            <img src=" ../images/title_banner/FAQ.png" class="img-fluid mx-auto" alt="Update Location">
        </div>
    </div>

    <div class="row ml-1 mr-1">
        <div class="col-lg-9 mx-auto ">
            <!-- FQA Accordion -->
            <div id="accordion" class="accordion shadow">
                <!-- FAQ 1 -->
                <div class="card">
                    <div id="headingOne" class="card-header bg-white shadow-sm border-0">
                        <h2 class="mb-0">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn btn-link text-left text-dark font-weight-bold text-decoration-none collapsible-link"><i class="fa fa-angle-right"></i>
                                What is Companion Vault's mission?</button>
                        </h2>
                    </div>
                    <div id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion" class="collapse">
                        <div class="card-body p-5">
                            <div class="font-weight-bold m-0">
                                <p>To become your pets virtual filing cabinet!</p>
                            </div>
                            <p class="font-weight-light m-0">
                                Managing your pet's records & appointments will be as easy as ever. Companion Vault creates a database for your pet that holds all of it's medical records & appointment details. We will even work as your pets virtual calendar, reminding you of when appointments & services are due.</p>
                        </div>
                    </div>
                </div>
                <!-- FAQ 2 -->
                <div class="card">
                    <div id="headingTwo" class="card-header bg-white shadow-sm border-0">
                        <h2 class="mb-0">
                            <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-link text-left text-dark font-weight-bold text-decoration-none collapsible-link"><i class="fa fa-angle-right"></i>
                                How is the cost determined?</button>
                        </h2>
                    </div>
                    <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion" class="collapse">
                        <div class="card-body p-5">
                            <p class="font-weight-light m-0">
                                The cost is determined by the amount of records you wish to store for your pet.</p>
                        </div>
                    </div>
                </div>
                <!-- FAQ 3 -->
                <div class="card">
                    <div id="headingThree" class="card-header bg-white shadow-sm border-0">
                        <h2 class="mb-0">
                            <button type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="btn btn-link text-left text-dark font-weight-bold text-decoration-none collapsible-link"><i class="fa fa-angle-right"></i>
                                What services will I be able to see in my history?</button>
                        </h2>
                    </div>
                    <div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordion" class="collapse">
                        <div class="card-body p-5">
                            <p class="font-weight-light m-0">Veterinary, Grooming and Boarding services that your pet has recieved in the past will be available to you for review.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
