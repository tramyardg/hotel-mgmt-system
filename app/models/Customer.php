<?php

class Customer
{

    public function __construct () {}

    // private variables have to be
    // the same as the column names
    // in the database
    private $cid;
    private $fullname;
    private $email;
    private $password;
    private $phone;

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

    public function isAdminSignedIn()
    {
        $admins = file_get_contents("admin.json");
        $content = json_decode($admins, true);

        $isAdmin = false;
        foreach ($content as $k => $v) {
            if ($this->getEmail() == $v["email"]) {
                $isAdmin = true;
                break;
            }
        }
        return $isAdmin;
    }

}