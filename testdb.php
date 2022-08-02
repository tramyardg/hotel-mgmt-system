<?php
require 'app/Util.php';
require 'app/DB.php';

require 'app/dao/BookingReservationDAO.php';
require 'app/dao/CustomerDAO.php';
require 'app/dao/BookingDetailDAO.php';

require 'app/models/Customer.php';
require 'app/models/Booking.php';
require 'app/models/Reservation.php';
require 'app/models/Pricing.php';

require 'app/handlers/BookingReservationHandler.php';

try {

    $r = new Reservation();
    $r->setCid(1);
    $r->setStatus("pending");
    $r->setNotes("asd");
    $r->setStart("123");
    $r->setEnd("123");
    $r->setType("asd");
    $r->setRequirement("asd");
    $r->setAdults("asdasd");
    $r->setChildren("asda");
    $r->setRequests("adsdas");
    $r->setTimestamp("sdas");
    $r->setHash(uniqid());
    // and all reservation information

    $p = new Pricing();
    $p->setBookedDate(Util::dateToday('0'));
    $p->setNights(3);
    $p->setPricingId(1);
    $p->setTotalPrice(2000);

    $brh = new BookingReservationHandler($r, $p);
    echo $brh->create();

} catch (Exception $e) {
    print $e->getMessage();
}