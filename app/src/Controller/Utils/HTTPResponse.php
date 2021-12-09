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

  public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = false)
  {
    setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
  }

  public function setCacheHeader(int $seconds = 0)
  {
    $timestamp = time() + $seconds;
    $date = new \dateTime();
    $date->setTimestamp($timestamp);

    $this->addHeader('Cache-Control: public, max-age=' . $seconds);
    $this->addHeader('Expires: ' . $date->format('D, j M Y H:i:s' . 'GMT'));
  }
}