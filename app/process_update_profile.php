<?php

ob_start();
session_start();


require '../lib/phpPasswordHashing/passwordLib.php';
require 'DB.php';
require 'Util.php';
require 'dao/CustomerDAO.php';
require 'models/Customer.php';
require 'handlers/CustomerHandler.php';

if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"][1] == "false") {

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitBtn"])) {
        $errors_ = null;
    
        $pwd = null;
        if (!empty($_POST["newPassword"])) {
            if (strlen($_POST["newPassword"]) < 4) {
                $errors_ .= Util::displayAlertV1("At least 4 characters is required.", "info");
            } else {
                $pwd = $_POST["newPassword"];
            }
        } else {
            if (isset($_SESSION["password"])) {
                $pwd = $_SESSION["password"];
            }
        }
    
        if (!empty($errors_)) {
            echo $errors_;
        } else {
            $c = new Customer();
            $c->setId(Util::sanitize_xss($_POST["cid"]));
            $c->setFullName(Util::sanitize_xss($_POST["fullName"]));
            $c->setPhone(Util::sanitize_xss($_POST["phone"]));
            $c->setEmail(Util::sanitize_xss($_POST["email"]));
            $c->setPassword(Util::sanitize_xss($pwd));
    
            if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"][1] == "false" &&
                isset($_COOKIE['is_admin']) && $_COOKIE['is_admin'] == "false") {
                $cHandler = new CustomerHandler();
                $cHandler->updateCustomer($c);
                echo Util::displayAlertV1($cHandler->getExecutionFeedback(), "success");    
            }
            
            if (isset($_SESSION["username"])) {
                $_SESSION["username"] = $cHandler->getUsername($_POST["email"]);
            }
            if (isset($_SESSION["phoneNumber"])) {
                $_SESSION["phoneNumber"] = $_POST["phone"];
            }
        }
    }

} else {
    echo "failed";
}

// if (isset($_COOKIE['is_admin'])) {
//     echo $_COOKIE['is_admin'];
// }

// if (isset($_SESSION["authenticated"])) {
//     var_dump($_SESSION["authenticated"]);
// }
