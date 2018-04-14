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

}
