<?php

class View
{
    private string $layout = 'app/views/layouts/main.php';

    public function render(string $template, array $data = []): void
    {
        // Rendre les données disponibles dans la vue
        extract($data);

        // Capturer le contenu de la vue
        ob_start();
        require "app/views/pages/{$template}.php";
        $content = ob_get_clean();

        // Injecter dans le layout
        require $this->layout;
    }

    public function partial(string $template, array $data = []): void
    {
        extract($data);
        require "app/views/partials/{$template}.php";
    }
}
