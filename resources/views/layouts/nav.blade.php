<nav class="topbar">
    <div class="logo">The Spike Site</div>>
    <div class="nav-items">
        <a class="nav-item {{ Route::is('wiki.index') ? 'active' : '' }}" href = "{{ route('wiki.index') }}">Home</a>
        <a class="nav-item {{ Route::is('wiki.agents') ? 'active' : '' }}" href = "{{ route('wiki.agents') }}">Agents</a>
        <a class="nav-item {{ Route::is('wiki.maps') ? 'active' : '' }}" href = "{{ route('wiki.maps') }}">Maps</a>
        <a class="nav-item {{ Route::is('wiki.weapons') ? 'active' : '' }}" href = "{{ route('wiki.weapons') }}">Weapons</a>
        <a class="nav-item {{ Route::is('forum.index') ? 'active' : '' }}" href = "{{ route('forum.index') }}">Forum</a>
        @if(auth()->check())
            <a class="nav-item {{ Route::is('profile.show') ? 'active' : '' }}" href="{{ route('profile.show', Auth::user()->id) }}">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-item" :href="route('logout')"
                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>

        @else
            <a class="nav-item" href="{{route('login')}}">Login</a>
        @endif
    </div>
</nav>
