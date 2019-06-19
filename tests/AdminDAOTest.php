<?php

require './vendor/autoload.php';
require 'app/DB.php';
require 'app/models/Admin.php';
require 'app/dao/AdminDAO.php';

class AdminDAOTest extends PHPUnit_Framework_TestCase
{
    public function testFetchByEmail()
    {

    }

    public function testFetchByAdminId()
    {

    }

    public function testFetchAll()
    {

    }

    public function testCreate()
    {
        $adminDao = new AdminDAO();
        $admin = new Admin();
        $admin->setFullName('Test');
        $admin->setEmail('test@gmail.com');
        $admin->setPassword('test');
        $admin->setPhone('5146832697');
        $adminDao->create($admin);
    }
}
