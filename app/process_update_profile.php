<?php

ob_start();
session_start();

require '../lib/phpPasswordHashing/passwordLib.php';
require 'DB.php';
require 'dao/CustomerDAO.php';
require 'models/Customer.php';
require 'handlers/CustomerHandler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitBtn"])) {

    $errors = [];
    $data = [];

    if (!empty($_POST["password"])) {
        if (strlen($_POST["password"]) < 6)
            array_push($errors, "At least 6 characters is required.");
    }

    if (!empty($errors)) {
        $data["errors"] = $errors;
        echo json_encode($data["errors"]);
    } else {

        $c = new Customer();
        $c->setId($_POST["cid"]);
        $c->setFullName($_POST["fullName"]);
        $c->setPhone($_POST["phone"]);
        $c->setEmail($_POST["email"]);
        $c->setPassword($_POST["password"]);

        $cHandler = new CustomerHandler();
        $cHandler->updateCustomer($c);
        $feedback = $cHandler->getExecutionFeedback();

        if (isset($_SESSION["username"])) {
            $_SESSION["username"] = $cHandler->getUsername($_POST["email"]);
        }
        if (isset($_SESSION["phoneNumber"])) {
            $_SESSION["phoneNumber"] = $_POST["phone"];
        }

        echo $feedback;
    }

}
/**
 * if password field is not empty
 * then validate it
 */