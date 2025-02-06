<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Vote;
use Illuminate\Http\Request;

class ForumController extends Controller
{
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

    public function create()
    {
        return view('forum.create-discussion');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:30'],
            'text' => ['required', 'string'],
            'image' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:2048'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $discussion = Discussion::create([
            'title' => $data['title'],
            'text' => $data['text'],
            'image' => $imagePath,
            'author_id' => auth()->id(),
        ]);

        return to_route('discussion.show', $discussion)->with('message', 'Discussion created successfully.');
    }

    public function show(Discussion $discussion)
    {

        return view('forum.discussion', ['discussion' => $discussion]);
    }

    public function edit(Discussion $discussion)
    {
        if ($discussion->author_id !== auth()->id()) {
            abort(403, 'You are not authorized to delete this discussion.');
        }
        return view('forum.edit-discussion', ['discussion' => $discussion]);
    }

    public function update(Request $request, Discussion $discussion)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:30'],
            'text' => ['required', 'string'],
            'image' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:2048'],
        ]);

        $discussion->update($data);

        return to_route('discussion.show', $discussion)->with('message', 'Discussion updated successfully.');
    }

    public function destroy(Discussion $discussion)
    {
        if ($discussion->author_id !== auth()->id()) {
            abort(403, 'You are not authorized to delete this discussion.');
        }

        $discussion->delete();

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
