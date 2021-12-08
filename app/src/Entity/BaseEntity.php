<?php

namespace App\Entity;

class BaseEntity
{
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    //Hydratation 
    private function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }
}