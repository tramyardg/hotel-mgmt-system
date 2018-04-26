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

        if ($ch->isEmailExists($email)) {
            $ch->deleteCustomer($ch->getCustomerObj($email));
            $this->assertNotTrue($ch->isEmailExists($email));
        }
    }

    public function testIsEmailExists()
    {
        $faker = Faker\Factory::create();
        $this->assertFalse((new CustomerHandler())->isEmailExists($faker->email));
        $this->assertTrue((new CustomerHandler())->isEmailExists("admin@admin.com"));
    }

    public function testsIsPasswordMatchWithEmail()
    {
        $ch = new CustomerHandler();
        $adminPassword = "admin123";
        $admin = $ch->getCustomerObj("admin@admin.com");
        $this->assertTrue($ch->isPasswordMatchWithEmail($adminPassword, $admin));
        $faker = Faker\Factory::create();
        $this->assertFalse($ch->isPasswordMatchWithEmail($faker->password, $ch->getCustomerObj($faker->email)));
    }

    public function testTotalCustomersCount()
    {
        $this->assertNotEmpty((new CustomerHandler())->totalCustomersCount());
        $this->assertNotNull((new CustomerHandler())->totalCustomersCount());
    }
}
