<?php

require './vendor/autoload.php';
require 'app/DB.php';
require 'app/models/Admin.php';
require 'app/dao/AdminDAO.php';
require 'app/handlers/AdminHandler.php';

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
        $adminHandler = new AdminHandler();
        $this->assertNotNull($adminHandler->getAdmins());
        $this->assertEquals('Admin(s) found!', $adminHandler->getExecutionFeedback());

    }

    public function testCreate()
    {
        $adminHandler = new AdminHandler();
        $admin = new Admin();
        $admin->setFullName('Test');
        $admin->setEmail('test@gmail.com');
        $admin->setPassword('test');
        $admin->setPhone('5146832697');
        $adminHandler->createAdmin($admin);
        $this->assertEquals('1', $adminHandler->getExecutionFeedback());
    }
}
