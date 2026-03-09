<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // GET /comments — return all comments, newest first
    public function index()
    {
        $comments = Comment::latest()->get(['id', 'body', 'created_at']);
        return response()->json($comments);
    }

    // POST /comments — store a new comment
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $comment = Comment::create([
            'body' => $request->input('body'),
        ]);

        return response()->json([
            'success' => true,
            'comment' => [
                'id'         => $comment->id,
                'body'       => $comment->body,
                'created_at' => $comment->created_at,
            ],
        ], 201);
    }
}
