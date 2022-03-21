<?php

namespace App\Models;
class Reservation
{
    private $id;
    private $userId;
    private $apartmentId;
    private $dayFrom;
    private $dayTo;
    private $price;
    private $country;
    private $address;
    private $rooms;

    public function __construct($id, $userId, $apartmentId, $dayFrom, $dayTo, $price, $country, $address, $rooms)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->apartmentId = $apartmentId;
        $this->dayFrom = $dayFrom;
        $this->dayTo = $dayTo;
        $this->price = $price;
        $this->country = $country;
        $this->address = $address;
        $this->rooms = $rooms;
    }


    public function getPrice()
    {
        return $this->price;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getUserId()
    {
        return $this->userId;
    }

    public function getApartmentId()
    {
        return $this->apartmentId;
    }

    public function getDayFrom()
    {
        return $this->dayFrom;
    }


    public function getDayTo()
    {
        return $this->dayTo;
    }

    public function getCountry()
    {
        return $this->country;
    }


    public function getAddress()
    {
        return $this->address;
    }

    public function getRooms()
    {
        return $this->rooms;
    }
}