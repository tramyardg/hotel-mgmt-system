<?php
require 'app/DB.php';

require 'app/dao/BookingReservationDAO.php';
require 'app/dao/CustomerDAO.php';
require 'app/dao/ReservationDAO.php';
require 'app/dao/BookingDetailDAO.php';

require 'app/models/Customer.php';
require 'app/models/Reservation.php';
require 'app/models/BookingDetail.php';

require 'app/handlers/BookingReservationHandler.php';

try {

    $r = new Reservation();
    $r->setCid(1);
    $r->setStatus("pending");
    // and all reservation information

    $b = new Booking(); // do we even need booking object? reservation already extends it

    $brh = new BookingReservationHandler($b, $r);
    $brh->create();

} catch (Exception $e) {
    print $e->getMessage();
}