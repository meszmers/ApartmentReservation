<?php

namespace App\Models;

class User {
    private int $id;
    private string $email;
    private string $password;
    private string $cratedAt;

    public function __construct(int $id, string $email, string $password, string $cratedAt)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->cratedAt = $cratedAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    public function getCratedAt(): string
    {
        return $this->cratedAt;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}