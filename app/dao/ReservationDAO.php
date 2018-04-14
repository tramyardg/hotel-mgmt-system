<?php

class ReservationDAO
{
    public $table_name = "reservation";
    public $id = "id";

    public function __construct()
    {
    }

    public function insert(Reservation $reservation)
    {
        $sql = 'INSERT INTO `reservation`(`cid`, `start`,`end`,`type`,`requirement`,`adults`,`children`,`requests`)';
        $sql .= ' VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute(array(
            $reservation->getCid(),
            $reservation->getStart(),
            $reservation->getEnd(),
            $reservation->getRoomType(),
            $reservation->getRequirement(),
            $reservation->getAdults(),
            $reservation->getChildren(),
            $reservation->getRequests()
        ));
        return $exec;
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM ' . $this->table_name;
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Reservation");
    }
}

/**
 * CRUD functions
 * [x] insert
 * [-] update
 * [-] delete
 * [x] read
 */