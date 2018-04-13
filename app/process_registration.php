<?php

require 'DB.php';
require 'dao/CustomerDAO.php';
require 'models/Customer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // backup validation if JavaScript is turned off
    $errors = array();
    $data = array();

    if (empty($_POST["email"])) {
        array_push($errors, "Email is required.");
    } else {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Please enter a valid email address.");
        }
    }
    if (empty($_POST["password"])) {
        array_push($errors, "Password is required.");
    } else {
        if(strlen($_POST["password"]) < 6) {
            array_push($errors, "Please enter at least 6 characters password.");
        }
    }
    if (!empty($_POST["password"]) && !empty($_POST["password2"])) {
        if ($_POST["password"] != $_POST["password2"]) {
            array_push($errors, "Password not match.");
        }
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
        if (!$customer->isEmailExists($_POST["email"])) {
            $newCustomer = new Customer();
            $newCustomer->insertCustomer($customer);
        } else {
            array_push($errors, "Email already exists.");
            $data["errors"] = $errors;
            echo json_encode($data["errors"]);
        }
    }
}
