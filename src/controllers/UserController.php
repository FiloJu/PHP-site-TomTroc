<?php

namespace Controllers;

use Views\View;
use Models\Managers\UserManager;
use Models\Managers\BookManager;

class UserController
{
    private function checkAuthorisation()
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (empty($userId)) {
            header('Location: index.php?action=login');
            exit;
        }
        return $userId;
    }
    public function index(): void
    {
        $userId=$this->checkAuthorisation();

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

    private function saveAvatar($file, $userId)
    {
        if (!empty($file['tmp_name']) && $file['error'] === UPLOAD_ERR_OK) {
            $tmpFile = $file['tmp_name'];
            $originalName = $file['name'];
            $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png'];

            if (in_array($extension, $allowed, true)) {
                $avatarName = sprintf('avatar_%d_%s.%s', $userId, uniqid(), $extension);
                $destination = __DIR__ . '/../../public/img/avatars/' . $avatarName;
                if (!is_dir(dirname($destination))) {
                    mkdir(dirname($destination), 0755, true);
                }
                move_uploaded_file($tmpFile, $destination);
                return $avatarName;
            }
        }
        return null;
    }
    public function updateProfile(): void
    {
        $userId = $this->checkAuthorisation();

        $userManager = new UserManager();
        $user = $userManager->findById($userId);
        if (!$user) {
            header('Location: index.php?action=login');
            exit;
        }

        $avatarName=$this->saveAvatar($_FILES['avatar'], $userId);
        $user->setAvatar($avatarName ?? $user->getAvatar());
        $user->setUsername($_POST['pseudo'] ?? $user->getUsername());
        $user->setEmail($_POST['email'] ?? $user->getEmail());
        //$user->setPassword($_POST['password'] ?? '');
        // $username = trim($_POST['pseudo'] ?? $user->getUsername());
        // $email = trim($_POST['email'] ?? $user->getEmail());
        // $password = trim($_POST['password'] ?? '');
        //$avatarName = $user->getAvatar() ?? 'avatar_default.png';

        if (!empty($_POST['password'])) {
            $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
        }

        $userManager->save($user);

        header('Location: index.php?action=profile');
        exit;
    }
}
