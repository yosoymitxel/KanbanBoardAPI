<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Boards;
use Validator;
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
            'stage' => 'required|integer|in:1,2,3', // Validate stage is 1, 2 or 3
            'title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $board = Boards::create($request->all());

        return response()->json($board, 201); // Created status code
    }

    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'stage' => 'required|integer|in:1,2,3', // Validate stage is 1, 2 or 3
            'title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $board = Boards::findOrFail($id);

        $board->update($request->all());

        return response()->json($board, 200);
    }
}
