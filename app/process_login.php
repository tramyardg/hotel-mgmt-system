<?php

// this script acts like a controller
// to process a login a JS request from form-submission.js is sent to this script
// view -> js -> process_login -> server
// view <- js <- process_login <- server
// other process scripts follow the same cycle

ob_start();
session_start();

// include this for every Customer model existence
require '../lib/phpPasswordHashing/passwordLib.php';

require 'DB.php';
require 'Util.php';
require 'dao/CustomerDAO.php';
require 'dao/AdminDAO.php';
require 'models/Customer.php';
require 'models/Admin.php';
require 'handlers/CustomerHandler.php';
require 'handlers/AdminHandler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitBtn"])) {
    $errors_ = null;

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors_ .= Util::displayAlertV1("Please enter a valid email address", "warning");
    }
    if (empty($_POST["password"])) {
        $errors_ .= Util::displayAlertV1("Password is required.", "warning");
    }
    if (!empty($errors_)) {
        echo $errors_;
    } else {

        // check whether email belongs to customer
        $handler = new CustomerHandler();
        $customer = new Customer();
        $customer->setEmail($_POST["email"]);

        $isAdmin = $handler->handleIsAdmin($_POST["email"]);

        if (!$handler->isPasswordMatchWithEmail($_POST['password'], $customer)) {
            echo Util::displayAlertV1("Incorrect password.", "warning");
        } else {
            if ($isAdmin) { 
                $_SESSION["username"] = $_POST["email"];
                $_SESSION["accountEmail"] = $_POST["email"];
                $_SESSION["isAdmin"] = [1, "true"];
                echo json_encode($_SESSION["isAdmin"]);
            } else {
                $_SESSION["username"] = $handler->getUsername($_POST["email"]);
                $_SESSION["accountEmail"] = $customer->getEmail();
                $_SESSION["authenticated"] = [1, "false"];
                $_SESSION["password"] = $_POST["password"];

                // set the session phone number too
                if ($handler->getCustomerObj($_POST["email"])->getPhone()) {
                    $_SESSION["phoneNumber"] = $handler->getCustomerObj($_POST["email"])->getPhone();
                }
                echo json_encode($_SESSION["authenticated"]);
            }
        }
    }
}

/**
 * [x] validate the fields first
 * [x] if no errors check if email is registered
 *     if not registered, display not registered message
 *     otherwise, create a customer object
 * [x] check if password entered match with db password
 *     if not match display incorrect message
 *     otherwise, create a session variables
 */
