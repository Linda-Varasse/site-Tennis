<?php

namespace App\Controller;

abstract class AbstractController
{
    public function __construct()
    {
        // TODO Ajouter des fonctionnalitées universelles
        ob_start();
    }

    public function render(string $template, array $arguments = [])
    {
        extract($arguments);
        include 'views/' . $template;
        $content = ob_get_clean();
        include 'views/index.phtml';
        exit;
    }
}
