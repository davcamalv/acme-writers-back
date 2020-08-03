<?php

namespace App\Repositories;

use App\Dtos\BookSimpleDto;
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
        return new ChapterDto($chapter->id, $chapter->title, $chapter->number, $chapter->text, new BookSimpleDto($book->id, $book->title));
    }

    public function findOne(int $chapter_id){
        $this->validateChapter($chapter_id);
        $chapter = Chapter::find($chapter_id);
        $book = $chapter->book;
        $this->validateBookToShow($book);
        return new ChapterDto($chapter->id, $chapter->title, $chapter->number, $chapter->text, new BookSimpleDto($book->id, $book->title));

    }

    public function listChaptersOfBook(int $book_id){
        $this->validateBook($book_id);
        $book = Book::find($book_id);
        $this->validateBookToShow($book);
        $list_of_chapters = [];
        $chapters = $book->chapters;
        foreach($chapters as $chapter){
            $chapter_dto = new ChapterDto($chapter->id, $chapter->title, $chapter->number, $chapter->text, new BookSimpleDto($book->id, $book->title));
            array_push($list_of_chapters, $chapter_dto);
        }
        return $list_of_chapters;
    }

    public function update(array $data){
        $this->validateDataToUpdate($data);
        $this->validateChapter($data['chapter_id']);
        $chapter = Chapter::find($data['chapter_id']);
        $this->validateChapterToUpdate($chapter);
        $chapter->fill(['title'=>$data['title'], 'text'=>$data['text'], 'number'=>$data['number']]);
        $chapter->save();
        return new ChapterDto($chapter->id, $chapter->title, $chapter->number, $chapter->text,new BookSimpleDto($chapter->book->id, $chapter->book->title));

    }

    public function delete(int $chapter_id){
        $this->validateChapter($chapter_id);
        $chapter = Chapter::find($chapter_id);
        $this->validateChapterToDelete($chapter);
        $chapter->delete();
    }

    private function validateChapterToDelete(Chapter $chapter){
        if($chapter->book->writer != auth()->user()->actor) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'You do not have permission to delete the requested chapter'], 401));
        }if(!$chapter->book->draft){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The chapter book that you want to delete is not in draft mode'], 401));
        }
    }

    private function validateChapterToUpdate(Chapter $chapter){
        if($chapter->book->writer != auth()->user()->actor) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'You do not have permission to edit the requested chapter'], 401));
        }if(!$chapter->book->draft){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The chapter book that you want to update is not in draft mode'], 401));
        }
    }

    private function validateDataToUpdate(array $data){
        $validator = Validator::make($data, ['chapter_id'=>'required|numeric', 'title'=>'required', 'number' => 'required|numeric', 'text' => 'required']);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'Wrong validation', 'errors' => $validator->errors()], 422));
        }
    }

    private function validateBookToShow(Book $book){
        if(($book->draft) && ($book->writer != auth()->user()->actor)) {
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'You do not have permission to access the requested book'], 401));
        }
    }

    private function validateDataToSave(array $data){
        $validator = Validator::make($data, ['title'=>'required', 'number' => 'required|numeric', 'text' => 'required', 'book_id'=> 'required|numeric']);

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

    private function validateChapter(int $chapter_id){
        if (!(Chapter::where('id', $chapter_id)->exists())){
            throw new HttpResponseException(response()->json(['success' => false,
            'message' => 'The chapter does not exist in the database'], 404));
        }
    }

}
