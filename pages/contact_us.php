<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Companion Vault</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/secondnav_toggle.js"></script>
    <script src="../js/LoginClass.js" type="text/ecmascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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

        });

    </script>

</head>

<body>


    <?php require_once '../navigation/pages-navbar.php'; ?>

    <div class="container">
        <div class="row">
            <img src=" ../images/title_banner/Contact_Us.png" class="img-fluid mx-auto" alt="Update Location">
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Left Column-->
            <div class="col-md-8">
                <div class="well well-sm">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name" required="required" />
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                        </span>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subject">
                                        Subject</label>
                                    <select id="subject" name="subject" class="form-control" required="required">
                                        <option value="na" selected="">Choose One:</option>
                                        <option value="service">General Customer Service</option>
                                        <option value="suggestions">Suggestions</option>
                                        <option value="product">Product Support</option>
                                        <option value="product">Complaint</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea id="message" class="form-control" rows="9" cols="25" required="required" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" id="btnContactUs">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Right Column-->
            <div class="col-md-4 text-center">
                <form>
                    <address>
                        <strong>Team Purple B03</strong><br>
                        Columbus, OH 43017<br>
                        <abbr title="Phone"></abbr>
                        (123) 456-7890
                    </address>
                    <address>
                        <a href="mailto:teampurple2999capstone@gmail.com">teampurple2999capstone@gmail.com</a>
                    </address>
                </form>
            </div>
        </div>
    </div>


</body>

</html>
