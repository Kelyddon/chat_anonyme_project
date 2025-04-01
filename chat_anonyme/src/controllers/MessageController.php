<?php

namespace App\controllers;

use App\repositories\MessageRepository;
use App\models\Message;

class MessageController {
    private $messageRepository;

    public function __construct()  {
        $this->messageRepository = new MessageRepository();
    }

    public function display()   {
    $roomId = $_GET['room_id'] ?? 1;
    $messages = $this->messageRepository->getMessagesByRoomId($roomId);
    error_log("Messages retrieved: " . print_r($messages, true));
    $template = "chat/chat";
    require_once "src/views/layout.phtml";
    }
    
    public function sendMessage() {
        error_log("sendMessage called");
        if (!empty($_POST['room_id']) && !empty($_POST['content'])) {
            $roomId = $_POST['room_id'];
            $content = $_POST['content'];
            error_log("Room ID received: $roomId, Content received: $content");
            $message = new Message($roomId, $content);
            $success = $this->messageRepository->createMessage($message);
            if ($success) {
                error_log("Message created successfully in the database.");
                header("Location: index.php?page=message&room_id=" . $roomId . "&message=Message envoyé avec succès.");
                exit();
            } else {
                error_log("Failed to create message in the database.");
            }
        } else {
            error_log("Room ID or content is empty.");
            echo "L'ID du salon et le contenu du message sont requis.";
        }
    }
    
    public function pinMessage(){
        if (!empty($_GET['message_id'])) {
            $this->messageRepository->pinMessage($_GET['message_id']);
            header("Location: index.php?page=message&room_id=" . $_GET['room_id'] . "&message=Message épinglé avec succès.");
        }
    }
}
