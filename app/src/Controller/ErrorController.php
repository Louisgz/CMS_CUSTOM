<?php

namespace App\Controller;

class ErrorController extends BaseController
{
  public function getError404()
  {
    $this->render(
      '404.php',
      [],
      'Mauvaise Route'
    );
  }
}