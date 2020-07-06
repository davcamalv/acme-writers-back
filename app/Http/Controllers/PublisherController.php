<?php

namespace App\Http\Controllers;

use App\Repositories\PublisherRepository;
use Illuminate\Http\Request;
use App\Models\Publisher;

class PublisherController extends Controller
{
    protected $publisherRepository;

    public function __construct(PublisherRepository $publisherRepo){
        $this->publisherRepository = $publisherRepo;
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
        return json_encode($this->publisherRepository->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publisher  $$publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publisher  $$publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $$publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        //
    }
}
