<?php


class View
{
    public function render($title, $action, $vars = [])
    {
        extract($vars);
        ob_start();
        require 'view/' . $action . '.php';
        $content = ob_get_clean();
        require 'view/layout.php';

    }
}