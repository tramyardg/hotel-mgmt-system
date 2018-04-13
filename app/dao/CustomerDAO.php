<?php

class CustomerDAO extends DB
{
    public $table_name = "customer";
    public $id = "cid";

    public function __construct()
    {
    }

    public function getCustomerByEmail($email)
    {
        $sql = 'SELECT * FROM ' . $this->table_name . ' WHERE email=?';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Customer");
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM ' . $this->table_name;
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Customer");
    }

    public function insert(Customer $customer)
    {
        // cannot insert cid since it's already auto incremented
        $sql = 'INSERT INTO ' . $this->table_name . ' (`fullname`, `email`, `password`, `phone`) VALUES (?, ?, ?, ?)';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute(array(
            $customer->getFullName(),
            $customer->getEmail(),
            $customer->getPassword(),
            $customer->getPhone()
        ));
    }

    public function update(Customer $customer)
    {
        // email and cid cannot be updated since they are unique
        $sql = 'UPDATE ' . $this->table_name . ' ';
        $sql .= 'SET fullname = "' . $customer->getFullName() . '", ';
        $sql .= 'password = "' . $customer->getPassword() . '", ';
        $sql .= 'phone = "' . $customer->getPhone() . '"';
        $sql .= ' WHERE ' . $this->table_name . '.cid= ' . $customer->getId();
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
    }

    public function delete(Customer $customer)
    {
        $sql = 'DELETE FROM ' . $this->table_name . ' WHERE `customer`.`cid` = ?';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$customer->getId()]);
    }


}