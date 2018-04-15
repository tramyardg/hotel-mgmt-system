<?php

class BookingDetail
{
    private $rid;
    private $cid;
    private $start;
    private $end;
    private $type;
    private $requirement;
    private $adults;
    private $children;
    private $requests;
    private $timestamp;
    private $bid;
    private $status;
    private $notes;

    public function __construct()
    {
    }

    public function getRid()
    {
        return $this->rid;
    }

    public function setRid($rid)
    {
        $this->rid = $rid;
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

    public function getBid()
    {
        return $this->bid;
    }

    public function setBid($bid)
    {
        $this->bid = $bid;
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
