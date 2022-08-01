<?php

class BookingReservationHandler extends BookingReservationDAO
{
    private $reservation;
    private $pricing;
    private $executionFeedback;

    public function __construct(Reservation $reservation, Pricing $pricing)
    {
        $this->reservation = $reservation;
        $this->pricing = $pricing;
    }

    public function getExecutionFeedback()
    {
        return $this->executionFeedback;
    }

    public function setExecutionFeedback($executionFeedback)
    {
        $this->executionFeedback = $executionFeedback;
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
        if ($dao->insert($this->reservation, $this->pricing)) {
            $this->setExecutionFeedback(
                array(
                "heading" => "Well done!",
                "content" => "You have reserved a room. You can view the status of your booking anytime.",
                "footer"  => "Your booking will be mark confirmed once approved."
                )
            );
        } else {
            $this->setExecutionFeedback("Server error! Please try again later.");
        }
    }
}
