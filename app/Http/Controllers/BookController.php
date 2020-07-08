<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepo){
        $this->bookRepository = $bookRepo;
    }

    public function listMyBooks()
    {
        return json_encode($this->bookRepository->listMyBooks());
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['writer']);
        return json_encode($this->bookRepository->save($request->all()));
    }

    public function show(int $book_id)
    {
        return json_encode($this->bookRepository->findOne($book_id));
    }

    public function update(Request $request)
    {
        $request->user()->authorizeRoles(['writer']);
        return json_encode($this->bookRepository->update($request->all()));
    }

    public function changeStatus(Request $request)
    {
        $request->user()->authorizeRoles(['publisher']);
        return json_encode($this->bookRepository->changeStatus($request->all()));
    }

    public function changeDraft(int $book_id)
    {
        return json_encode($this->bookRepository->changeDraft($book_id));
    }

    public function destroy(int $book_id, Request $request)
    {
        $request->user()->authorizeRoles(['writer']);
        $this->bookRepository->delete($book_id);
    }
}
