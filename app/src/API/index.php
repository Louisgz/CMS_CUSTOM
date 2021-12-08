<?php

namespace App\API;

use App\Manager\AuthorManager;
use App\Fram\Factories\PDOFactory;

$authorManager = new AuthorManager(PDOFactory::getMysqlConnection());

echo $this->params;

$user = $authorManager->checkCredential($_POST['username'], $_POST['passord']);