<?php

namespace App\Dtos;


final class BookDto{

    public function __construct(?int $id, ?string $title, ?string $description, ?string $language, ?string $cover, ?bool $draft, ?string $identifier, ?string $genre, ?BasicUserDto $publisher, ?BasicUserDto $writer, ?array $readers, ?string $status)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->language = $language;
        $this->cover = $cover;
        $this->draft = $draft;
        $this->identifier = $identifier;
        $this->genre = $genre;
        $this->publisher = $publisher;
        $this->writer = $writer;
        $this->readers = $readers;
        $this->status = $status;
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
         * Get the value of description
         */
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Get the value of language
         */
        public function getLanguage()
        {
                return $this->language;
        }

        /**
         * Get the value of cover
         */
        public function getCover()
        {
                return $this->cover;
        }

        /**
         * Get the value of draft
         */
        public function getDraft()
        {
                return $this->draft;
        }

        /**
         * Get the value of identifier
         */
        public function getIdentifier()
        {
                return $this->identifier;
        }

        /**
         * Get the value of genre
         */
        public function getGenre()
        {
                return $this->genre;
        }

        /**
         * Get the value of publisher_id
         */
        public function getPublisher()
        {
                return $this->publisher;
        }

        /**
         * Get the value of writer_id
         */
        public function getWriter()
        {
                return $this->writer;
        }

        /**
         * Get the value of readers
         */
        public function getReaders()
        {
                return $this->readers;
        }

        /**
         * Get the value of status
         */
        public function getStatus()
        {
                return $this->status;
        }
}
