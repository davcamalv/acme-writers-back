<?php

namespace App\Dtos;


final class BookSimpleDto{

    public function __construct(?int $id, ?string $title, ?bool $draft)
    {
        $this->id = $id;
        $this->title = $title;
        $this->draft = $draft;

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


        /**
         * Get the value of draft
         */
        public function getDraft()
        {
                return $this->draft;
        }
}
