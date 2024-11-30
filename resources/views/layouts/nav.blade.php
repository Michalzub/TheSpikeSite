<nav>
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
    </div>
</nav>
