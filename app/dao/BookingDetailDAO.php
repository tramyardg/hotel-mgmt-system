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

    /**
     * Use for displaying complete booking details.
     * It has reservation + booking data sets.
     * @return bool
     */
    public function fetchBooking() {
        $sql = 'SELECT t1.id, t1.cid, t1.start, t1.end, t1.type, t1.requirement, t1.adults, t1.children, ';
        $sql .= 't1.requests, t1.timestamp, t2.id AS `bid`, t2.status, t2.notes ';
        $sql .= 'FROM reservation AS t1 ';
        $sql .= 'LEFT JOIN booking AS t2 ';
        $sql .= 'ON t1.id = t2.rid ';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute();
        return $exec;
    }

    /**
     * Use for displaying complete booking details
     * of customer
     * @param Customer $c
     * @return bool
     */
    public function fetchBookingByCid(Customer $c)
    {
        $sql = 'SELECT t1.id, t1.cid, t1.start, t1.end, t1.type, t1.requirement, t1.adults, t1.children, ';
        $sql .= 't1.requests, t1.timestamp, t2.id AS `bid`, t2.status, t2.notes ';
        $sql .= 'FROM reservation AS t1 ';
        $sql .= 'LEFT JOIN booking AS t2 ';
        $sql .= 'ON t1.id = t2.rid ';
        $sql .= 'WHERE t1.cid = ? ';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute([$c->getId()]);
        return $exec;
    }

}

/**
 * CRUD functions
 * [x] insert
 * [-] update
 * [-] delete
 * [x] read
 */