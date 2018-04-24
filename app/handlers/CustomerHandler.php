<?php

class CustomerHandler extends CustomerDAO
{
    public function __construct()
    {
    }

    private $serverErrorMsg = "Server error occurred. Please try again later.";

    private $executionFeedback;

    public function getExecutionFeedback()
    {
        return $this->executionFeedback;
    }

    public function setExecutionFeedback($executionFeedback)
    {
        $this->executionFeedback = $executionFeedback;
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

    public function getSingleRow($email)
    {
        try {
            $dao = new CustomerDAO();
            return $dao->getByEmail($email);
        } catch (Exception $e) {
            return "Error. " . $e;
        }
    }

    public function getCustomerObj($email)
    {
        $c = new Customer();
        $dao = new CustomerDAO();
        $k = $dao->getByEmail($email);
        foreach ($k as $v) {
            $c->setId($v->getId());
            $c->setEmail($v->getEmail());
            $c->setPassword($v->getPassword());
            $c->setPhone($v->getPhone());
            $c->setFullName($v->getFullName());
        }
        return $c;
    }

    public function getCustomerObjByCid($id)
    {
        $c = new Customer();
        $dao = new CustomerDAO();
        $k = $dao->getByCid($id);
        foreach ($k as $v) {
            $c->setId($v->getId());
            $c->setEmail($v->getEmail());
            $c->setPassword($v->getPassword());
            $c->setPhone($v->getPhone());
            $c->setFullName($v->getFullName());
        }
        return $c;
    }

    public function getUsername($_email)
    {
        $_fullName = null;
        foreach ($this->getSingleRow($_email) as $obj) {
            $_fullName = $obj->getFullName();
        }
        if ($_fullName != null) {
            return $_fullName;
        } else {
            $positionOfAt = strpos($_email, "@");
            return substr($_email, 0, $positionOfAt);
        }
    }

    public function insertCustomer(Customer $customer)
    {
        if (!$this->isEmailExists($customer->getEmail())) {
            $dao = new CustomerDAO();
            if ($dao->insert($customer)) {
                $this->setExecutionFeedback("You have successfully registered! You can now login.");
            } else {
                $this->setExecutionFeedback($this->serverErrorMsg);
            }
        } else {
            $this->setExecutionFeedback("Email already registered.");
        }
    }

    public function updateCustomer(Customer $customer)
    {
        if ($this->isEmailExists($customer->getEmail())) {
            $dao = new CustomerDAO();
            if ($dao->update($customer)) {
                $this->setExecutionFeedback("You have successfully updated your profile!");
            } else {
                $this->setExecutionFeedback($this->serverErrorMsg);
            }
        } else {
            $this->setExecutionFeedback("This email is not registered.");
        }
    }

    public function isEmailExists($email)
    {
        return count($this->getSingleRow($email)) > 0;
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
        foreach ($this->getSingleRow($customer->getEmail()) as $obj) {
            $hash = $obj->getPassword();
        }
        return (password_verify($password, $hash));
    }

    public function totalCustomersCount()
    {
        return count($this->getAllCustomer());
    }
}
