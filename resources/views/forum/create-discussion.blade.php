<x-app-layout>
    <div class="home-container">
        <h1>Create new discussion</h1>
        <form action="{{ route('discussion.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input name="title" placeholder="Enter the title here" required>
            @error('title')
            <div class="error">{{ $message }}</div>
            @enderror

            <textarea name="text" rows="10" placeholder="Enter your text here" required></textarea>
            @error('text')
            <div class="error">{{ $message }}</div>
            @enderror
            <input type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/gif">
            <div class="note-buttons">
                <button class="cancel-btn" href="{{ route('forum.index') }}">Cancel</button>
                <button class="submit-btn" type="submit">Submit</button>
            </div>
        </form>

    </div>
</x-app-layout>
