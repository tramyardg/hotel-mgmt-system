<?php

class Reservation extends Booking
{
    private $start;
    private $end;
    private $type;
    private $requirement;
    private $adults;
    private $children;
    private $requests;
    private $timestamp;
    private $hash;

    public function __construct()
    {
        parent::__construct();
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

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
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

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    public function requirement()
    {
        return array("No preference", "Non-smoking", "Smoking");
    }
}
