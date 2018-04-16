<?php
require 'app/DB.php';
require 'app/dao/CustomerDAO.php';
require 'app/dao/ReservationDAO.php';
require 'app/dao/BookingDetailDAO.php';

require 'app/models/Customer.php';
require 'app/models/Reservation.php';
require 'app/models/BookingDetail.php';

try {


    $bd = new BookingDetailDAO();
//    $bd->fetchBooking();

    $c = new Customer();
    $c->setId(2);

    $booking = $bd->fetchBookingByCid($c);
    foreach ($booking as $v) {
        echo $v->getStart();
    }

} catch (Exception $e) {
    print $e->getMessage();
}