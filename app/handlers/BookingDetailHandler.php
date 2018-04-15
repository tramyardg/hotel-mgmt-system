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
}