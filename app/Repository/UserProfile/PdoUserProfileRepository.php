<?php

namespace App\Repository\UserProfile;

use App\Database;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\UserProfile\NewUserProfileRequest;
use App\Services\UserProfile\ShowUserProfileRequest;
use App\Services\UserProfile\ShowUserRequest;
use Doctrine\DBAL\Exception;

class PdoUserProfileRepository implements UserProfileRepository {


    public function show(ShowUserProfileRequest $id): UserProfile {

        try {
            $db = Database::connection()->fetchAssociative('SELECT * FROM users_profile WHERE user_id = ?', [$id->getUserId()]);

            return new UserProfile(
                $db["id"],
                $db["user_id"],
                $db["email"],
                $db["name"],
                $db["surname"],
                $db["phone_number"]
            );
        } catch(Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }
    }

    public function new(NewUserProfileRequest $profile): void
    {
        try {
            Database::connection()->insert('users', [
                "email" => $profile->getEmail(),
                "password" => password_hash($profile->getPwd(), PASSWORD_DEFAULT)
            ]);

            $info = $this->showUser(new ShowUserRequest($profile->getEmail()));

            Database::connection()->insert('users_profile',
                [
                    "user_id" => $info->getId(),
                    "email" => $profile->getEmail(),
                    "name" => $profile->getName(),
                    "surname" => $profile->getSurname(),
                    "phone_number" => $profile->getNumber()
                ]);
        }  catch (Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }
    }

    public function showUser(ShowUserRequest $user): User
    {
        try {
            $db = Database::connection()->fetchAssociative('SELECT * FROM users WHERE email = ?', [$user->getEmail()]);

            return new User(
                $db["id"],
                $db["email"],
                $db["password"],
                $db["created_at"]
            );
        } catch (Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }
    }
}