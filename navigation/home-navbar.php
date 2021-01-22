<div class="gradient-nav">
    <div id="main_nav">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="#"><img src="../images/title_banner/TeamPurple_Logo.png" width="150" height="60" alt="Team Purple Logo" hidden></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar navbar-nav">
                    <a class="nav-link hoverable active" href="./">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-link hoverable" href="./pages/faq.php">FAQ</a>
                    <a class="nav-link hoverable" href="./pages/contact_us.php">Contact Us</a>
                </div>
                <div class="navbar navbar-nav ml-auto" id="navbar">
                    <?php if (isset($_SESSION['currentUser'])): ?>
                    <a class="btn btn-md btn-outline-light m-2" id="currentUser">Welcome, <?php echo $_SESSION['currentUser']; ?></a>
                    <a class="btn btn-md btn-outline-light m-2" id="logout">Log out</a>
                    <?php else: ?>
                    <a class="btn btn-md btn-outline-light m-2" id="signup" data-toggle="modal" data-target="#signupModal">Sign Up</a>
                    <a class="btn btn-md btn-outline-light" id="login" data-toggle="modal" data-target="#loginModal">Log In</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>

    <?php if (isset($_SESSION['currentUser'])): ?>
    <div id="user_nav">
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup2" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup2">
                <div class="navbar navbar-nav p-2">
                    <!-- Veterinary Dropdown -->
                    <div class="dropdown text-center">
                        <a class="nav-link dropdown-toggle hoverable" data-toggle="dropdown">Pet</a>
                        <div class="dropdown-menu text-center">
                            <a class="dropdown-item nav-link hoverable" href="./pages/add_pet.php">Add Pet</a>
                            <a class="dropdown-item nav-link hoverable" href="./pages/update_pet.php">Update Pet</a>
                            <a class="dropdown-item nav-link hoverable" href="./pages/pet_history.php">Pet History</a>
                        </div>
                    </div>
                    <!-- Veterinary Dropdown -->
                    <div class="dropdown text-center">
                        <a class="nav-link dropdown-toggle hoverable" data-toggle="dropdown">Veterinary</a>
                        <div class="dropdown-menu text-center">
                            <a class="dropdown-item nav-link hoverable" href="./pages/add_vet_service.php">Add Veterinary Service</a>
                            <a class="dropdown-item nav-link hoverable" href="./pages/vet_history.php">Veterinary History</a>
                        </div>
                    </div>
                    <!-- Grooming Dropdown -->
                    <div class="dropdown text-center">
                        <a class="nav-link dropdown-toggle hoverable" data-toggle="dropdown">Grooming</a>
                        <div class="dropdown-menu text-center">
                            <a class="dropdown-item nav-link hoverable" href="./pages/add_grooming_service.php">Add Grooming Service</a>
                        </div>
                    </div>
                    <!-- Boarding Dropdown -->
                    <div class="dropdown text-center">
                        <a class="nav-link dropdown-toggle hoverable" data-toggle="dropdown">Boarding</a>
                        <div class="dropdown-menu text-center">
                            <a class="dropdown-item nav-link hoverable" href="./pages/add_boarding_service.php">Add Boarding Service</a>
                        </div>
                    </div>
                    <!-- Location Dropdown -->
                    <div class="dropdown text-center">
                        <a class="nav-link dropdown-toggle hoverable" data-toggle="dropdown">Location</a>
                        <div class="dropdown-menu text-center">
                            <a class="dropdown-item nav-link hoverable" href="./pages/add_location.php">Add Location</a>
                            <a class="dropdown-item nav-link hoverable" href="./pages/update_location.php">Update Location</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <?php endif; ?>
    <hr class="form-group col-10 solid">
</div>
