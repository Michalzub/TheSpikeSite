<x-app-layout>
    <div class="home-container">
        <div>
            <h2>{{ $discussion['title'] }}</h2>
            @if($discussion->image)
                <img src="{{ asset('storage/' . $discussion->image) }}" alt="Uploaded Image">
            @endif
            {{ $discussion['text'] }}
        </div>
        <hr>

        <h3>Add a Comment</h3>
        <form id="comment-form" action="{{ route('comments.store', $discussion->id) }}" method="POST">
            @csrf
            <textarea name="text" rows="3" placeholder="Write your comment..." required></textarea>
            <button type="submit">Post Comment</button>
        </form>

        <hr>

        <div id="comments-list">
            @foreach($discussion->comments->whereNull('parent_id') as $comment)
                <div class="comment-box" id="comment-{{ $comment->id }}">
                    <strong>{{ $comment->author->name }}</strong>
                    <p>{{ $comment->text }}</p>
                    <small>Posted on {{ $comment->created_at->format('M d, Y H:i') }}</small>

                    <button class="reply-btn" id="reply-btn-{{ $comment->id }}">Reply</button>

                    <div id="reply-form-{{ $comment->id }}" class="reply-form" style="display: none;">
                        <button type="button" class="close-btn" id="close-btn-{{ $comment->id }}">X</button>
                        <form action="/comments/store" method="POST">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <textarea name="text" rows="3" placeholder="Write your reply..." required></textarea>
                            <button type="submit">Reply</button>
                        </form>
                    </div>

                    @if($comment->children->count() > 0)
                        <button class="load-replies-btn" id="load-replies-btn-{{ $comment->id }}">Show Replies</button>
                    @endif

                    <div id="replies-container-{{ $comment->id }}" class="replies-container" style="display: none;"></div>
                </div>
            @endforeach
        </div>
        <hr>
    </div>
</x-app-layout>
