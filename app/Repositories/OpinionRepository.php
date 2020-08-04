<?php

namespace App\Repositories;

use App\Dtos\BasicUserDto;
use App\Dtos\OpinionDto;
use App\Models\Book;
use App\Models\Opinion;
use DateTime;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class OpinionRepository {

    public function getModel(){
        return new Opinion();
    }

    public function save(array $data){
        $this->validateDataToSave($data);
        $this->validateBook($data['book_id']);
        $reader = auth()->user()->actor;
        $opinion = new Opinion($data);
        $opinion->setAttribute('date', new DateTime());
        $opinion->setAttribute('reader_id', $reader->id);

        $book = Book::find($data['book_id']);
        $book->opinions()->save($opinion);
        return new OpinionDto($opinion->id, $opinion->positive, $opinion->review, $opinion->date, $book->id, new BasicUserDto($reader->id, $reader->name, $reader->photo));
    }

    public function findOne(int $opinion_id){
        $this->validateOpinion($opinion_id);
        $opinion = Opinion::find($opinion_id);
        $book = $opinion->book;
        $this->validateBookToShow($book);
        return new OpinionDto($opinion->id, $opinion->positive, $opinion->review, $opinion->date, $book->id, new BasicUserDto($opinion->reader->user->id, $opinion->reader->user->name, $opinion->reader->user->photo));

    }

    public function listOpinionsOfBook(int $book_id){
        $this->validateBook($book_id);
        $book = Book::find($book_id);
        $this->validateBookToShow($book);
        $list_of_opinions = [];
        $opinions = $book->opinions;
        foreach($opinions as $opinion){
            $opinion_dto = new OpinionDto($opinion->id, $opinion->positive, $opinion->review, $opinion->date, $opinion->book->id, new BasicUserDto($opinion->reader->user->id, $opinion->reader->user->name, $opinion->reader->user->photo));
            array_push($list_of_opinions, $opinion_dto);
        }
        return $list_of_opinions;
    }

    public function update(array $data){
        $this->validateDataToUpdate($data);
        $this->validateOpinion($data['opinion_id']);
        $opinion = Opinion::find($data['opinion_id']);
        $this->validateOpinionToUpdate($opinion);
        $opinion->fill(['positive'=>$data['positive'], 'review'=>$data['review']]);
        $opinion->save();
        return new OpinionDto($opinion->id, $opinion->positive, $opinion->review, $opinion->date, $opinion->book->id, new BasicUserDto($opinion->reader->user->id, $opinion->reader->user->name, $opinion->reader->user->photo));
    }

    public function delete(int $opinion_id){
        $this->validateOpinion($opinion_id);
        $opinion = Opinion::find($opinion_id);
        $this->validateOpinionToDelete($opinion);
        $opinion->delete();
    }

    private function validateOpinionToDelete(Opinion $opinion){
        if($opinion->reader != auth()->user()->actor) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'You do not have permission to delete the requested opinion'], 401));
        }
    }

    private function validateOpinionToUpdate(Opinion $opinion){
        if($opinion->reader != auth()->user()->actor) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'You do not have permission to edit the requested opinion'], 401));
        }if($opinion->book->draft){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The opinion book that you want to update is not in final mode'], 401));
        }
    }

    private function validateDataToUpdate(array $data){
        $validator = Validator::make($data, ['positive'=>'required|boolean', 'review' => 'required', 'opinion_id'=> 'required|numeric']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }

    private function validateBookToShow(Book $book){
        if($book->draft) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'You do not have permission to access the requested book'], 401));
        }
    }

    private function validateDataToSave(array $data){
        $validator = Validator::make($data, ['positive'=>'required|boolean', 'review' => 'required', 'book_id'=> 'required|numeric']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }

    private function validateBook(int $book_id){
        if (!(Book::where('id', $book_id)->exists())){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The book does not exist in the database'], 404));
        }if(Book::where('id', $book_id)->first()->draft) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'You do not have permission to access the requested book'], 401));
        }
    }

    private function validateOpinion(int $opinion_id){
        if (!(Opinion::where('id', $opinion_id)->exists())){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The opinion does not exist in the database'], 404));
        }
    }

}
