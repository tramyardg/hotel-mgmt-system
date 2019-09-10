<?php


class Pricing
{

    private $pricing_id;
    private $booking_id;
    private $nights;
    private $total_price; // can be calculated here!?
    private $booked_date;

    public function getPricingId()
    {
        return $this->pricing_id;
    }

    public function setPricingId($pricing_id)
    {
        $this->pricing_id = $pricing_id;
    }

    public function getBookingId()
    {
        return $this->booking_id;
    }

    public function setBookingId($booking_id)
    {
        $this->booking_id = $booking_id;
    }

    public function getNights()
    {
        return $this->nights;
    }

    public function setNights($nights)
    {
        $this->nights = $nights;
    }

    public function getTotalPrice()
    {
        return $this->total_price;
    }

    public function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;
    }

    public function getBookedDate()
    {
        return $this->booked_date;
    }

    public function setBookedDate($booked_date)
    {
        $this->booked_date = $booked_date;
    }
}