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
        $r->setStatus(\models\StatusEnum::CONFIRMED_STR);
        $r->setNotes(null);
        $r->setStart($faker->date("2018-12-12"));
        $r->setEnd($faker->date("2018-12-22"));
        $r->setType("test");
        $r->setRequirement($r->requirement()[\models\RequirementEnum::SMOKING]);
        $r->setChildren(1);
        $r->setAdults(1);
        $r->setRequests($faker->text(20));
        $r->setTimestamp($faker->unixTime);

        $p = new Pricing();
        $p->setBookedDate(Util::dateToday('0'));
        $p->setNights(3);
        $p->setPricingId(1);
        $p->setTotalPrice(2000);

        $brh = new BookingReservationHandler($r, $p);
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
        $this->assertNotNull($bdh->getCustomerBookings($c));
        $this->assertEquals(1, $bdh->getExecutionFeedback());
    }

    public function testGetPending()
    {
        $bdh = new BookingDetailHandler();
        if (count($bdh->getAllBookings()) > 0) {
            $this->assertNotNull($bdh->getPending());
            $this->assertNotEmpty($bdh->getPending());
        }
    }

    public function testGetConfirmed()
    {
        $bdh = new BookingDetailHandler();
        if (count($bdh->getAllBookings()) > 0) {
            $this->assertNotNull($bdh->getConfirmed());
            $this->assertNotEmpty($bdh->getConfirmed());
        }
    }

    public function testConfirmSelection()
    {
        // TODO
    }

    public function testCancelSelection()
    {
        // TODO
    }

}
