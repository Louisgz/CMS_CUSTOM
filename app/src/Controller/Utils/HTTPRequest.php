<?php

namespace App\Controller\Utils;

class HTTPRequest
{
  public function method()
  {
    return $_SERVER['REQUEST_METHOD'];
  }

  public function requestURI()
  {
    return $_SERVER['REQUEST_URI'];
  }
}