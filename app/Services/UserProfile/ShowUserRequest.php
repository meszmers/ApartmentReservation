<?php

namespace App\Services\UserProfile;

class ShowUserRequest {
    private string $email;

    public function __construct(string $email)
    {

        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
