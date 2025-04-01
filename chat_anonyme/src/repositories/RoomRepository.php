<?php

namespace App\repositories;

use App\models\Room;
use PDO;

class RoomRepository extends AbstractRepository{
    public function createRoom(Room $room){
        error_log("createRoom in repository called with room name: " . $room->getName());
        $roomRepository = $this->db->prepare("INSERT INTO rooms (name) VALUES (:name)");
        $success = $roomRepository->execute(['name' => $room->getName()]);

        if (!$success) {
            error_log("SQL Error: " . implode(", ", $roomRepository->errorInfo()));
        }
    return $success;
    }

    public function getRooms(): array{
        $roomRepository = $this->db->query("SELECT * FROM rooms");
        return $roomRepository->fetchAll(PDO::FETCH_ASSOC);
    }
}
