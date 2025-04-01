<?php

namespace App\repositories;

use App\models\Message;
use PDO;

class MessageRepository extends AbstractRepository{
    public function createMessage(Message $message){
        $messageRepository = $this->db->prepare("INSERT INTO messages (room_id, content, pinned, created_at) VALUES (:room_id, :content, :pinned, :created_at)");
        $success = $messageRepository->execute([
            'room_id' => $message->getRoomId(),
            'content' => $message->getContent(),
            'pinned' => (int)$message->isPinned(),
            'created_at' => $message->getCreatedAt()->format('Y-m-d H:i:s')
        ]);

        if (!$success) {
            error_log("SQL Error: " . implode(", ", $messageRepository->errorInfo()));
        }
        return $success;
    }

    public function getMessagesByRoomId(int $roomId): array{
        $messageRepository = $this->db->prepare("SELECT * FROM messages WHERE room_id = :room_id ORDER BY created_at DESC");
        $messageRepository->execute(['room_id' => $roomId]);
        return $messageRepository->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pinMessage(int $messageId){
        $messageRepository = $this->db->prepare("UPDATE messages SET pinned = 1 WHERE id = :id");
        return $messageRepository->execute(['id' => $messageId]);
    }
}
