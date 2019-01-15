<?php

class Customer
{
    private $cid;
    private $fullname;
    private $email;
    private $password;
    private $phone;
    private $isadmin;

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

    public function getIsadmin()
    {
        return $this->isadmin;
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


    public function setIsadmin($flag)
    {
        $this->isadmin = $isadmin;
    }


    public function isAdminSignedIn()
    {
        if($this->isadmin)
        {
            return true;
        }
        return false;
    }
}
