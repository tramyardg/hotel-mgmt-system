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
        print_r($ch->getCustomerObj($email));
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

    public function testInsertCustomer()
    {
        $ch = new CustomerHandler();
        $c = new Customer();
        $faker = Faker\Factory::create();
        $fakeName = $faker->name;
        $fakeEmail = $faker->email;
        $c->setFullName($fakeName);
        $c->setEmail($fakeEmail);
        $c->setPassword($faker->password);
        $c->setPhone($faker->phoneNumber);
        $ch->insertCustomer($c);
        $this->assertEquals($fakeName, $ch->getCustomerObj($fakeEmail)->getFullName());
    }

    public function testUpdateCustomer()
    {
        $ch = new CustomerHandler();
        $c = new Customer();
        $c = $ch->getCustomerObj("admin@gmail.com");
        $newName = uniqid();

        $c->setFullName($newName);
        $ch->updateCustomer($c);
        $this->assertEquals($ch->getCustomerObj("admin@gmail.com")->getFullName(), $newName);
    }

    public function testDeleteCustomer()
    {
        $ch = new CustomerHandler();
        $email = "test@gmail.com";
        $c = new Customer();
        $faker = Faker\Factory::create();
        $c->setFullName($faker->name);
        $c->setEmail($email);
        $c->setPassword($faker->password);
        $c->setPhone($faker->phoneNumber);
        $ch->insertCustomer($c);
        $ch->deleteCustomer($ch->getCustomerObj($email));
    }

    public function testsIsPasswordMatchWithEmail()
    {
        $ch = new CustomerHandler();
        $adminPassword = "admin123";
        $admin = $ch->getCustomerObj("admin@admin.com");
        $this->assertEquals("Password is valid!", $ch->isPasswordMatchWithEmail($adminPassword, $admin));
    }

    public function testTotalCustomersCount()
    {
        $this->assertNotEmpty((new CustomerHandler())->totalCustomersCount());
        $this->assertNotNull((new CustomerHandler())->totalCustomersCount());
    }
}
