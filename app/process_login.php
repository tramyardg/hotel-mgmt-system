<?php

ob_start();
session_start();

// include this for every Customer model existence
require '../lib/phpPasswordHashing/passwordLib.php';

require 'DB.php';
require 'dao/CustomerDAO.php';
require 'models/Customer.php';
require 'handlers/CustomerHandler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitBtn"])) {
    $errors_ = null;

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        $errors_ .=  displayAlert("Please enter a valid email address");
    if (empty($_POST["password"]))
        $errors_ .= displayAlert("Password is required.");
    if (!empty($errors_)) {
        echo $errors_;
    } else {
        $handler = new CustomerHandler();
        if (!$handler->isEmailExists($_POST["email"])) {
            echo displayAlert("Email is not registered with us.");
        } else {
            $customer = new Customer();
            $customer->setEmail($_POST["email"]);
            $newCustomer = new Customer();
            if (!$handler->isPasswordMatchWithEmail($_POST['password'], $customer)) {
                echo displayAlert("Incorrect password.");
            } else {
                $_SESSION["username"] = $handler->getUsername($_POST["email"]);
                $_SESSION["customerEmail"] = $customer->getEmail();
                $_SESSION["authenticated"] = 1;
                $_SESSION["password"] = $_POST["password"];

                // set the session phone number too
                if ($handler->getCustomerObj($_POST["email"])->getPhone()) {
                    $_SESSION["phoneNumber"] = $handler->getCustomerObj($_POST["email"])->getPhone();
                }

                echo $_SESSION["authenticated"];
            }
        }
    }
}

function displayAlert($msg)
{
    return '<div class="alert alert-warning" role="alert">' . $msg . '</div>';
}

/**
 * [x] validate the fields first
 * [x] if no errors check if email is registered
 *     if not registered, display not registered message
 *     otherwise, create a customer object
 * [x] check if password entered match with database password
 *     if not match display incorrect message
 *     otherwise, create a session variables
 */
