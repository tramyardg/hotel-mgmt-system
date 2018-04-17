<?php

require '../lib/phpPasswordHashing/passwordLib.php';

require 'DB.php';
require 'dao/CustomerDAO.php';
require 'models/Customer.php';
require 'handlers/CustomerHandler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitBtn"])) {

    $errors_ = null;

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        $errors_ .= "- Please enter a valid email address. <br>";
    if (strlen($_POST["password"]) < 6 || strlen($_POST["password2"]) < 6)
        $errors_ .= "- A password of at least 6 characters is required. <br>";
    if (!empty($_POST["password"]) && !empty($_POST["password2"])) {
        if ($_POST["password"] != $_POST["password2"])
            $errors_ .= "- Password not match. <br>";
    }

    if (!empty($errors_)) {
        echo $errors_;
    } else {

        $customer = new Customer();
        $customer->setFullName($_POST["fullName"]);
        $customer->setEmail($_POST["email"]);
        $customer->setPhone($_POST["phoneNumber"]);
        $customer->setPassword($_POST["password"]);

        $handler = new CustomerHandler();
        $handler->insertCustomer($customer);
        echo $handler->getExecutionFeedback();
    }
}
/**
 * [x] validate the fields first
 * [x] if no error create a Customer object
 * [x] check if email already exists
 *     if not exists insert the customer object
 *     otherwise, display email exists message
 */