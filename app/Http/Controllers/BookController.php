<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepo){
        $this->BookRepository = $bookRepo;
    }

    public function listMyBooks()
    {
        return json_encode($this->BookRepository->listMyBooks());
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['writer']);
        return json_encode($this->BookRepository->save($request->all()));
    }

    public function show(int $book_id)
    {
        return json_encode($this->BookRepository->findOne($book_id));
    }

    public function update(Request $request, Book $book)
    {
        //
    }

    public function changeDraft(int $book_id)
    {
        return json_encode($this->BookRepository->changeDraft($book_id));
    }

    public function destroy(int $book_id, Request $request)
    {
        $request->user()->authorizeRoles(['writer']);
        $this->BookRepository->delete($book_id);
    }
}
