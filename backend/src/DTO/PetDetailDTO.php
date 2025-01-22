<?php

namespace App\DTO;

class PetDetailDTO {
    private $id;
    private $name;
    private $age;
    private $breed;
    private $ownerName;

    public function __construct($id, $name, $age, $breed, $ownerName) {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->breed = $breed;
        $this->ownerName = $ownerName;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getBreed() {
        return $this->breed;
    }

    public function getOwnerName() {
        return $this->ownerName;
    }

    // Add other getter methods as needed
}
