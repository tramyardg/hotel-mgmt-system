<?php
ob_start();
session_start();

if (isset($_SESSION["authenticated"]))
{
    if ($_SESSION["authenticated"] == "1")
    {
        header("Location: index.php");
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">

    <title>Register</title>
</head>
<body class="bg-secondary">

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-5">Hotel Management System Registration</h2>
            <div class="row">
                <div class="col-md-6 mx-auto card-holder">
                    <div class="card border-secondary">
                        <div class="card-header">
                            <h3 class="mb-0 my-2">Sign Up</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="registration-form" method="post">
                                <div class="form-group">
                                    <label for="registrationFullName">Name</label>
                                    <input type="text" class="form-control"
                                           id="registrationFullName"
                                           name="registrationFullName"
                                           placeholder="Full name">
                                </div>
                                <div class="form-group">
                                    <label for="registrationPhoneNumber">Phone Number</label>
                                    <input type="text" class="form-control"
                                           id="registrationPhoneNumber"
                                           name="registrationPhoneNumber"
                                           placeholder="(123) 456-7890">
                                </div>
                                <div class="form-group">
                                    <label for="registrationEmail">Email</label>
                                    <span class="red-asterisk"> *</span>
                                    <input type="email" class="form-control"
                                           id="registrationEmail"
                                           name="registrationEmail"
                                           placeholder="email@domain.com" required="">
                                </div>
                                <div class="form-group">
                                    <label for="registrationPassword">Password</label>
                                    <span class="red-asterisk"> *</span>
                                    <input type="password" class="form-control"
                                           id="registrationPassword"
                                           name="registrationPassword"
                                           placeholder="password"
                                           title="At least 4 characters with letters and numbers"
                                           required="">
                                </div>
                                <div class="form-group">
                                    <label for="registrationPassword2">Confirm Password</label>
                                    <span class="red-asterisk"> *</span>
                                    <input type="password" class="form-control"
                                           id="registrationPassword2"
                                           name="registrationPassword2"
                                           placeholder="Retype Password" required="">
                                </div>
                                <div class="form-group">
                                    <p>Already registered? <a href="sign-in.php">Sign in here.</a></p>
                                </div>
                                <div class="form-group">
                                    <a  href="index.php" class="btn btn-dark">Home</a>
                                    <input type="submit" class="btn btn-primary btn-md float-right"
                                            name="registerSubmitBtn" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/utilityFunctions.js"></script>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

<script src="js/form-submission.js"></script>
</body>
</html>