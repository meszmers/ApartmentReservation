<?php

namespace App\Repository\Apartment;

use App\Database;
use App\Models\Apartment;
use App\Services\Apartment\DeleteApartmentRequest;
use App\Services\Apartment\GetAllApartmentRequest;
use App\Services\Apartment\ShowApartmentRequest;
use App\Services\Apartment\StoreApartmentRequest;
use App\Services\Apartment\UpdateApartmentRequest;
use App\Services\UserProfile\ShowUserProfileRequest;
use App\Services\UserProfile\ShowUserProfileService;
use Doctrine\DBAL\Exception;

class PdoApartmentRepository implements ApartmentRepository {

    public function save(StoreApartmentRequest $apartment): void
    {
        try {

            Database::connection()->insert('apartments',
                [
                    "created_user_id" => $apartment->getCreatedUserId(),
                    "country" => $apartment->getCountry(),
                    "address" => $apartment->getAddress(),
                    "description" => $apartment->getDescription(),
                    "rooms" => $apartment->getRooms(),
                    "available_from" => $apartment->getAvailableFrom(),
                    "available_to" => $apartment->getAvailableTo(),
                    "price" => $apartment->getPrice(),
                    "picture" => $apartment->getPicture()
                ]);

        } catch(Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }
    }



    public function show(ShowApartmentRequest $apartmentId): Apartment
    {
        try {

            $db = Database::connection()->fetchAssociative('SELECT * FROM apartments WHERE id = ?', [$apartmentId->getId()]);
            return new Apartment(
                $db["id"],
                $db["created_user_id"],
                $db["country"],
                $db["address"],
                $db["description"],
                $db["rooms"],
                $db["available_from"],
                $db["available_to"],
                $db["created_at"],
                $db["price"],
                $db["picture"]
            );

        } catch(Exception $e) {
            echo "<pre>";
              echo $e;
            exit;
        }
    }


    public function remove(DeleteApartmentRequest $id): void
    {
        try {
        $database = Database::connection();
        $database->delete('apartments', ["id" => $id->getId()]);
        $database->delete('reviews', ['apartment_id' => $id->getId()]);
        $database->delete('reservations', ['apartment_id' => $id->getId()]);

        // unlink() need to check how to get to real folder and remove picture

        } catch (Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }
    }

    public function update(UpdateApartmentRequest $update): Void
    {
        try {
            Database::connection()->update('apartments',
                [
                    "country" => $update->getCountry(),
                    "address" => $update->getAddress(),
                    "description" => $update->getDescription(),
                    "rooms" => $update->getRooms(),
                    "price" => $update->getPrice()
                ],
                ['id' => $update->getApartmentId()]);

        } catch (Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }
    }



    public function getAll(GetAllApartmentRequest $id): array {

        try {

        if($id->getId() == null) {
            $db = Database::connection()->fetchAllAssociative('SELECT id FROM apartments');
        } else {
            $db = Database::connection()->fetchAllAssociative('SELECT id FROM apartments WHERE created_user_id = ?', [$id->getId()]);
        }

        } catch (Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }

        $apartmentInfo = [];
        foreach ($db as $construct) {
            $apartment = ($this->show( new ShowApartmentRequest($construct["id"])));
            $user = (new ShowUserProfileService())->execute(new ShowUserProfileRequest($apartment->getCreatedUserId()));

            if(strlen($apartment->getDescription()) > 355) {
                $apartment->setDescription(substr($apartment->getDescription(), 355). "...") ;
            }


            $apartmentInfo[] = ["apartmentInfo" => $apartment, "userInfo" => $user];
        }


        return $apartmentInfo;
    }
}
