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
}
