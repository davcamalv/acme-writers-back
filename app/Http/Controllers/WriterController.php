<?php

namespace App\Http\Controllers;

use App\Repositories\WriterRepository;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    protected $writerRepository;

    public function __construct(WriterRepository $writerRepo){
        $this->writerRepository = $writerRepo;
    }

    public function store(Request $request)
    {
        return json_encode($this->writerRepository->save($request->all()));
    }
}
