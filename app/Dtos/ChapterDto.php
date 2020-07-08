<?php

namespace App\Dtos;


final class ChapterDto{

    public function __construct(?int $id, ?string $title, ?string $number, ?string $text, ?string $book_id)
    {
        $this->id = $id;
        $this->title = $title;
        $this->number = $number;
        $this->text = $text;
        $this->book_id = $book_id;
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
         * Get the value of number
         */
        public function getNumber()
        {
                return $this->number;
        }

        /**
         * Get the value of text
         */
        public function getText()
        {
                return $this->text;
        }

        /**
         * Get the value of book_id
         */
        public function getBook_id()
        {
                return $this->book_id;
        }
}
