<?php
namespace App\Controllers;
use App\Database;
use App\Models\DetailedApartmentInfo;

class ModelArrayController {

    public function ApartmentInfoArray() {
        $dataBase =  Database::connection();
        $apartments = $dataBase->fetchAllAssociative('SELECT * FROM apartments');
        $detailedApartmentInfo = [];
        foreach ($apartments as $construct) {
            $idFromUser = $dataBase->fetchAssociative(
                'SELECT name, surname, phone_number, email FROM users_profile WHERE user_id = ?', [$construct["created_user_id"]]);
            $detailedApartmentInfo[] = new DetailedApartmentInfo(
                $construct["id"],
                $idFromUser["name"],
                $idFromUser["surname"],
                $idFromUser["phone_number"],
                $idFromUser["email"],
                $construct["country"],
                $construct["address"],
                $construct["description"],
                $construct["rooms"],
                $construct["available_from"],
                $construct["available_to"],
                $construct["created_at"]);
        }
        return $detailedApartmentInfo;

    }
}
