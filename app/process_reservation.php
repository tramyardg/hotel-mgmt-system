<?php

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
    if ($endDate < $startDate)
        array_push($errors, "End date cannot be less than start date.");
    if (!empty($errors)) {
        $data["errors"] = $errors;
        echo json_encode($data["errors"]);
    } else {
        echo "1";
    }

}

/*
 * validation:
 * if end date is less than start date -> invalid
 * if start date, end date, room type, adults are empty -> invalid
 */