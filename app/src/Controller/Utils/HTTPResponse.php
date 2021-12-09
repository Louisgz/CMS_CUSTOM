<?php

namespace App\Controller\Utils;

class HTTPResponse
{
  public function addHeader($header)
  {
    header($header);
  }

  public function redirect($location, int $code = 0, bool $replace = true)
  {
    header('Location: ' . $location, $replace, $code);
  }

  public function unauthorized(array $messages): void
  {
    $this->addHeader('WWW-Authenticate: Basic realm="This area needs authentification"');
    $this->addHeader('HTTP/1.0 401 Unauthorized');
    exit(json_encode($messages, JSON_PRETTY_PRINT));
  }
}