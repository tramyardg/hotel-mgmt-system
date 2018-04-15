<?php

class BookingDetailDAO
{

    public function __construct()
    {
    }

    public function insert(Reservation $r)
    {
        $sql = 'INSERT INTO `booking` (`cid`, `rid`) VALUES (?, ?)';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute(array($r->getCid(), $r->getBookingId()));
        return $exec;
    }
}

/**
 * CRUD functions
 * [x] insert
 * [-] update
 * [-] delete
 * [-] read
 */