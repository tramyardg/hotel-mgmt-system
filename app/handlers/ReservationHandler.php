<?php

class ReservationHandler {

    public function __construct () {}


    private $executionSuccessful;

    // verifies if execution of DAO methods works
    // and does not return error
    // use for create, delete, update
    public function getExecutionFeedback()
    {
        if ($this->executionSuccessful)
            return "1";
        else
            return "0";
    }

    public function setExecutionSuccessful($executionSuccessful)
    {
        $this->executionSuccessful = $executionSuccessful;
    }

    public function create(Reservation $r)
    {
        try {
            $dao = new ReservationDAO();
            $this->setExecutionSuccessful($dao->insert($r));
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function updateReservation(Reservation $r)
    {
        try {
            $dao = new ReservationDAO();
            $this->setExecutionSuccessful($dao->update($r));
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function deleteReservation(Reservation $r)
    {
        try {
            $dao = new ReservationDAO();
            $this->setExecutionSuccessful($dao->delete($r));
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

}
