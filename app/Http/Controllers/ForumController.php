<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Vote;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $discussions = Discussion::query()
            ->orderBy('created_at', 'desc')
            ->paginate();

        foreach ($discussions as $discussion) {
            $upvotes = Vote::where('post_id', $discussion->id)->where('vote_type', true)->count();
            $downvotes = Vote::where('post_id', $discussion->id)->where('vote_type', false)->count();
            $discussion->net_votes = $upvotes - $downvotes;
        }
        return view('forum.index', ['discussions' => $discussions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forum.create-discussion');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:30'],
            'text' => ['required', 'string'],
        ]);

        $discussion = Discussion::create([
            'title' => $data['title'],
            'text' => $data['text'],
            'author_id' => auth()->id(),
        ]);

        return to_route('discussion.show', $discussion)->with('message', 'Discussion created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discussion $discussion)
    {

        return view('forum.discussion', ['discussion' => $discussion]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discussion $discussion)
    {
        if ($discussion->author_id !== auth()->id()) {
            abort(403, 'You are not authorized to delete this discussion.');
        }
        return view('forum.edit-discussion', ['discussion' => $discussion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discussion $discussion)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:30'],
            'text' => ['required', 'string'],
        ]);

        $discussion->update($data);

        return to_route('discussion.show', $discussion)->with('message', 'Discussion updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discussion $discussion)
    {
        if ($discussion->author_id !== auth()->id()) {
            abort(403, 'You are not authorized to delete this discussion.');
        }

        // Delete the discussion
        $discussion->delete();

        // Redirect to the forum index with a success message
        return redirect()->route('forum.index')->with('message', 'Discussion deleted successfully!');
    }

    public function vote(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'You must be logged in to vote.'], 401);
        }
        $validated = $request->validate([
            'post_id' => ['required','integer'],
            'post_type' => ['required','string'],
            'vote_type' => ['required','boolean'],
        ]);

        $userId = auth()->id();

        $existingVote = Vote::where('user_id', $userId)
            ->where('post_id', $validated['post_id'])
            ->where('post_type', $validated['post_type'])
            ->first();

        if ($existingVote) {
            if ($existingVote->vote_type == $validated['vote_type']) {
                $existingVote->delete();
            } else {
                $existingVote->update(['vote_type' => $validated['vote_type']]);
            }
        } else {
            Vote::create([
                'user_id' => $userId,
                'post_id' => $validated['post_id'],
                'post_type' => $validated['post_type'],
                'vote_type' => $validated['vote_type'],
            ]);
        }

        $upvotes = Vote::where('post_id', $validated['post_id'])
            ->where('post_type', $validated['post_type'])
            ->where('vote_type', true)
            ->count();

        $downvotes = Vote::where('post_id', $validated['post_id'])
            ->where('post_type', $validated['post_type'])
            ->where('vote_type', false)
            ->count();

        $netVotes = $upvotes - $downvotes;

        return response()->json(['netVotes' => $netVotes]);
    }

}
