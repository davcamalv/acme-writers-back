<?php

namespace App\Http\Controllers;

use App\Repositories\ChapterRepository;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    protected $chapterRepository;

    public function __construct(ChapterRepository $chapterRepo){
        $this->chapterRepository = $chapterRepo;
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['writer']);
        return json_encode($this->chapterRepository->save($request->all()));
    }

}
