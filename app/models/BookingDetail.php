<?php

class BookingDetail
{
    private $customer;
    private $reservation;
    private $status;
    private $notes;

    /**
     * BookingDetail constructor.
     * @param $customer
     * @param $reservation
     */
    public function __construct(Customer $customer, Reservation $reservation)
    {
        $this->customer = $customer;
        $this->reservation = $reservation;
    }

    public function getCustomer()
    {
        // usage:
        // $bd = new BookingDetail($c, $r;
        // $bd->getCustomer()->getFullName();
        return $this->customer;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getReservation()
    {
        return $this->reservation;
    }

    public function setReservation($reservation)
    {
        $this->reservation = $reservation;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

}
