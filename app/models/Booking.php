<?php

class Booking
{
    public function __construct () {}

    private $id;
    private $cid;
    private $start;
    private $end;
    private $type;
    private $requirement;
    private $adults;
    private $children;
    private $requests;

    public function getBookingId()
    {
        return $this->id;
    }

    public function setBookingId($bookingId)
    {
        $this->id = $bookingId;
    }

    public function getCid()
    {
        return $this->cid;
    }

    public function setCid($cid)
    {
        $this->cid = $cid;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function setEnd($end)
    {
        $this->end = $end;
    }

    public function getRoomType()
    {
        return $this->type;
    }

    public function setRoomType($roomType)
    {
        $this->type = $roomType;
    }

    public function getRequirement()
    {
        return $this->requirement;
    }

    public function setRequirement($requirement)
    {
        $this->requirement = $requirement;
    }

    public function getAdults()
    {
        return $this->adults;
    }

    public function setAdults($adults)
    {
        $this->adults = $adults;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setChildren($children)
    {
        $this->children = $children;
    }

    public function getRequests()
    {
        return $this->requests;
    }

    public function setRequests($requests)
    {
        $this->requests = $requests;
    }


}



