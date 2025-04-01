<?php

namespace App\controllers;

use App\repositories\RoomRepository;
use App\models\Room;

class RoomController{
        private $roomRepository;

        public function __construct(){
            $this->roomRepository = new RoomRepository();
        }

        public function display(){
            $rooms = $this->roomRepository->getRooms();
            $template = "room/add_room";
            require_once "src/views/layout.phtml";
        }

        public function createRoom(){
        error_log("createRoom called");
            if (!empty($_POST['room_name'])) {
            $roomName = $_POST['room_name'];
            error_log("Room name received: " . $roomName);
            $room = new Room($roomName);
            $success = $this->roomRepository->createRoom($room);
            if ($success) {
                error_log("Room created successfully in the database.");
                header("Location: index.php?page=room&message=Salon créé avec succès.");
                exit();
            } else {
                error_log("Failed to create room in the database.");
            }
            } else {
                error_log("Room name is empty.");
                echo "Le nom du salon est requis.";
            }
        }  
}
