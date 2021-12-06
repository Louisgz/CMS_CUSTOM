<?php

namespace App\Manager;

abstract class BaseManager
{
    protected $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }
}