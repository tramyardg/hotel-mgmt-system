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

    public function getUsername($_email)
    {
        // use either full name or email for username
        $_fullName = null;
        foreach ($this->getByEmail($_email) as $obj) {
            $_fullName = $obj->getFullName();
        }
        if ($_fullName != null) {
            return $_fullName;
        } else {
            $positionOfAt = strpos($_email, "@");
            return substr($_email, 0, $positionOfAt);
        }
    }

    public function getAllCustomer()
    {
        try {
            $dao = new CustomerDAO();
            return $dao->getAll();
        } catch (Exception $e) {
            return $e;
        }
    }

    // return a single row not a collection
    public function getByEmail($email)
    {
        try {
            $dao = new CustomerDAO();
            return $dao->getCustomerByEmail($email);
        } catch (Exception $e) {
            return "Error. " . $e;
        }
    }

    // return full customer info based on email
    // usually you use getByEmail but this requires looping again
    public function getCustomerByEmail($email) {
        $c = new Customer();
        $k = $this->getByEmail($email);
        foreach ($k as $v) {
            $c->setId($v->getId());
            $c->setEmail($v->getEmail());
            $c->setPassword($v->getPassword());
            $c->setPhone($v->getPhone());
            $c->setFullName($v->getFullName());
        }
        return $c;
    }

    public function insertCustomer(Customer $customer)
    {
        // insert only when email does not yet exists
        try {
            if (!$this->isEmailExists($customer->getEmail())) {
                $dao = new CustomerDAO();
                $dao->insert($customer);
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function updateCustomer(Customer $customer)
    {
        try {
            if ($this->isEmailExists($customer->getEmail())) {
                $dao = new CustomerDAO();
                $dao->update($customer);
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function isEmailExists($email) {
        // return if email already exist
        return count($this->getByEmail($email)) > 0;
    }

    public function deleteCustomer(Customer $customer)
    {
        try {
            if ($this->isEmailExists($customer->getEmail())) {
                $dao = new CustomerDAO();
                $dao->delete($customer);
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function isPasswordMatchWithEmail($password, Customer $customer)
    {
        $hash = null;
        foreach ($this->getByEmail($customer->getEmail()) as $obj) {
            $hash = $obj->getPassword();
        }
        return (password_verify($password, $hash));
    }

}