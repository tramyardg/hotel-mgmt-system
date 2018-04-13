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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->cid;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->cid = $id;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullname;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullname = $fullName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $hashed_password;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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