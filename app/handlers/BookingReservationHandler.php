<?php

class BookingReservationHandler extends BookingReservationDAO
{
    private $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function getReservation()
    {
        return $this->reservation;
    }

    public function setReservation($reservation)
    {
        $this->reservation = $reservation;
    }

    public function create()
    {
        $dao = new BookingReservationDAO();
        if ($dao->insert($this->reservation)) {
            echo "good";
        } else {
            echo "no good";
        }
    }
}