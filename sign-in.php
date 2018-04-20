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

    <link rel="stylesheet" href="bootstrap-4.0.0/dist/css/bootstrap.css">
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

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="bootstrap-4.0.0/dist/js/bootstrap.js"></script>
<script src="js/templates.js"></script>
<script src="js/form-submission.js"></script>
</body>
</html>