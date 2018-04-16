<?php

require 'DB.php';
require 'dao/CustomerDAO.php';
require 'models/Customer.php';
require 'handlers/CustomerHandler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitBtn"])) {

    $errors = [];
    $data = [];

    if (!empty($_POST["password"])) {
        if (strlen($_POST["password"]) < 6)
            array_push($errors, "Password not match.");
    }

    if (!empty($errors)) {
        $data["errors"] = $errors;
        echo json_encode($data["errors"]);
    } else {

        $c = new Customer();
        $c->setId($_POST["cid"]);
        $c->setFullName($_POST["fullName"]);
        $c->setEmail($_POST["email"]);
        $c->setPassword($_POST["password"]);

        $cHandler = new CustomerHandler();
        $cHandler->updateCustomer($c);
        $feedback = $cHandler->getExecutionFeedback();
        echo $feedback;
    }

}
/**
 * if password field is not empty
 * then validate it
 */