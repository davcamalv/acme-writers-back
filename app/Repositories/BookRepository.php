<?php

namespace App\Repositories;

use App\Dtos\BookDto;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\User;
use App\Models\Opinion;
use App\Models\Ticker;
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

    public function findOne(int $book_id){
        $this->validateBook($book_id);
        $book = Book::find($book_id);
        $publisher = $book->publisher;
        $publisher_id = null;
        if($publisher != null){
            $publisher_id = $publisher->id;
        }
        return new BookDto($book->id, $book->title, $book->description, $book->language, $book->cover, $book->draft, $book->ticker->identifier, $book->genre,
        $publisher_id,
        $book->writer->id);
    }

    public function delete(int $book_id){
        $this->validateDelete($book_id);
        $book = Book::find($book_id);
        Chapter::where('book_id', $book->id)->delete();
        $ticker = $book->ticker();
        $book->delete();
        $ticker->delete();
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

    private function validateBook(int $book_id){
        if (!(Book::where('id', $book_id)->exists())){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The book does not exist in the database'], 404));
        }else{
            $book = Book::find($book_id);
            if(($book->draft) && ($book->writer != auth()->user()->actor)) {
                throw new HttpResponseException(response()->json(['success' => false,
                'message' => 'You do not have permission to access the requested book'], 401));
         }
        }
    }

    private function validateDelete(int $book_id){
        if (!(Book::where('id', $book_id)->exists())){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The book does not exist in the database'], 404));
        }else{
            $book = Book::find($book_id);
            if($book->writer != auth()->user()->actor) {
                throw new HttpResponseException(response()->json(['success' => false,
                'message' => 'You do not have permission to delete the requested book'], 401));
            }if(!$book->draft){
                throw new HttpResponseException(response()->json(['success' => false,
                'message' => 'The book you want to delete is not in draft mode'], 401));
            }
        }
    }
}
