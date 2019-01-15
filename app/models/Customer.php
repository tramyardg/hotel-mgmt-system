<?php

class Customer
{
    private $cid;
    private $fullname;
    private $email;
    private $password;
    private $phone;
    private $isAdmin = 0; // default

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->cid;
    }

    public function setId($id)
    {
        $this->cid = $id;
    }

    public function getFullName()
    {
        return $this->fullname;
    }

    public function setFullName($fullName)
    {
        $this->fullname = $fullName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function setPassword($password)
    {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $hashed_password;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


    public function setIsAdmin($flag)
    {
        $this->isAdmin = $flag;
    }


    // returns true if customer is admin
    public function isAdminSignedIn()
    {
        return $this->isAdmin == 1;
    }
}
