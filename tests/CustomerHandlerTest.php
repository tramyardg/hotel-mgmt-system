<?php
require './vendor/autoload.php';


class CustomerHandlerTest extends PHPUnit_Framework_TestCase
{
    public function testGetAllCustomer()
    {
        $ch = new CustomerHandler();
        $this->assertNotEmpty($ch->getAllCustomer());
        $this->assertNotNull($ch->getAllCustomer());
    }

    public function testGetSingleRow()
    {
        $ch = new CustomerHandler();
        $this->assertEquals(1, count($ch->getSingleRow("admin@gmail.com")));
        $this->assertNotEquals(2, count($ch->getSingleRow("admin@gmail.com")));
    }

    public function testGetCustomerObj()
    {
        $ch = new CustomerHandler();
        $email = "admin@gmail.com";
        $this->assertNotEmpty($ch->getCustomerObj($email));
        $customerEmail = $ch->getCustomerObj($email)->getEmail();
        $this->assertEquals("admin@gmail.com", $customerEmail);
    }

    public function testGetCustomerObjByCid()
    {
        $nonExistentId = 9999;
        $ch = new CustomerHandler();
        $this->assertNull($ch->getCustomerObjByCid($nonExistentId)->getEmail());
        $this->assertEmpty($ch->getCustomerObjByCid($nonExistentId)->getEmail());
    }

    public function testGetUsername()
    {
        $ch = new CustomerHandler();
        $email = "test@gmail.com";
        $username = $ch->getUsername($email);
        $this->assertEquals("test", $username);
    }
}
