<?php

namespace App\Dtos;

final class RegisterReaderDto{

    public function __construct(int $id_user, string $name, string $email, string $address, string $phone_number)
    {
        $this->id_user = $id_user;
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
        $this->phone_number = $phone_number;
    }

    /**
     * Get the value of id_user
     */
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }



    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }


    /**
     * Get the value of phone_number
     */
    public function getPhone_number()
    {
        return $this->phone_number;
    }

}
