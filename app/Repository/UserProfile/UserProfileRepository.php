<?php

namespace App\Repository\UserProfile;


use App\Models\User;
use App\Models\UserProfile;
use App\Services\UserProfile\NewUserProfileRequest;
use App\Services\UserProfile\ShowUserProfileRequest;
use App\Services\UserProfile\ShowUserRequest;

interface UserProfileRepository {
    public function show(ShowUserProfileRequest $id): UserProfile;
    public function new(NewUserProfileRequest $profile): void;
    public function showUser(ShowUserRequest $user): User;
}