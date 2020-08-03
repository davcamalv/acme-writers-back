<?php

namespace App\Dtos;


final class ChapterDto{

    public function __construct(?int $id, ?string $title, ?string $number, ?string $text, ?BookSimpleDto $book)
    {
        $this->id = $id;
        $this->title = $title;
        $this->number = $number;
        $this->text = $text;
        $this->book = $book;
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
        public function getBook()
        {
                return $this->book;
        }
}
