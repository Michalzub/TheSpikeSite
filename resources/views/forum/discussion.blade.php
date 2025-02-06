<x-app-layout>
    <div class="home-container">
        <h2 class="discussion-title">{{ $discussion['title'] }}</h2>
        @if($discussion->image)
            <img class="discussion-img" src="{{ asset('storage/' . $discussion->image) }}" alt="Uploaded Image">
        @endif
        <p class="discussion-text">{{ $discussion['text'] }}</p>
        <hr>

        <h3>Add a Comment</h3>
        <form class="comment-form" id="comment-form" action="{{ route('comments.store', $discussion->id) }}" method="POST">
            @csrf
            <textarea name="text" rows="3" placeholder="Write your comment..." required></textarea>
            <button type="submit">Post Comment</button>
        </form>

        <hr>

        <div id="comments-list">
            @foreach($discussion->comments->sortByDesc('created_at') as $comment)
                <div class="comment-box" id="comment-{{ $comment->id }}">
                    <strong>{{ $comment->author->name }}</strong>
                    <p>{{ $comment->text }}</p>
                    <small>Posted on {{ $comment->created_at->format('j. n. Y H:i:s') }}</small>

                    @if(auth()->id() == $comment->author_id || (auth()->check() && auth()->user()->role === 'admin'))
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="delete-comment-form">
                            @csrf
                            @method('DELETE')
                            <button class="submit-btn" type="submit" class="discussion-preview-edit-action">Delete</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
        <hr>
    </div>
</x-app-layout>
