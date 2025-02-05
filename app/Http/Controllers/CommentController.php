<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Discussion $discussion)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $comment = new Comment();
        $comment->text = $request->input('text');
        $comment->author_id = auth()->id();
        $comment->discussion_id = $discussion->id;
        $comment->parent_id = $request->input('parent_id');
        $comment->save();

        return response()->json([
            'success' => true,
            'comment' => $comment->load('author'),
        ]);
    }


    public function index(Discussion $discussion)
    {
        $comments = $discussion->comments()->with('author', 'children')->get();

        return view('discussion.show', compact('discussion', 'comments'));
    }

    public function loadReplies($commentId)
    {
        $comment = Comment::with('children.author')->findOrFail($commentId);

        return response()->json([
            'replies' => $comment->children->map(function ($reply) {
                return [
                    'id' => $reply->id,
                    'author' => $reply->author->name,
                    'text' => $reply->text,
                    'created_at' => $reply->created_at->format('M d, Y H:i')
                ];
            })
        ]);
    }



}
