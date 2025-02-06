<x-app-layout>
    <div class="home-container">
        <h1 class="">Edit your post</h1>
        <form action="{{ route('discussion.update', $discussion) }}" method="POST" class="">
            @csrf
            @method('PUT')
            <input name="title" placeholder="Enter the title here" value="{{ $discussion->title }}" required="">
            @error('title')
            <div class="error">{{ $message }}</div>
            @enderror
            <textarea name="text" rows="10" class="" placeholder="Enter your text here" required="">{{ $discussion->text }}</textarea>
            @error('text')
            <div class="error">{{ $message }}</div>
            @enderror
            <div class="">
                <a class="cancel-btn" href="{{ route('forum.index') }}">Cancel</a>
                <button class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
