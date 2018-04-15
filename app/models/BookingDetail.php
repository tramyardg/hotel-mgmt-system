<?php

class BookingDetail
{

    private $id;
    private $cid;
    private $rid;
    private $status;
    private $notes;

    public function __construct()
    {
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
