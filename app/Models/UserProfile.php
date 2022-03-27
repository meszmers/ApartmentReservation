<?php

namespace App\Models;

class UserProfile
{
    private int $id;
    private int $userId;
    private string $email;
    private string $name;
    private string $surname;
    private string $phoneNumber;

    public function __construct(int $id, int $userId, string $email, string $name, string $surname, string $phoneNumber)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->email = $email;
        $this->name = $name;
        $this->surname = $surname;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }


}
