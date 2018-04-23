<?php

require '../DB.php';
require '../Util.php';
require '../dao/BookingDetailDAO.php';
require '../handlers/BookingDetailHandler.php';

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
