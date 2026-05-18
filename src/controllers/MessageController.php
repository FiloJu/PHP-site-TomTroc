<?php

namespace Controllers;

use Models\Entities\Message;

class MessageController
{
    public function create(array $data = []): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($data)) {
            $data = $_POST;
        }

        // TODO: handle message creation and render the appropriate view
    }
}