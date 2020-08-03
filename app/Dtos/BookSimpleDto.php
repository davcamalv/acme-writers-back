<?php

namespace App\Dtos;


final class BookSimpleDto{

    public function __construct(?int $id, ?string $title)
    {
        $this->id = $id;
        $this->title = $title;

    }


        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Get the value of title
         */
        public function getTitle()
        {
                return $this->title;
        }

}
