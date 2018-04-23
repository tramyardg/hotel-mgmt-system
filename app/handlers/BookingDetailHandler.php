<?php

class BookingDetailHandler
{
    public function __construct()
    {
    }

    private $executionFeedback;

    public function getExecutionFeedback()
    {
        return $this->executionFeedback;
    }

    public function setExecutionFeedback($executionFeedback)
    {
        $this->executionFeedback = $executionFeedback;
    }

    public function getAllBookings()
    {
        try {
            $dao = new BookingDetailDAO();
            return $dao->fetchBooking();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getCustomerBookings(Customer $c)
    {
        try {
            $dao = new BookingDetailDAO();
            return $dao->fetchBookingByCid($c->getId());
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getPending()
    {
        $count = 0;
        foreach ($this->getAllBookings() as $v) {
            if ($v["status"] == Util::pending) {
                $count++;
            }
        }
        return $count;
    }

    public function getConfirmed()
    {
        $count = 0;
        foreach ($this->getAllBookings() as $v) {
            if ($v["status"] == Util::confirmed) {
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
