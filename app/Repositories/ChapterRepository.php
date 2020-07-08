<?php

namespace App\Repositories;

use App\Dtos\ChapterDto;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class ChapterRepository {

    public function getModel(){
        return new Chapter();
    }

    public function save(array $data){
        $this->validateDataToSave($data);
        $this->validateBook($data['book_id']);
        $chapter = new Chapter($data);
        $book = Book::find($data['book_id']);
        $book->chapters()->save($chapter);
        return new ChapterDto($chapter->id, $chapter->title, $chapter->number, $chapter->text, $book->id);
    }

    private function validateDataToSave(array $data){
        $validator = Validator::make($data, ['title'=>'required', 'number' => 'required|numeric', 'text' => 'required', 'book_id'=> 'required']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }

    private function validateBook(int $book_id){
        if (!(Book::where('id', $book_id)->exists())){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The book does not exist in the database'], 404));
        }
    }

}
