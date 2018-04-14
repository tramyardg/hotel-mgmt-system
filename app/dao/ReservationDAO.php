<?php

class ReservationDAO
{

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

    public function update(Reservation $r)
    {
        $sql = 'UPDATE `reservation`';
        $sql .= ' SET `start`="' . $r->getStart() . '",';
        $sql .= '`end`="' . $r->getEnd() . '",';
        $sql .= '`type`="' . $r->getRoomType() . '",';
        $sql .= '`requirement`="' . $r->getRequirement() . '",';
        $sql .= '`adults`=' . $r->getAdults() . ',';
        $sql .= '`children`=' . $r->getChildren() . ',';
        $sql .= '`requests`="' . $r->getRequests() . '"';
        $sql .= ' WHERE `id`=' . $r->getBookingId();
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute();
        return $exec;
    }

    public function delete(Reservation $r)
    {
        $sql = 'DELETE FROM `reservation` WHERE `reservation`.`id` = ? AND `reservation`.`cid` = ?';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$r->getBookingId(), $r->getCid()]);
        $exec = $stmt->rowCount();
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
 * [x] update
 * [x] delete
 * [x] read
 */