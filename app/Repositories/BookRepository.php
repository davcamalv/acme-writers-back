<?php

namespace App\Repositories;

use App\Dtos\BookDto;
use App\Models\Book;
use App\Models\Writer;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class BookRepository {

    public function __construct(TickerRepository $tickerRepo){
        $this->tickerRepository = $tickerRepo;
    }

    public function getModel(){
        return new Book();
    }

    public function save(array $data){
        $this->validateDataToSave($data);
        $ticker = $this->tickerRepository->generateTicker();
        $book = new Book($data);
        $book->setAttribute('cancelled', false);
        $book->setAttribute('status', 'INDEPENDENT');
        $book->setAttribute('draft', true);
        $book->setAttribute('ticker_id', $ticker->id);

        $writer = auth()->user()->actor;
        $writer->books()->save($book);
        return $book;
    }

    private function validateDataToSave(array $data){
        $validator = Validator::make($data, ['title'=>'required', 'description' => 'required', 'language' => 'required', 'cover'=> 'url', 'genre' => 'required']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }
}
