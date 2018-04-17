<?php

class BookingDetailHandler
{
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

    public function create(Reservation $r)
    {
        try {
            $dao = new BookingDetailDAO();
            $this->setExecutionFeedback($dao->insert($r));
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

    public function getPending()
    {
        $count = 0;
        foreach ($this->getAllBookings() as $v) {
            if ($v->getStatus() == "pending") {
                $count++;
            }
        }
        return $count;
    }

    public function getConfirmed()
    {
        $count = 0;
        foreach ($this->getAllBookings() as $v) {
            if ($v->getStatus() == "confirmed") {
                $count++;
            }
        }
        return $count;
    }

    public function confirmSelection($item)
    {
        for ($i = 0; $i < count($item); $i++) {
            $dao = new BookingDetailDAO();
            if ($dao->updateConfirmed($item[$i])) {
                $out = "These reservations have been successfully <b>confirmed</b>.";
                $out .= " This page will reload to reflect changes.";
                $this->setExecutionFeedback($out);
            } else {
                $this->setExecutionFeedback("There must be an error processing your request. Please try again later.");
            }
        }
    }

    public function cancelSelection($item)
    {
        for ($i = 0; $i < count($item); $i++) {
            $dao = new BookingDetailDAO();
            if ($dao->updateCancelled($item[$i])) {
                $out = "These reservations have been successfully <b>cancelled</b>.";
                $out .= " This page will reload to reflect changes.";
                $this->setExecutionFeedback($out);
            } else {
                $this->setExecutionFeedback("There must be an error processing your request. Please try again later.");
            }
        }
    }

}