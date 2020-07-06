<?php

namespace App\Http\Controllers;

use App\Repositories\ReaderRepository;
use Illuminate\Http\Request;
use App\Models\Reader;

class ReaderController extends Controller
{
    protected $readerRepository;

    public function __construct(ReaderRepository $readerRepo){
        $this->readerRepository = $readerRepo;
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
        return json_encode($this->readerRepository->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reader  $$reader
     * @return \Illuminate\Http\Response
     */
    public function show(Reader $reader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reader  $$reader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reader $reader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reader  $$reader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reader $reader)
    {
        //
    }
}
