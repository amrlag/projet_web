<?php

class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);

        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            echo "Vue introuvable : " . htmlspecialchars($viewPath);
            return;
        }

        require $viewPath;
    }
}