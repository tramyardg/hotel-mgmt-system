<?php

ob_start();
session_start();

require 'DB.php';
require 'dao/CustomerDAO.php';
require 'models/Customer.php';
require 'handlers/CustomerHandler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitBtn"])) {
    $errors = array();
    $data = array();

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        array_push($errors, "Please enter a valid email address.");
    if (empty($_POST["password"]))
        array_push($errors, "Password is required.");
    if (!empty($errors)) {
        $data["errors"] = $errors;
        echo json_encode($data["errors"]);
    } else {
        $handler = new CustomerHandler();
        if (!$handler->isEmailExists($_POST["email"])) {
            array_push($errors, "Email is not registered with us.");
            $data["errors"] = $errors;
            echo json_encode($data["errors"]);
        } else {
            $customer = new Customer();
            $customer->setEmail($_POST["email"]);
            $newCustomer = new Customer();
            if (!$handler->isPasswordMatchWithEmail($_POST['password'], $customer)) {
                array_push($errors, "Incorrect password.");
                $data["errors"] = $errors;
                echo json_encode($data["errors"]);
            } else {
                $_SESSION["username"] = $handler->getUsername($_POST["email"]);
                $_SESSION["customerEmail"] = $customer->getEmail();
                $_SESSION["authenticated"] = 1;

                // set the session phone number too
                if ($handler->getCustomerObj($_POST["email"])->getPhone()) {
                    $_SESSION["phoneNumber"] = $handler->getCustomerObj($_POST["email"])->getPhone();
                }

                echo $_SESSION["authenticated"];
            }
        }
    }
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
