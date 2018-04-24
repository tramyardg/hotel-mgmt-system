<?php

class CustomerDAO
{

    public function __construct()
    {
    }

    public function getByEmail($email)
    {
        $sql = 'SELECT * FROM `customer` WHERE email=?';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Customer");
    }

    public function getByCid($cid)
    {
        $sql = 'SELECT * FROM `customer` WHERE `customer`.`cid`=?';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$cid]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Customer");
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM `customer`';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Customer");
    }

    protected function insert(Customer $customer)
    {
        $sql = 'INSERT INTO `customer` (`fullname`, `email`, `password`, `phone`) VALUES (?, ?, ?, ?)';
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute(
            array(
            $customer->getFullName(),
            $customer->getEmail(),
            $customer->getPassword(),
            $customer->getPhone()
            )
        );
        return $exec;
    }

    protected function update(Customer $customer)
    {
        $sql = 'UPDATE `customer` ';
        $sql .= 'SET fullname = "' . $customer->getFullName() . '", ';
        $sql .= 'password = "' . $customer->getPassword() . '", ';
        $sql .= 'phone = "' . $customer->getPhone() . '"';
        $sql .= ' WHERE `customer`.`cid`= ' . $customer->getId();
        $stmt = DB::getInstance()->prepare($sql);
        $exec = $stmt->execute();
        return $exec;
    }

    public function delete(Customer $customer)
    {
        $sql = 'DELETE FROM `customer` WHERE `customer`.`cid` = ?';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$customer->getId()]);
    }
}
