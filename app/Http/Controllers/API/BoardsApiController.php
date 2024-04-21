<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Boards;
use Illuminate\Http\Request;

class BoardsApiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Boards::all(); // Fetch all boards

        return response()->json($boards, 200); // Return boards data as JSON
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stage' => 'required|integer|unsigned',
            'title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $board = Boards::create($request->all());

        return response()->json($board, 201); // Created status code
    }

    public function update(Request $request, Board $board)
    {
        $validStage = [1, 2, 3]; // Allowed stage values
        if (!in_array($request->stage, $validStage)) {
            return response()->json([], 400);
        }

        $board->update($request->all());

        return response()->json($board, 200);
    }
}
