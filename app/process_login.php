<?php

require 'DB.php';
require 'dao/CustomerDAO.php';
require 'models/Customer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    }
    if (!empty($errors)) {
        $data["errors"] = $errors;
        echo json_encode($data["errors"]);
    } else {
        $customer = new Customer();
        if (!$customer->isEmailExists($_POST["email"])) {
            array_push($errors, "Email is not registered with us.");
            $data["errors"] = $errors;
            echo json_encode($data["errors"]);
        } else {
            $customer->setEmail($_POST["email"]);
            $newCustomer = new Customer();
            if (!$newCustomer->isPasswordMatchWithEmail($_POST['password'], $customer)) {
                array_push($errors, "Incorrect password.");
                $data["errors"] = $errors;
                echo json_encode($data["errors"]);
            } else {
                // sign the user in
            }

        }
    }
}
