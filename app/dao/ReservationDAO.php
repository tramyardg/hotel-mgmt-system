<?php

class ReservationDAO
{

    public function __construct()
    {
    }

    public function insert(Reservation $r)
    {
        $sql = 'INSERT INTO `reservation`(`cid`, `start`,`end`,`type`,`requirement`,`adults`,`children`,`requests`, `hash`)';
        $sql .= ' VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute(array(
            $r->getCid(),
            $r->getStart(),
            $r->getEnd(),
            $r->getRoomType(),
            $r->getRequirement(),
            $r->getAdults(),
            $r->getChildren(),
            $r->getRequests(),
            $r->getHash()
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
        $sql .= '`requests`="' . $r->getRequests() . ',';
        $sql .= '`hash`="' . $r->getHash() . '"';
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
        $sql = 'SELECT * FROM `reservation`';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Reservation");
    }

    public function getByHash($hash)
    {
        $sql = 'SELECT * FROM `reservation` WHERE `hash` = "' . $hash . '"';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Reservation");
    }

    public function getByCid($cid)
    {
        $sql = 'SELECT * FROM `reservation` WHERE `cid` = ' . $cid;
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