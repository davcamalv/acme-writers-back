<?php

namespace App\Repositories;

use App\Dtos\BookDto;
use App\Models\Book;
use App\Models\User;
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
        if(array_key_exists('publisher_id', $data)){
            $this->validatePublisher($data['publisher_id']);
            $book->setAttribute('status', 'PENDING');
            $book->setAttribute('publisher_id', User::find($data['publisher_id'])->actor->id);
        }else{
            $book->setAttribute('status', 'INDEPENDENT');
        }
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

    private function validatePublisher(int $publisher_id){
        if (!(User::where('id', $publisher_id)->exists())){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The publisher does not exist in the database'], 404));
        }else{
            $publisher = User::find($publisher_id);
            if(!($publisher->hasRole('publisher'))) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The id provided does not belong to a publisher'], 400));
         }
        }
    }
}
