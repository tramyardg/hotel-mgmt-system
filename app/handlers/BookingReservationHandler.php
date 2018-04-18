<?php

class BookingReservationHandler extends BookingReservationDAO
{
    private $booking;
    private $reservation;

    public function __construct(Booking $booking, Reservation $reservation)
    {
        $this->booking = $booking;
        $this->reservation = $reservation;
    }

    public function getBooking()
    {
        return $this->booking;
    }

    public function setBooking($booking)
    {
        $this->booking = $booking;
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
        $dao->insert($this->booking, $this->reservation);

    }
}