<?php

namespace App\Http\Controllers;

use App\Repositories\OpinionRepository;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    protected $opinionRepository;

    public function __construct(OpinionRepository $opinionRepo){
        $this->opinionRepository = $opinionRepo;
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['reader']);
        $this->opinionRepository->save($request->all());
    }

    public function show(int $opinion_id)
    {
        return json_encode($this->opinionRepository->findOne($opinion_id));
    }

    public function listOpinionsOfBook(int $book_id)
    {
        return json_encode($this->opinionRepository->listOpinionsOfBook($book_id));
    }

    public function update(Request $request)
    {
        $request->user()->authorizeRoles(['reader']);
        $this->opinionRepository->update($request->all());
    }

    public function destroy(int $opinion_id, Request $request)
    {
        $request->user()->authorizeRoles(['reader']);
        $this->opinionRepository->delete($opinion_id);
    }

}
