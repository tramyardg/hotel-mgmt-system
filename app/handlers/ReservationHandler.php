<?php

class ReservationHandler {

    public function __construct () {}

    private $executionFeedback;

    public function getExecutionFeedback()
    {
        return $this->executionFeedback;
    }

    public function setExecutionFeedback($executionFeedback)
    {
        $this->executionFeedback = $executionFeedback;
    }

    public function updateReservation(Reservation $r)
    {
        try {
            $dao = new ReservationDAO();
            $this->setExecutionFeedback($dao->update($r));
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function deleteReservation(Reservation $r)
    {
        try {
            $dao = new ReservationDAO();
            $this->setExecutionFeedback($dao->delete($r));
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function getAllReservations()
    {
        try {
            $dao = new ReservationDAO();
            return $dao->getAll();
        } catch (Exception $e) {
            return $e;
        }
    }

    private function getSingleRowByHash($unique)
    {
        try {
            $dao = new ReservationDAO();
            return $dao->getByHash($unique);
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * @param $hash
     * @return Reservation
     */
    public function getReservationObjByHash($hash) {
        $r = new Reservation();
        $dao = new ReservationDAO();
        foreach ($dao->getByHash($hash) as $v) {
            $r->setBookingId($v->getBookingId()); // important part here
            $r->setCid($v->getCid());
            $r->setStart($v->getStart());
            $r->setEnd($v->getEnd());
            $r->setRoomType($v->getRoomType());
            $r->setRequirement($v->getRequirement());
            $r->setAdults($v->getAdults());
            $r->setChildren($v->getChildren());
            $r->setRequests($v->getRequests());
            $r->setHash($v->getHash());
        }
        return $r;
    }

    /**
     * @param Customer $c
     * @return array
     */
    public function getReservationObj(Customer $c)
    {
        $dao = new ReservationDAO();
        return $dao->getByCid($c->getId());
    }

    public function totalReservationsCount()
    {
        return count($this->getAllReservations());
    }

}
