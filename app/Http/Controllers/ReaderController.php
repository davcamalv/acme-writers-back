<?php

namespace App\Http\Controllers;

use App\Repositories\ReaderRepository;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    protected $readerRepository;

    public function __construct(ReaderRepository $readerRepo){
        $this->readerRepository = $readerRepo;
    }

    public function store(Request $request)
    {
        return json_encode($this->readerRepository->save($request->all()));
    }
}
