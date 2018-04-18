<?php

require 'DB.php';
require 'Util.php';
require 'dao/ReservationDAO.php';
require 'dao/BookingDetailDAO.php';
require 'models/Reservation.php';
require 'models/BookingDetail.php';
require 'handlers/ReservationHandler.php';
require 'handlers/BookingDetailHandler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitBtn"])) {

    $startDate = $endDate = null;
    $errors_ = null;

    if (empty($_POST["start"]))
        $errors_ .= Util::displayAlertV1("Please select a start date.", "info");
    if (empty($_POST["end"]))
        $errors_ .= Util::displayAlertV1("Please select an end date.", "info");
    if (!DateTime::createFromFormat('Y-m-d', $_POST["start"]))
        $errors_ .= Util::displayAlertV1("Invalid start date.", "info");
    if (!DateTime::createFromFormat('Y-m-d', $_POST["end"]))
        $errors_ .= Util::displayAlertV1("Invalid end date.", "info");
    if (empty($_POST["type"]))
        $errors_ .= Util::displayAlertV1("Please select a room type.", "info");
    if (empty($_POST["adults"]))
        $errors_ .= Util::displayAlertV1("Please enter a number of adults.", "info");

    $startDate = new DateTime($_POST["start"]);
    $endDate = new DateTime($_POST["end"]);
    if ($endDate <= $startDate)
        $errors_ .= Util::displayAlertV1("End date cannot be less or equal to start date.", "info");

    if (!empty($errors_)) {
        echo $errors_;
    } else {
        $r = new Reservation();
        $r->setCid($_POST["cid"]);
        $r->setStart($_POST["start"]);
        $r->setEnd($_POST["end"]);
        $r->setType($_POST["type"]);
        $r->setRequirement($_POST["requirement"]);
        $r->setAdults($_POST["adults"]);
        $r->setChildren($_POST["children"]);
        $r->setRequests($_POST["requests"]);
        $unique = uniqid();
        $r->setHash($unique);

        $rHandler = new ReservationHandler();
        $rHandler->create($r);
        $out = array(
            "success" => "true",
            "response" => Util::displayAlertV2($rHandler->getExecutionFeedback(), "success")
        );
        echo json_encode($out, JSON_PRETTY_PRINT);

        $rNewWithId = $rHandler->getReservationObjByHash($unique);
        $bdHandler = new BookingDetailHandler();
        $bdHandler->create($rNewWithId);
    }

}

/*
 * validation:
 * if end date is less than start date -> invalid
 * if start date, end date, room type, adults are empty -> invalid
 */