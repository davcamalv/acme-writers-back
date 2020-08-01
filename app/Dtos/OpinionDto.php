<?php

namespace App\Dtos;

use DateTime;

final class OpinionDto{

    public function __construct(?int $id, ?bool $positive, ?string $review, ?string $date, ?int $book_id)
    {
        $this->id = $id;
        $this->positive = $positive;
        $this->review = $review;
        $this->date = $date;
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
         * Get the value of positive
         */
        public function getPositive()
        {
                return $this->positive;
        }

        /**
         * Get the value of review
         */
        public function getReview()
        {
                return $this->review;
        }

        /**
         * Get the value of date
         */
        public function getDate()
        {
                return $this->date;
        }

        /**
         * Get the value of book_id
         */
        public function getBook_id()
        {
                return $this->book_id;
        }
}
