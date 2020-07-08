<?php

namespace App\Repositories;

use App\Dtos\BookDto;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\User;
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
        $publisher = $book->publisher;
        $publisher_id = null;
        if($publisher != null){
            $publisher_id = $publisher->user()->id;
        }
        return new BookDto($book->id, $book->title, $book->description, $book->language, $book->cover, $book->draft, $book->ticker->identifier, $book->genre,
        $publisher_id,
        $book->writer->user->id);
    }

    public function findOne(int $book_id){
        $this->validateBook($book_id);
        $book = Book::find($book_id);
        $this->validateBookToShow($book);
        $publisher = $book->publisher;
        $publisher_id = null;
        if($publisher != null){
            $publisher_id = $publisher->user()->id;

        }
        return new BookDto($book->id, $book->title, $book->description, $book->language, $book->cover, $book->draft, $book->ticker->identifier, $book->genre,
        $publisher_id,
        $book->writer->user->id);
    }

    public function listMyBooks(){
        $list_of_books = [];
        $user = User::find(auth()->id());
        if($user->hasRole('writer')){
            $books = Book::where('writer_id', $user->actor->id)->get();
        }elseif($user->hasRole('publisher')){
            $books = Book::where('publisher_id', $user->actor->id)->where('draft', 0)->get();
        }else{
            $books = Book::where('reader_id', $user->actor->id)->where('draft', 0)->get();
        }
        foreach($books as $book){
            $publisher = $book->publisher;
            $publisher_id = null;
            if($publisher != null){
                $publisher_id = $publisher->user()->id;

            }
            $book_dto = new BookDto($book->id, $book->title, $book->description, $book->language, $book->cover, $book->draft, $book->ticker->identifier, $book->genre, $publisher_id, $book->writer->user->id);
            array_push($list_of_books, $book_dto);
        }
        return $list_of_books;
    }

    public function delete(int $book_id){
        $this->validateBook($book_id);
        $book = Book::find($book_id);
        $this->validateBookToDelete($book);
        Chapter::where('book_id', $book->id)->delete();
        $ticker = $book->ticker();
        $book->delete();
        $ticker->delete();
    }

    public function changeDraft(int $book_id){
        $this->validateBook($book_id);
        $book = Book::find($book_id);
        $this->validateBookToChangeDraft($book);
        $book->setAttribute('draft', 0);
        $book->save();
        $publisher = $book->publisher;
        $publisher_id = null;
        if($publisher != null){
            $publisher_id = $publisher->user()->id;
        }
        return new BookDto($book->id, $book->title, $book->description, $book->language, $book->cover, $book->draft, $book->ticker->identifier, $book->genre,
        $publisher_id,
        $book->writer->user->id);
    }

    public function changeStatus(array $data){
        $this->validateDataToChangeStatus($data);
        $this->validateBook($data['book_id']);
        $book = Book::find($data['book_id']);
        $this->validateBookToChangeStatus($book);
        $book->setAttribute('status', $data["status"]);
        $book->save();
        $publisher = $book->publisher;
        $publisher_id = null;
        if($publisher != null){
            $publisher_id = $publisher->user()->id;
        }
        return new BookDto($book->id, $book->title, $book->description, $book->language, $book->cover, $book->draft, $book->ticker->identifier, $book->genre,
        $publisher_id,
        $book->writer->user->id);
    }

    public function update(array $data){
        $this->validateDataToUpdate($data);
        $this->validateBook($data['book_id']);
        $book = Book::find($data['book_id']);
        $this->validateBookToUpdate($book);
        if(array_key_exists('publisher_id', $data)){
            $this->validatePublisher($data['publisher_id']);
            $book->setAttribute('status', 'PENDING');
            $book->setAttribute('publisher_id', User::find($data['publisher_id'])->actor->id);
        }else{
            $book->setAttribute('status', 'INDEPENDENT');
        }
        $book->fill(['title'=>$data['title'], 'description'=>$data['description'], 'language'=>$data['language'], 'cover'=>$data['cover'], 'genre'=>$data['genre']]);
        $book->save();
        $publisher = $book->publisher;
        $publisher_id = null;
        if($publisher != null){
            $publisher_id = $publisher->user->id;
        }
        return new BookDto($book->id, $book->title, $book->description, $book->language, $book->cover, $book->draft, $book->ticker->identifier, $book->genre,
        $publisher_id, $book->writer->user->id);
    }

    private function validateDataToSave(array $data){
        $validator = Validator::make($data, ['title'=>'required', 'description' => 'required', 'language' => 'required|in:EN,ES,IT,FR,DE,OTHER', 'cover'=> 'url', 'genre' => 'required|in:FANTASY,ADVENTURE,THRILLER,ROMANCE,MYSTERY']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }

    private function validateDataToChangeStatus(array $data){
        $validator = Validator::make($data, ['status' => 'required|in:REJECTED,ACCEPTED', 'book_id'=> 'required|numeric']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }

    private function validateDataToUpdate(array $data){
        $validator = Validator::make($data, ['book_id'=>'required|numeric', 'title'=>'required', 'description' => 'required', 'language' => 'required|in:EN,ES,IT,FR,DE,OTHER', 'cover'=> 'url', 'genre' => 'required|in:FANTASY,ADVENTURE,THRILLER,ROMANCE,MYSTERY']);

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
        }
    }

    private function validateBookToShow(Book $book){
        if(($book->draft) && ($book->writer != auth()->user()->actor)) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'You do not have permission to access the requested book'], 401));
        }
    }

    private function validateBookToDelete(Book $book){
        if($book->writer != auth()->user()->actor) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'You do not have permission to delete the requested book'], 401));
        }if(!$book->draft){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The book you want to delete is not in draft mode'], 401));
        }
    }

    private function validateBookToUpdate(Book $book){
        if($book->writer != auth()->user()->actor) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'You do not have permission to edit the requested book'], 401));
        }if(!$book->draft){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The requested book is in final mode'], 401));
        }
    }

    private function validateBookToChangeDraft(Book $book){
        if($book->writer != auth()->user()->actor) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'You do not have permission to edit the requested book'], 401));
        }if(!$book->draft){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The requested book is in final mode'], 401));
        }
    }

    private function validateBookToChangeStatus(Book $book){
        if($book->publisher != auth()->user()->actor) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'You do not have permission to change status of the requested book'], 401));
        }if($book->draft){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The requested book is in draft mode'], 401));
        }if($book->status != 'PENDING'){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The book must be pending to change status'], 401));
        }
    }

}
