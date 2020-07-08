<?php

namespace App\Dtos;

final class CreditCardDto{

    public function __construct(?int $id, ?string $holder, ?string $make, ?string $number, ?int $expiration_month, ?int $expiration_year, ?int $cvv)
    {
        $this->id = $id;
        $this->holder = $holder;
        $this->make = $make;
        $this->number = $number;
        $this->expiration_month = $expiration_month;
        $this->expiration_year = $expiration_year;
        $this->cvv = $cvv;
    }

        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Get the value of holder
         */
        public function getHolder()
        {
                return $this->holder;
        }

        /**
         * Get the value of make
         */
        public function getMake()
        {
                return $this->make;
        }

        /**
         * Get the value of number
         */
        public function getNumber()
        {
                return $this->number;
        }

        /**
         * Get the value of expiration_month
         */
        public function getExpiration_month()
        {
                return $this->expiration_month;
        }

        /**
         * Get the value of expiration_year
         */
        public function getExpiration_year()
        {
                return $this->expiration_year;
        }

        /**
         * Get the value of cvv
         */
        public function getCvv()
        {
                return $this->cvv;
        }
}
