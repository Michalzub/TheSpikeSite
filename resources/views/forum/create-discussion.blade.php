<x-app-layout>
    <div class="home-container">
        <h1>Create new discussion</h1>
        <form action="{{ route('discussion.store') }}" method="POST" class="">
            @csrf
            <input name="title" placeholder="Enter the title here" required>
            @error('title')
            <div class="error">{{ $message }}</div>
            @enderror
            <textarea name="text" rows="10" class="" placeholder="Enter your text here" required></textarea>
            @error('text')
            <div class="error">{{ $message }}</div>
            @enderror
            <div class="note-buttons">
                <a href="{{ route('forum.index') }}" class="">Cancel</a>
                <button class="">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
