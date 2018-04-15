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

    $errors = [];
    $data = [];
    $startDate = null;
    $endDate = null;

    if (empty($_POST["start"]))
        array_push($errors, "Please select a start date.");
    if (empty($_POST["end"]))
        array_push($errors, "Please select an end date.");
    if (!DateTime::createFromFormat('Y-m-d', $_POST["start"]))
        array_push($errors, "Invalid start date.");
    if (!DateTime::createFromFormat('Y-m-d', $_POST["end"]))
        array_push($errors, "Invalid end date.");
    if (empty($_POST["type"]))
        array_push($errors, "Please select a room type.");
    if (empty($_POST["adults"]))
        array_push($errors, "Please enter a number of adults.");
    $startDate = new DateTime($_POST["start"]);
    $endDate = new DateTime($_POST["end"]);
    if ($endDate <= $startDate)
        array_push($errors, "End date cannot be less or equal to start date.");

    if (!empty($errors)) {
        $data["errors"] = $errors;
        echo json_encode($data["errors"]);
    } else {

        try {
            $r = new Reservation();
            $r->setCid($_POST["cid"]);
            $r->setStart($_POST["start"]);
            $r->setEnd($_POST["end"]);
            $r->setRoomType($_POST["type"]);
            $r->setRequirement($_POST["requirement"]);
            $r->setAdults($_POST["adults"]);
            $r->setChildren($_POST["children"]);
            $r->setRequests($_POST["requests"]);
            $unique = uniqid();
            $r->setHash($unique);

            $rHandler = new ReservationHandler();
            $rHandler->create($r);

            $rNewWithId = $rHandler->getReservationObjByHash($unique);
            $bdHandler = new BookingDetailHandler();
            $bdHandler->create($rNewWithId);

            echo $rHandler->getExecutionFeedback();
        } catch (Exception $e) {
            $data["errors"] = $e->getMessage();
            echo json_encode($data["errors"]);
        }

    }

}

/*
 * validation:
 * if end date is less than start date -> invalid
 * if start date, end date, room type, adults are empty -> invalid
 */