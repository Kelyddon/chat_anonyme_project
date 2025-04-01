<?php

namespace App\models;

class Room extends AbstractModel{
    private $id;
    private $name;

    public function __construct(string $name){
        $this->name = $name;
        echo "Objet Room créé avec le nom : " . htmlspecialchars($name);
    }

    public function getName(): string{
        return $this->name;
    }
}
