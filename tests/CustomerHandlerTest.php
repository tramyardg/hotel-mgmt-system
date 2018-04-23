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
}
