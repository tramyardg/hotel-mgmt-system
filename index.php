<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="bootstrap-4.0.0/dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <?php

    ob_start();
    session_start();

    require 'app/DB.php';
    require 'app/Util.php';
    require 'app/dao/CustomerDAO.php';
    require 'app/models/Customer.php';

    $username = null;
    $isSessionExists = false;
    if (isset($_SESSION["username"]))
    {
        $username = $_SESSION["username"];
        $isSessionExists = true;

        $c = new Customer();
        $c = $c->getCustomerByEmail($_SESSION["customerEmail"]);
        //echo $c->getEmail();
    }

    $dateToday = Util::dateToday();
    $nextDay   = date('Y-m-d', strtotime($dateToday. ' + 1 days'));

    print_r($_SESSION);

    ?>

    <title>Home</title>
</head>
<body>

<header>
    <div class="bg-dark collapse" id="navbarHeader" style="">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">About</h4>
                    <p class="text-muted">Add some information about hotel booking.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4 text-right">
                    <!-- User full name or email if logged in -->
                    <?php if ($isSessionExists) { ?>
                    <h4 class="text-white"><?php echo $username; ?></h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">View my booking(s)</a></li>
                        <li><a href="#" class="text-white">View my profile</a></li>
                        <li><a href="#" id="sign-out-link" class="text-white">Sign out</a></li>
                    </ul>
                    <?php } else { ?>
                    <h4 ><a class="text-white" href="sign-in.html">Sign in</a></h4>
                    <p class="text-muted">Log in so you can take advantage with our hotel room prices.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <i class="fas fa-h-square mr-2"></i>
                <strong>Hotel Booking</strong>
            </a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<main role="main">

    <section class="jumbotron text-center">
        <div class="container pt-lg-5 pl-5 px-5">
            <h1 class="display-3">A brand new hotel beyond ordinary</h1>
            <p class="lead text-muted">Book your summer holidays with us now.</p>
            <p>
                <?php if ($isSessionExists) { ?>
                <a href="#" class="btn btn-success my-2" data-toggle="modal" data-target=".book-now-modal-lg">Book now</a>
                <?php } else { ?>
                <a href="#" class="btn btn-success my-2" data-toggle="modal" data-target=".sign-in-to-book-modal">Book now</a>
                <?php } ?>
            </p>
        </div>
    </section>

    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Pricing</h1>
            <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
        </div>
    </div>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h5 class="my-0 font-weight-normal">Deluxe Room</h5>
                        </div>
                        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="image/deluxe.jpg" data-holder-rendered="true">
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <?php if ($isSessionExists) { ?>
                                    <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target=".book-now-modal-lg">
                                        Book
                                    </button>
                                    <?php } else { ?>
                                    <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target=".sign-in-to-book-modal">
                                        Book
                                    </button>
                                    <?php } ?>
                                </div>
                                <small class="text-muted">250 / night</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h5 class="my-0 font-weight-normal">Double Room</h5>
                        </div>
                        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="image/double.jpg" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <?php if ($isSessionExists) { ?>
                                <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target=".book-now-modal-lg">
                                    Book
                                </button>
                                <?php } else { ?>
                                <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target=".sign-in-to-book-modal">
                                    Book
                                </button>
                                <?php } ?>
                                <small class="text-muted">180 / night</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h5 class="my-0 font-weight-normal">Single Room</h5>
                        </div>
                        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="image/single.jpg" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <?php if ($isSessionExists) { ?>
                                <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target=".book-now-modal-lg">
                                    Book
                                </button>
                                <?php } else { ?>
                                <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target=".sign-in-to-book-modal">
                                    Book
                                </button>
                                <?php } ?>
                                <small class="text-muted">130 / night</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade book-now-modal-lg" tabindex="-1" role="dialog" aria-labelledby="bookNowModalLarge" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reservation form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" autocomplete="off" id="reservation-form" method="post">
                        <?php if ($isSessionExists) { ?>
                        <input type="number" id="cid" name="cid" value="<?php echo $c->getId() ?>" hidden>
                        <?php } ?>
                        <div class="form-group row">
                            <label for="startDate" class="col-sm-3 col-form-label">From
                                <span class="red-asterisk"> *</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" id="startDate"
                                           name="startDate" min="<?php echo Util::dateToday(); ?>" required>
                                 </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="endDate" class="col-sm-3 col-form-label">To
                                <span class="red-asterisk"> *</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" id="endDate"
                                           name="endDate" min="<?php echo $nextDay; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label" for="roomType">Room type
                                <span class="red-asterisk"> *</span>
                            </label>
                            <div class="col-sm-9">
                                <select required class="custom-select mr-sm-2" id="roomType" name="roomType">
                                    <option value="deluxe">Deluxe room</option>
                                    <option value="double">Double room</option>
                                    <option value="single">Single room</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label" for="roomRequirement">Room requirements</label>
                            <div class="col-sm-9">
                                <select class="custom-select mr-sm-2" id="roomRequirement" name="roomRequirement">
                                    <option value="no preference" selected>No preference</option>
                                    <option value="non smoking">Non smoking</option>
                                    <option value="smoking">Smoking</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label" for="adults">Adults
                                <span class="red-asterisk"> *</span>
                            </label>
                            <div class="col-sm-9">
                                <select required class="custom-select mr-sm-2" id="adults" name="adults">
                                    <option selected value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label" for="children">Children</label>
                            <div class="col-sm-9">
                                <select class="custom-select mr-sm-2" id="children" name="children">
                                    <option selected value="0">-</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label" for="specialRequests">Special requirements</label>
                            <div class="col-sm-9">
                                <textarea rows="3" maxlength="500" id="specialRequests" name="specialRequests" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <input type="submit" class="btn btn-primary float-right"
                                       name="reservationSubmitBtn" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal sign-in-to-book-modal" tabindex="-1" role="dialog" aria-labelledby="signInToBookModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Sign in required</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>You have to login in to book a rom.</h4>
                </div>
            </div>
        </div>
    </div>

</main>

<footer class="container">
    <p>&copy; Company 2017-2018</p>
</footer>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"
        integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+"
        crossorigin="anonymous"></script>
<script src="bootstrap-4.0.0/dist/js/bootstrap.js"></script>
<script src="js/util.js"></script>
<script src="js/form-submission.js"></script>
</body>
</html>