<?php
namespace App\Models;
class ApartmentEdit {
    private $id;
    private $createdUserId;
    private $country;
    private $address;
    private $description;
    private $rooms;
    private $price;

    public function __construct($id, $createdUserId, $country, $address, $description, $rooms, $price)
    {
        $this->id = $id;
        $this->createdUserId = $createdUserId;
        $this->country = $country;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = $rooms;
        $this->price = $price;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getCountry()
    {
        return $this->country;
    }


    public function getPrice()
    {
        return $this->price;
    }


    public function getRooms()
    {
        return $this->rooms;
    }


    public function getCreatedUserId()
    {
        return $this->createdUserId;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function getAddress()
    {
        return $this->address;
    }
}
