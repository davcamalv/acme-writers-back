<?php

namespace App\Dtos;

final class BasicUserDto{

    public function __construct(?string $name, ?string $photo)
    {
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

}
