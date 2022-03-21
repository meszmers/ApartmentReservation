<?php

namespace App\Models;

class ApartmentInfo
{
    private $id;
    private $createdUserId;
    private $country;
    private $address;
    private $description;
    private $rooms;
    private $avaFrom;
    private $avaTo;
    private $createdAt;
    private $price;
    private $picture;

    public function __construct($id, $createdUserId, $country, $address, $description, $rooms, $avaFrom, $avaTo, $createdAt, $price, $picture)
    {
        $this->id = $id;
        $this->createdUserId = $createdUserId;
        $this->country = $country;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = $rooms;
        $this->avaFrom = $avaFrom;
        $this->avaTo = $avaTo;
        $this->createdAt = $createdAt;
        $this->price = $price;
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getAvaFrom()
    {
        return $this->avaFrom;
    }

    /**
     * @return mixed
     */
    public function getAvaTo()
    {
        return $this->avaTo;
    }

    /**
     * @return mixed
     */
    public function getCreatedUserId()
    {
        return $this->createdUserId;
    }

    /**
     * @return mixed
     */
    public function getRooms()
    {
        return $this->rooms;
    }
}