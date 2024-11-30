<x-app-layout>
    <div class="main-page">
        <div class="home-container">
            <h1>Home</h1>
            <div class="home-box">
                <img src="{{ asset("/tempImages/Valorant_logo_-_pink_color_version.png") }}" width="150" alt="Valorant logo">
                <p>
                    <span class="welcome-message"> Welcome to The Spike Site!</span> <br>
                    The Valorant encyclopedia for all your needs regarding valorant
                    <a class="link-word" href="{{ route('wiki.agents') }}">agents</a>,
                    <a class="link-word" href="{{ route('wiki.maps') }}">maps</a> and
                    <a class="link-word" href="{{ route('wiki.weapons') }}">weapons</a>.<br>
                    Valorant is a competitive character-based 5v5 tactical shooter.
                    Set in a near-future Earth,     you team up with 4 other players against 5 enemies in round-based combat with an agent of your choice.
                    Creativity is your greatest weapon.
                </p>
                <div class="search-bar">
                    <input type="text" class="search-input">
                    <button class="search-button">Search</button>
                </div>
            </div>
            <div class="home-box">
                <h2>Agents</h2>
                <div class="item-preview-grid">
                    <button class="icon-button" id="jett" onclick="window.location.href='agent-page.html'">
                        <span class="button-text">Jett</span>
                    </button>
                    <button class="icon-button" id="phoenix">Phoenix</button>
                    <button class="icon-button" id="viper">Viper</button>
                    <button class="icon-button" id="moreAgents" onclick="window.location.href='{{ route('wiki.agents') }}'">More</button>
                </div>
            </div>
            <div class="home-box">
                <h2>Maps</h2>
                <div class="item-preview-grid">
                    <button class="icon-button" id="haven">Haven</button>
                    <button class="icon-button" id="bind">Bind</button>
                    <button class="icon-button" id="split">Split</button>
                    <button class="icon-button" id="moreMaps" onclick="window.location.href='maps.html'">More</button>
                </div>
            </div>
            <div class="home-box">
                <h2>Weapons</h2>
                <div class="item-preview-grid">
                    <button class="icon-button" id="vandal">Vandal</button>
                    <button class="icon-button" id="phantom">Phantom</button>
                    <button class="icon-button" id="operator">Operator</button>
                    <button class="icon-button" id="moreWeapons" onclick="window.location.href='weapons.html'">More</button>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
