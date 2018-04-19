<?php

class BookingDetailDAO
{

    public function __construct()
    {
    }

    protected function insert(Reservation $r)
    {
        // the number of booking and reservation should be the same
        // first insert booking
        // pass the id of last inserted booking id
        // to reservation -> this id is used as it's primary key
        // therefore booking and reservation rows are equal

        $sqlInsertBooking = 'INSERT INTO `booking` (`cid`, `status`, `notes`) VALUES (?, ?, ?)';
        $db = DB::getInstance();
        $stmt = $db->prepare($sqlInsertBooking);
        $stmt->execute(array($r->getCid(), $r->getStatus(), $r->getNotes()));
        $lastInsertedBookId = $db->lastInsertId();

        $sqlInsertReservation = 'INSERT INTO `reservation` (`id`, `start`, `end`, `type`, `requirement`, `adults`, `children`, `requests`, `hash`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);';

        $exec = DB::getInstance()->prepare($sqlInsertReservation)->execute(array(
            $lastInsertedBookId,
            $r->getStart(),
            $r->getEnd(),
            $r->getType(),
            $r->getRequirement(),
            $r->getAdults(),
            $r->getChildren(),
            $r->getRequests(),
            $r->getHash()
        ));

        return $exec;
    }

    /**
     * Use for displaying complete booking details.
     * It has reservation + booking data sets.
     */
    public function fetchBooking()
    {
        $sql = 'SELECT
          t1.*,
          t2.*
        FROM booking AS t1 LEFT JOIN reservation AS t2 ON t1.id = t2.id';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateConfirmed($i)
    {
        $sql = 'UPDATE `booking` SET `status` = ? WHERE `booking`.`id` = ' . $i . ';';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute(["confirmed"]);
        return $exec;
    }

    public function updateCancelled($i)
    {
        $sql = 'UPDATE `booking` SET `status` = ? WHERE `booking`.`id` = ' . $i . ';';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute(["cancelled"]);
        return $exec;
    }

    public function fetchBookingByCid($cid)
    {
        $sql = 'SELECT
          t1.id,
          t1.status,
          t2.start,
          t2.end,
          t2.type,
          t2.requirement,
          t2.adults,
          t2.children,
          t2.requests,
          t2.timestamp
        FROM booking AS t1 LEFT JOIN reservation AS t2 ON t1.id = t2.id
        WHERE t1.cid = ?;';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$cid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

/**
 * CRUD functions
 * [x] insert
 * [x] update
 * [-] delete
 * [x] read
 */