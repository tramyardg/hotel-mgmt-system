<?php


namespace dao;


use DB;
use PDO;

class AdminDAO
{
    public function __construct()
    {
    }

    protected function fetchByEmail($email)
    {
        $sql = 'SELECT * FROM `administrator` WHERE email=?';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Admin");
    }

    protected function fetchByAdminId($cid)
    {
        $sql = 'SELECT * FROM `administrator` WHERE `adminId`=?';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([$cid]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Admin");
    }

    protected function fetchAll()
    {
        $sql = 'SELECT * FROM `administrator`';
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Admin");
    }

}