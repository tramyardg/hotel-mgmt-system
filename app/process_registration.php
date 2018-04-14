<?php

require 'DB.php';
require 'dao/CustomerDAO.php';
require 'models/Customer.php';
require 'handlers/CustomerHandler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitBtn"])) {

    // backup validation if JavaScript is turned off
    $errors = array();
    $data = array();

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        array_push($errors, "Please enter a valid email address.");
    if (strlen($_POST["password"]) < 6 || strlen($_POST["password2"]) < 6)
        array_push($errors, "A password of at least 6 characters is required.");
    if (!empty($_POST["password"]) && !empty($_POST["password2"])) {
        if ($_POST["password"] != $_POST["password2"])
            array_push($errors, "Password not match.");
    }

    if (!empty($errors)) {
        $data["errors"] = $errors;
        echo json_encode($data["errors"]);
    } else {

        $customer = new Customer();
        $customer->setFullName($_POST["fullName"]);
        $customer->setEmail($_POST["email"]);
        $customer->setPhone($_POST["phoneNumber"]);
        $customer->setPassword($_POST["password"]);

        $handler = new CustomerHandler();
        if (!$handler->isEmailExists($_POST["email"])) {
            $handler->insertCustomer($customer);
        } else {
            array_push($errors, "Email already exists.");
            $data["errors"] = $errors;
            echo json_encode($data["errors"]);
        }
    }
}
/**
 * [x] validate the fields first
 * [x] if no error create a Customer object
 * [x] check if email already exists
 *     if not exists insert the customer object
 *     otherwise, display email exists message
 */