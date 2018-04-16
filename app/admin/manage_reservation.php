<?php

require '../DB.php';
require '../dao/BookingDetailDAO.php';
require '../models/BookingDetail.php';
require '../handlers/BookingDetailHandler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm"])) {
    $bdh = new BookingDetailHandler();
    $bdh->confirmSelection($_POST["item"]);
    echo $bdh->getExecutionFeedback();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cancel"])) {
    $bdh = new BookingDetailHandler();
    $bdh->cancelSelection($_POST["item"]);
    echo $bdh->getExecutionFeedback();
}