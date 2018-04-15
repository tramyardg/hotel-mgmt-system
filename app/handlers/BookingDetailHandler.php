<?php

class BookingDetailHandler
{
    public function __construct () {}

    private $executionSuccessful;

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
            $dao = new BookingDetailDAO();
            $this->setExecutionSuccessful($dao->insert($r));
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     * Generic method that maps both reservation
     * object and booking object
     */
    public function getAllBookings()
    {
        try {
            $dao = new BookingDetailDAO();
            return $dao->fetchBooking();
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Customer specific method that maps both
     * reservation data object and booking object
     * @param Customer $c
     * @return array|Exception
     */
    public function getCustomerBookings(Customer $c)
    {
        try {
            $dao = new BookingDetailDAO();
            return $dao->fetchBookingByCid($c);
        } catch (Exception $e) {
            return $e;
        }

    }

}