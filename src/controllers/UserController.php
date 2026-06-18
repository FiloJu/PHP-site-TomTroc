<?php

namespace Controllers;

use Views\View;
use Models\Managers\UserManager;
use Models\Managers\BookManager;

class UserController
{
    public function index(): void
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (empty($userId)) {
            header('Location: index.php?action=login');
            exit;
        }

        $userManager = new UserManager();
        $user = $userManager->findById((int)$userId);

        if (!$user) {
            header('Location: index.php?action=login');
            exit;
        }

        $bookManager = new BookManager();
        $books = $bookManager->findByUserId((int)$userId);

        $view = new View('Mon compte');
        $view->render('profile', [
            'user' => $user,
            'books' => $books,
        ]);
    }

    public function publicProfile(int $id): void
    {
        $userManager = new UserManager();
        $user = $userManager->findById($id);

        if (!$user) {
            header('Location: index.php?action=books');
            exit;
        }

        $bookManager = new BookManager();
        $books = $bookManager->findByUserId($id);

        $view = new View('Profil public');
        $view->render('publicProfile', [
            'user' => $user,
            'books' => $books,
        ]);
    }

    public function updateProfile(): void
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (empty($userId)) {
            header('Location: index.php?action=login');
            exit;
        }

        $userManager = new UserManager();
        $user = $userManager->findById((int)$userId);
        if (!$user) {
            header('Location: index.php?action=login');
            exit;
        }

        $username = trim($_POST['pseudo'] ?? $user->getUsername());
        $email = trim($_POST['email'] ?? $user->getEmail());
        $password = trim($_POST['password'] ?? '');
        $avatarName = $user->getAvatar() ?? 'avatar_default.png';

        if (!empty($_FILES['avatar']['tmp_name']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $tmpFile = $_FILES['avatar']['tmp_name'];
            $originalName = $_FILES['avatar']['name'];
            $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png'];

            if (in_array($extension, $allowed, true)) {
                $avatarName = sprintf('avatar_%d_%s.%s', $userId, uniqid(), $extension);
                $destination = __DIR__ . '/../../public/img/avatars/' . $avatarName;
                if (!is_dir(dirname($destination))) {
                    mkdir(dirname($destination), 0755, true);
                }
                move_uploaded_file($tmpFile, $destination);
            }
        }

        $updateData = [
            'username' => $username,
            'email' => $email,
            'avatar' => $avatarName,
        ];

        if ($password !== '') {
            $updateData['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $userManager->update((int)$userId, $updateData);

        header('Location: index.php?action=profile');
        exit;
    }
}
