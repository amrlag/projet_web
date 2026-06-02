<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Chat.php';

class ChatController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            $this->render('access_denied', [
                'message' => 'Vous devez vous connecter pour accéder au mini-chat.'
            ]);
            return;
        }

        $chat = new Chat();
        $messages = $chat->getLastMessages();

        $this->render('chat', [
            'title' => 'Mini-chat',
            'messages' => $messages
        ]);
    }

    public function store()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ?page=login');
            exit;
        }

        $message = trim($_POST['message'] ?? '');

        if ($message !== '' && strlen($message) <= 255) {
            $chat = new Chat();
            $chat->create($_SESSION['user']['id'], $message);
        }

        header('Location: ?page=chat');
        exit;
    }
}
