<?php

namespace App\models;
class Message extends AbstractModel{
    private $id;
    private $roomId;
    private $content;
    private $pinned;
    private $createdAt;

    public function __construct(int $roomId, string $content, bool $pinned = false){
        $this->roomId = $roomId;
        $this->content = $content;
        $this->pinned = $pinned;
        $this->createdAt = new \DateTime();
    }

    public function getRoomId(): int{
        return $this->roomId;
    }

    public function getContent(): string{
        return $this->content;
    }

    public function isPinned(): bool{
        return $this->pinned;
    }

    public function getCreatedAt(): \DateTime{
        return $this->createdAt;
    }
}
