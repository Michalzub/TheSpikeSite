<nav class="topbar">
    <div class="logo">The Spike Site</div>
    <button class="menu-button" id="menu-btn" aria-label="Toggle Menu">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </button>
    <div class="nav-items">
        <a class="nav-item {{ Route::is('wiki.index') ? 'active' : '' }}" href = "{{ route('wiki.index') }}">Home</a>
        <a class="nav-item {{ Route::is('wiki.agents') ? 'active' : '' }}" href = "{{ route('wiki.agents') }}">Agents</a>
        <a class="nav-item {{ Route::is('wiki.maps') ? 'active' : '' }}" href = "{{ route('wiki.maps') }}">Maps</a>
        <a class="nav-item {{ Route::is('wiki.weapons') ? 'active' : '' }}" href = "{{ route('wiki.weapons') }}">Weapons</a>
        <a class="nav-item {{ Route::is('forum.index') ? 'active' : '' }}" href = "{{ route('forum.index') }}">Forum</a>
        <a class="nav-item {{ Route::is('profile.edit') ? 'active' : '' }}" href = "{{ route('profile.edit') }}">Profile</a>
        @if(auth()->check())
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
