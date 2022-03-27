<?php

use App\Models\Apartment;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\User;
use App\Models\UserProfile;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase {

    public function testUser() {
        $x = new User(1,"test@gmail.com", "test", "2022-03-01 00:00:00");

        $this->assertSame(1, $x->getId());
        $this->assertSame("test@gmail.com", $x->getEmail());
        $this->assertSame("test", $x->getPassword());
        $this->assertSame("2022-03-01 00:00:00", $x->getCratedAt());

    }
    public function testUserProfile() {
        $x = new UserProfile(10,1 ,"test@gmail.com", "testName", "testSurname", "123456789",);

        $this->assertSame(10, $x->getId());
        $this->assertSame(1, $x->getUserId());
        $this->assertSame("test@gmail.com", $x->getEmail());
        $this->assertSame("testName", $x->getName());
        $this->assertSame("testSurname", $x->getSurname());
        $this->assertSame("123456789", $x->getPhoneNumber());

    }
    public function testApartment() {
        $x = new Apartment(89, 44, "Latvia", "address", "Cool Place!",
            4, "2022-03-01 00:00:00", "2022-10-01 00:00:00", "0000-00-00 00:00:00", 104.43, "picture.jpg");

        $this->assertSame(89, $x->getId());
        $this->assertSame(44, $x->getCreatedUserId());
        $this->assertSame("Latvia", $x->getCountry());
        $this->assertSame("address", $x->getAddress());
        $this->assertSame("Cool Place!", $x->getDescription());
        $this->assertSame(4, $x->getRooms());
        $this->assertSame("2022-03-01 00:00:00", $x->getAvaFrom());
        $this->assertSame("2022-10-01 00:00:00", $x->getAvaTo());
        $this->assertSame("0000-00-00 00:00:00", $x->getCreatedAt());
        $this->assertSame(104.43, $x->getPrice());
        $this->assertSame("picture.jpg", $x->getPicture());

    }
    public function testReservation() {
        $x = new Reservation(69, 1, 11, "10 May", "10 June", 101.10);

        $this->assertSame(69, $x->getId());
        $this->assertSame(1, $x->getUserId());
        $this->assertSame(11, $x->getApartmentId());
        $this->assertSame("10 May", $x->getDayFrom());
        $this->assertSame("10 June", $x->getDayTo());
        $this->assertSame(101.10, $x->getTotalPrice());

    }
    public function testReview() {
        $x = new Review(10231, 1241412, 3, "Total Garbage! :(", "0000-00-00 00:00:00", 21412412);

        $this->assertSame(21412412, $x->getId());
        $this->assertSame(10231, $x->getUserId());
        $this->assertSame(1241412, $x->getApartmentId());
        $this->assertSame(3, $x->getRating());
        $this->assertSame("Total Garbage! :(", $x->getReview());
        $this->assertSame("0000-00-00 00:00:00", $x->getCreatedAt());

    }
}
