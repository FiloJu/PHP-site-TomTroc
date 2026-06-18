<?php

namespace Views;
class View
{
    private string $layout = '../src/views/layouts/main.php';

    /**
     * Le titre de la page.
     */
    private string $title;


    /**
     * Constructeur.
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    public function render(string $template, array $data = []): void
    {
        // Rendre les données disponibles dans la vue
        extract($data);

        // Charger les utilitaires partagés avant de rendre la vue
        require_once __DIR__ . '/../services/Utils.php';

        // Capturer le contenu de la vue
        ob_start();
        require "../src/views/pages/{$template}.php";
        $content = ob_get_clean();

        // Injecter dans le layout
        require $this->layout;
    }

    public function partial(string $template, array $data = []): void
    {
        extract($data);
        require "../src/views/partials/{$template}.php";
    }
}
