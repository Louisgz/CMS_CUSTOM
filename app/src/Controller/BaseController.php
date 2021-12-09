<?php

namespace App\Controller;

use App\Controller\Utils\HTTPRequest;
use App\Controller\Utils\HTTPResponse;

abstract class BaseController
{
    private $templateFile = __DIR__ . './../Views/template.php';
    private $viewsDir = __DIR__ . './../Views/Frontend/';
    protected $params;

    public function __construct(string $action, string $method, array $params = [])
    {
        $this->HTTPRequest = new HTTPRequest();
        $this->HTTPResponse = new HTTPResponse();
        $this->params = $params;

        $method = strtolower($method) . ucfirst($action);
        if (is_callable([$this, $method])) {
            $this->$method();
        }
    }

    public function render(string $template, array $arguments, string $title)
    {
        $view = $this->viewsDir . $template;

        foreach ($arguments as $key => $value) {
            ${$key} = $value;
        }


        ob_start();
        require $view;
        $content = ob_get_clean();
        require $this->templateFile;
        exit;
    }
}