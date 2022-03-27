<?php

namespace App\Services\UserProfile;


use App\Models\UserProfile;
use App\Repository\UserProfile\PdoUserProfileRepository;
use App\Repository\UserProfile\UserProfileRepository;

class ShowUserProfileService {


    private UserProfileRepository $userProfileRepository;

    public function __construct()
    {
        $this->userProfileRepository = new PdoUserProfileRepository();
    }

    public function execute(ShowUserProfileRequest $id): UserProfile {
      return $this->userProfileRepository->show($id);
    }
}
