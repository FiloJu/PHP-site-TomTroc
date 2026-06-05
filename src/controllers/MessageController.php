<?php

namespace Controllers;

use Models\Entities\Message;
use Models\Managers\MessageManager;
use Views\View;

class MessageController
{
    public function index(): void
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (empty($userId)) {
            header('Location: index.php?action=login');
            exit;
        }

        $manager = new MessageManager();

        // Si on a demandé une conversation spécifique via sender_id
        $senderId = isset($_GET['sender_id']) ? (int)$_GET['sender_id'] : null;
        if ($senderId) {
            $data = $manager->findConversationBetween((int)$userId, $senderId);
            $view = new View('Conversation');
            $view->render('conversation', [
                'other_user' => $data['other_user'],
                'messages' => $data['messages'],
                'current_user_id' => (int)$userId,
            ]);
            return;
        }

        $conversations = $manager->findConversationsByReceiver((int)$userId);

        $view = new View('Messages');
        $view->render('messages', ['conversations' => $conversations]);
    }

    public function create(array $data = []): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $senderId = $_SESSION['user_id'] ?? null;
            $receiverId = isset($data['receiver_id']) ? (int) $data['receiver_id'] : null;
            $content = trim($data['content'] ?? '');

            if (empty($senderId) || empty($receiverId) || $content === '') {
                $error = 'Merci de remplir tous les champs pour envoyer un message.';
                $view = new View('Nouveau message');
                $view->render('createMessage', ['error' => $error, 'receiver_id' => $receiverId]);
                return;
            }

            $manager = new MessageManager();
            $messageId = $manager->create([
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'content' => $content,
                'is_read' => 0,
            ]);

            header('Location: index.php?action=messages');
            exit;
        }

        $receiverId = isset($_GET['receiver_id']) ? (int) $_GET['receiver_id'] : null;
        $view = new View('Nouveau message');
        $view->render('createMessage', ['receiver_id' => $receiverId]);
    }
}