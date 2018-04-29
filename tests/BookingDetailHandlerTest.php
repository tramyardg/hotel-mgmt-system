<?php
require './vendor/autoload.php';
require './app/models/RequirementEnum.php';
require './app/models/StatusEnum.php';

class BookingDetailHandlerTest extends PHPUnit_Framework_TestCase
{
    public function testGetAllBookings()
    {
        $faker = Faker\Factory::create();
        $r = new Reservation();
		$r->setCid(28);
        $r->setStatus($r->status()[\models\StatusEnum::CONFIRMED]);
        $r->setNotes(null);
        $r->setStart($faker->date("2018-12-12"));
        $r->setEnd($faker->date("2018-12-22"));
        $r->setType("test");
        $r->setRequirement($r->requirement()[\models\RequirementEnum::SMOKING]);
        $r->setChildren(1);
        $r->setAdults(1);
        $r->setRequests($faker->text(20));
        $r->setTimestamp($faker->unixTime);

        $brh = new BookingReservationHandler($r);
        $brh->create();

        $bdh = new BookingDetailHandler();
        $this->assertNotNull($bdh->getAllBookings());
        $this->assertNotEmpty($bdh->getAllBookings());
    }

    public function testGetCustomerBookings()
    {
        $c = new Customer();
        $c->setId(28);
        $bdh = new BookingDetailHandler();
        $this->assertNotEmpty($bdh->getCustomerBookings($c));
        $this->assertNotEmpty($bdh->getCustomerBookings($c));
    }

    public function testGetPending()
    {

    }

    public function testGetConfirmed()
    {

    }

    public function testConfirmSelection()
    {

    }

    public function testCancelSelection()
    {

    }

}
