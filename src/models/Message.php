<?php

namespace Models;

use DateTime;
class Message
{
    private int $id;
    private int $sender_id;
    private int $receiver_id;
    private string $content;
    private bool $is_read;
    private DateTime $created_at;
    public function __construct(int $id, int $sender_id, int $receiver_id, string $content, bool $is_read, DateTime $created_at)
    {
        $this->id = $id;
        $this->sender_id = $sender_id;
        $this->receiver_id = $receiver_id;
        $this->content = $content;
        $this->is_read = $is_read;
        $this->created_at = $created_at;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getSenderId(): int
    {
        return $this->sender_id;
    }
    public function getReceiverId(): int
    {
        return $this->receiver_id;
    }
    public function getContent(): string
    {
        return $this->content;
    }
    public function isRead(): bool
    {
        return $this->is_read;
    }
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

}
