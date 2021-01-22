<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Team Purple B03</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./css/style.css" />


    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./libaries/Blowfish.js"></script>
    <script src="./js/LoginClass.js" type="text/ecmascript"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/secondnav_toggle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#signup").click(function() {
                new UserLogin('.').signup();
            });

            $("#login").click(function() {
                new UserLogin('.').userLogin();
            });
          
            $('#logout').click(function() {
                new UserLogin('.').userLogOut();
            });
        });

    </script>



</head>

<body>
    <?php require_once './navigation/home-navbar.php'; ?>

    <div class="container">
        <div class="row">
            <img src=" ./images/title_banner/Companion_Vault.png" class="img-fluid mx-auto" alt="Home Page Banner">
        </div>
    </div>

    <?php
    include ("./php/carousel.html");
  ?>

</body>

</html>
