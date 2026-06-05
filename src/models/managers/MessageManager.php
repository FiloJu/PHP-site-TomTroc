<?php

namespace Models\Managers;

use PDO;
use Models\Entities\Message;
use Models\Database;

class MessageManager extends AbstractEntityManager
{
    private string $table = "messages";

    public function create(array $data): int
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (sender_id, receiver_id, content, is_read, created_at) VALUES (:sender_id, :receiver_id, :content, :is_read, :created_at)");
        $stmt->execute([
            'sender_id' => $data['sender_id'],
            'receiver_id' => $data['receiver_id'],
            'content' => $data['content'],
            'is_read' => $data['is_read'] ?? 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return (int)$this->db->lastInsertId();
    }

    /**
     * Récupère les messages reçus par un utilisateur, groupés par sender_id.
     * Renvoie un tableau associatif [sender_id => ['sender_username' => string, 'messages' => [...messages...]]]
     */
    public function findConversationsByReceiver(int $receiverId): array
    {
        $sql = "SELECT m.id, m.sender_id, u.username AS sender_username, m.content, m.is_read, m.created_at
                FROM {$this->table} m
                LEFT JOIN users u ON m.sender_id = u.id
                WHERE m.receiver_id = :receiver_id
                ORDER BY m.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['receiver_id' => $receiverId]);
        $rows = $stmt->fetchAll();

        $conversations = [];
        foreach ($rows as $row) {
            $sid = $row['sender_id'];
            if (!isset($conversations[$sid])) {
                $conversations[$sid] = [
                    'sender_username' => $row['sender_username'] ?? 'Utilisateur',
                    'messages' => [],
                ];
            }
            $conversations[$sid]['messages'][] = [
                'id' => $row['id'],
                'content' => $row['content'],
                'is_read' => (int)$row['is_read'],
                'created_at' => $row['created_at'],
            ];
        }

        return $conversations;
    }

    /**
     * Récupère tous les messages échangés entre $userId et $otherUserId.
     * Retourne un tableau avec les messages et les infos de l'autre utilisateur.
     */
    public function findConversationBetween(int $userId, int $otherUserId): array
    {
        // Marquer comme lus les messages reçus par $userId venant de $otherUserId
        $update = $this->db->prepare("UPDATE {$this->table} SET is_read = 1 WHERE receiver_id = :receiver_id AND sender_id = :sender_id AND is_read = 0");
        $update->execute(['receiver_id' => $userId, 'sender_id' => $otherUserId]);

        $sql = "SELECT m.id, m.sender_id, m.receiver_id, u.username AS sender_username, m.content, m.is_read, m.created_at
                FROM {$this->table} m
                LEFT JOIN users u ON m.sender_id = u.id
                WHERE (m.sender_id = :user_id AND m.receiver_id = :other_id)
                   OR (m.sender_id = :other_id AND m.receiver_id = :user_id)
                ORDER BY m.created_at ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId, 'other_id' => $otherUserId]);
        $rows = $stmt->fetchAll();

        $messages = [];
        $otherUser = ['id' => $otherUserId, 'username' => null];
        foreach ($rows as $row) {
            $messages[] = [
                'id' => $row['id'],
                'sender_id' => (int)$row['sender_id'],
                'receiver_id' => (int)$row['receiver_id'],
                'sender_username' => $row['sender_username'] ?? 'Utilisateur',
                'content' => $row['content'],
                'is_read' => (int)$row['is_read'],
                'created_at' => $row['created_at'],
            ];
            if ($otherUser['username'] === null && (int)$row['sender_id'] === $otherUserId) {
                $otherUser['username'] = $row['sender_username'] ?? null;
            }
        }

        return ['other_user' => $otherUser, 'messages' => $messages];
    }
}