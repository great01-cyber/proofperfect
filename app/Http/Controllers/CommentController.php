<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'comment' => $request->comment,
        ]);

        return response()->json(['success' => true]);
    }

    public function index()
    {
        // return latest comments
        return Comment::latest()->get();
    }
}
