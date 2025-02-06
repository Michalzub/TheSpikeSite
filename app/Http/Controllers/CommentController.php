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
            'text' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->text = $request->input('text');
        $comment->author_id = auth()->id();
        $comment->discussion_id = $discussion->id;
        $comment->save();

        return response()->json([
            'success' => true,
            'comment' => $comment->load('author'),
            'current_user_id' => auth()->id()
        ]);
    }

    public function destroy(Comment $comment)
    {
        if (auth()->id() !== $comment->author_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
        }

        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    public function index(Discussion $discussion)
    {
        $comments = $discussion->comments()->with('author', 'children')->get();

        return view('discussion.show', compact('discussion', 'comments'));
    }

}
