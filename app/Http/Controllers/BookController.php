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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listMyBooks()
    {
        return json_encode($this->BookRepository->listMyBooks());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['writer']);
        return json_encode($this->BookRepository->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $$book
     * @return \Illuminate\Http\Response
     */
    public function show(int $book_id)
    {
        return json_encode($this->BookRepository->findOne($book_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $$book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $$book
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $book_id, Request $request)
    {
        $request->user()->authorizeRoles(['writer']);
        $this->BookRepository->delete($book_id);
    }
}
