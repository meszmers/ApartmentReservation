<?php

namespace App\Services\UserProfile;

use App\Models\User;
use App\Repository\UserProfile\PdoUserProfileRepository;
use App\Repository\UserProfile\UserProfileRepository;

class ShowUserService {
    private UserProfileRepository $userProfileRepository;

    public function __construct()
    {
        $this->userProfileRepository = new PdoUserProfileRepository();
    }

    public function execute(ShowUserRequest $user): User {
       return $this->userProfileRepository->showUser($user);
    }
}
