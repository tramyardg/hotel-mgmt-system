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

    <title>Sign in</title>
</head>
<body class="bg-secondary">

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-5">Hotel Management System Login</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card border-secondary">
                        <div class="card-header">
                            <h3 class="mb-0 my-2">Login</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="login-form" method="post">
                                <div class="form-group">
                                    <label for="loginEmail">Email</label>
                                    <span class="red-asterisk"> *</span>
                                    <input type="text" class="form-control"
                                           id="loginEmail"
                                           name="loginEmail"
                                           placeholder="email address"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="loginPassword">Password</label>
                                    <span class="red-asterisk"> *</span>
                                    <input type="password" class="form-control"
                                           id="loginPassword"
                                           name="loginPassword"
                                           placeholder="password"
                                           required>
                                </div>
                                <div class="form-group">
                                    <p>Not registered? <a href="register.php">Register here.</a></p>
                                </div>
                                <div class="form-group">
                                    <a  href="index.php" class="btn btn-dark">Home</a>
                                    <input type="submit" class="btn btn-primary btn-md float-right"
                                           value="Sign in" name="loginSubmitBtn">
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