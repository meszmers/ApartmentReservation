<?php

namespace App\Services\UserProfile;

class NewUserProfileRequest {
    private string $name;
    private string $surname;
    private string $pwd;
    private string $pwdRepeat;
    private string $email;
    private string $number;

    public function __construct(string $name, string $surname, string $pwd, string $pwdRepeat, string $email, string $number)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
        $this->number = $number;
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
    public function getName(): string
    {
        return $this->name;
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
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @return string
     */
    public function getPwdRepeat(): string
    {
        return $this->pwdRepeat;
    }
}

