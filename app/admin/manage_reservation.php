<?php

ob_start();
session_start();


require '../DB.php';
require '../Util.php';
require '../dao/BookingDetailDAO.php';
require '../handlers/BookingDetailHandler.php';

if (isset($_COOKIE['is_admin']) && $_COOKIE['is_admin'] == 'true') {
    if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"][1] == "true") {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm"])) {
            $bdh = new BookingDetailHandler();
            $bdh->confirmSelection($_POST["item"]);
            echo Util::displayAlertV1($bdh->getExecutionFeedback(), "info");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cancel"])) {
            $bdh = new BookingDetailHandler();
            $bdh->cancelSelection($_POST["item"]);
            echo Util::displayAlertV1($bdh->getExecutionFeedback(), "info");
        }
    } else {
        echo "failed";
    }
} else {
    echo 'not allowed';
}
