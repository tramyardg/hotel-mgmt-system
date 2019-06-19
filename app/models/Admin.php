<?php


class Admin
{
    private $adminId;
    private $fullname;
    private $password;
    private $email;
    private $phone;

    public function getAdminId()
    {
        return $this->adminId;
    }

    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;
    }

    public function getFullName()
    {
        return $this->fullname;
    }

    public function setFullName($fullname)
    {
        $this->fullname = $fullname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
}