<?php

namespace App\Services\UserProfile;

use App\Repository\UserProfile\PdoUserProfileRepository;
use App\Repository\UserProfile\UserProfileRepository;

class NewUserProfileService {
    private UserProfileRepository $userProfileRepository;

    public function __construct()
    {
        $this->userProfileRepository = new PdoUserProfileRepository();
    }
    public function execute(NewUserProfileRequest $user) {
        $this->userProfileRepository->new($user);
    }
}
