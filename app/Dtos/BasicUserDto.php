<?php

namespace App\Dtos;

final class BasicUserDto{

    public function __construct(?int $id, ?string $name, ?string $photo)
    {
        $this->id = $id;
        $this->name = $name;
        $this->photo = $photo;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of photo
     */
    public function getPhoto()
    {
            return $this->photo;
    }


    /**
     * Get the value of id
     */
    public function getId()
    {
            return $this->id;
    }
}
