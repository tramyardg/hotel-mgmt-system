<?php

class BookingReservationDAO
{
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

    protected function update(Reservation $r)
    {
        $sql = 'UPDATE `reservation`';
        $sql .= ' SET `start`="' . $r->getStart() . '",';
        $sql .= '`end`="' . $r->getEnd() . '",';
        $sql .= '`type`="' . $r->getType() . '",';
        $sql .= '`requirement`="' . $r->getRequirement() . '",';
        $sql .= '`adults`=' . $r->getAdults() . ',';
        $sql .= '`children`=' . $r->getChildren() . ',';
        $sql .= '`requests`="' . $r->getRequests() . ',';
        $sql .= '`hash`="' . $r->getHash() . '"';
        $sql .= ' WHERE `id`=' . $r->getId();
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute();
        return $exec;
    }

    protected function delete(Reservation $r)
    {
        $sql = 'DELETE FROM `booking` WHERE `booking`.`id` = ? AND `booking`.`cid` = ?';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$r->getId(), $r->getCid()]);
        $exec = $stmt->rowCount();
        return $exec;
    }
}
