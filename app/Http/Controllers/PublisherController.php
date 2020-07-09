<?php

namespace App\Http\Controllers;

use App\Repositories\PublisherRepository;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    protected $publisherRepository;

    public function __construct(PublisherRepository $publisherRepo){
        $this->publisherRepository = $publisherRepo;
    }

    public function store(Request $request)
    {
        return json_encode($this->publisherRepository->save($request->all()));
    }
}
