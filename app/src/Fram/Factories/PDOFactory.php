<?php

namespace App\Fram\Factories;

use FFI\Exception;
use PDO;

class PDOFactory
{
  public static function getMysqlConnection()
  {
    try {
      return new PDO('mysql:host=db;dbname=cms-custom', 'root', 'example');
    } catch (Exception $e) {
      echo $e;
    }
  }
}