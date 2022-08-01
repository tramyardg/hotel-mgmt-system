<?php

class BookingDetailHandler extends BookingDetailDAO
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
        if ($this->fetchBooking()) {
            return $this->fetchBooking();
        } else {
            return Util::DB_SERVER_ERROR;
        }
    }

    public function getCustomerBookings(Customer $c)
    {
        if ($this->fetchBookingByCid($c->getId())) {
            $this->setExecutionFeedback(1);
            return $this->fetchBookingByCid($c->getId());
        }
        return $this->setExecutionFeedback(0);
    }

    public function getPending()
    {
        $count = 0;
        $pending = \models\StatusEnum::PENDING_STR;
        foreach ($this->getAllBookings() as $v) {
            if (($v["status"] == $pending) || (strtoupper($v["status"]) == $pending)) {
                $count++;
            }
        }
        return $count;
    }

    public function getConfirmed()
    {
        $count = 0;
        $confirmed = \models\StatusEnum::CONFIRMED_STR;
        foreach ($this->getAllBookings() as $v) {
            if (($v["status"] == $confirmed) || (strtoupper($v["status"]) == $confirmed)) {
                $count++;
            }
        }
        return $count;
    }

    public function confirmSelection($item)
    {
        for ($i = 0; $i < count($item); $i++) {
            if ($this->updateConfirmed($item[$i])) {
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
            /*
            if ($this->updateBooking($item[$i], false, true)) {
                $out = "These reservations have been successfully <b>cancelled</b>.";
                $out .= " This page will reload to reflect changes.";
                $this->setExecutionFeedback($out);
            } else {
                $this->setExecutionFeedback("There must be an error processing your request. Please try again later.");
            }
            */
            if ($this->updateCancelled($item[$i])) {
                $out = "These reservations have been successfully <b>cancelled</b>.";
                $out .= " This page will reload to reflect changes.";
                $this->setExecutionFeedback($out);
            } else {
                $this->setExecutionFeedback("There must be an error processing your request. Please try again later.");
            }
        }
    }
}

// todo: protect booking functionalities (only admin can perform)