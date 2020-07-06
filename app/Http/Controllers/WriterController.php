<?php

namespace App\Http\Controllers;

use App\Dtos\RegisterWriterDto;
use App\Http\Requests\RegisterWriterRequest;
use App\Repositories\WriterRepository;
use Illuminate\Http\Request;
use App\Models\Writer;

class WriterController extends Controller
{
    protected $writerRepository;

    public function __construct(WriterRepository $writerRepo){
        $this->writerRepository = $writerRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return json_encode($this->writerRepository->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Writer $writer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Writer $writer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Writer $writer)
    {
        //
    }
}
