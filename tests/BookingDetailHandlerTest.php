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
        $r->setChildren(1);
        $r->setAdults(1);
        $r->setRequests($faker->text(20));
        $r->setTimestamp($faker->unixTime);
        $r->setRequirement($r->requirement()[\models\RequirementEnum::NON_SMOKING]);
        $r->setStatus($r->getStatus()[\models\StatusEnum::PENDING]);
        $brh = new BookingReservationHandler($r);
        $brh->create();

        $bdh = new BookingDetailHandler();
        $this->assertNotNull($bdh->getAllBookings());
        $this->assertNotEmpty($bdh->getAllBookings());
    }

    public function testGetCustomerBookings()
    {

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
