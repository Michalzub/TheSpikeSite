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
                    Set in a near-future Earth, you team up with 4 other players against 5 enemies in round-based combat with an agent of your choice.
                    Creativity is your greatest weapon.
                </p>
            </div>
            <div class="home-box">
                <h2>Agents</h2>
                <div class="item-preview-grid">
                    <button class="icon-button" id="jett" onclick="window.location.href='/agents/Jett'">
                        <img class="button-image" src="https://media.valorant-api.com/agents/add6443a-41bd-e414-f6ad-e58d267f4e95/displayicon.png" alt="jett">
                        <span class="button-text">Jett</span>
                    </button>
                    <button class="icon-button" id="phoenix" onclick="window.location.href='/agents/Phoenix'">
                        <img class="button-image" src="https://media.valorant-api.com/agents/eb93336a-449b-9c1b-0a54-a891f7921d69/displayicon.png" alt="phoenix">
                        <span class="button-text">Phoenix</span>
                    </button>
                    <button class="icon-button" id="viper" onclick="window.location.href='/agents/Viper'">
                        <img class="button-image" src="https://media.valorant-api.com/agents/707eab51-4836-f488-046a-cda6bf494859/displayicon.png" alt="viper">
                        <span class="button-text">Viper</span>
                    </button>
                    <button class="icon-button" id="moreAgents" onclick="window.location.href='{{ route('wiki.agents') }}'">
                        <span class="button-text">More Agents</span>
                    </button>
                </div>
            </div>
            <div class="home-box">
                <h2>Maps</h2>
                <div class="item-preview-grid">
                    <button class="icon-button" id="haven" onclick="window.location.href='/maps/Haven'">
                        <img class="button-image" src="https://media.valorant-api.com/maps/2bee0dc9-4ffe-519b-1cbd-7fbe763a6047/splash.png" alt="Haven">
                        <span class="button-text">Haven</span>
                    </button>
                    <button class="icon-button" id="bind" onclick="window.location.href='/maps/Bind'">
                        <img class="button-image" src="https://media.valorant-api.com/maps/2c9d57ec-4431-9c5e-2939-8f9ef6dd5cba/splash.png" alt="Bind">
                        <span class="button-text">Bind</span>
                    </button>
                    <button class="icon-button" id="split" onclick="window.location.href='/maps/Split'">
                        <img class="button-image" src="https://media.valorant-api.com/maps/d960549e-485c-e861-8d71-aa9d1aed12a2/splash.png" alt="Split">
                        <span class="button-text">Split</span>
                    </button>
                    <button class="icon-button" id="moreMaps" onclick="window.location.href='{{ route('wiki.maps') }}'">
                        <span class="button-text">More Maps</span>
                    </button>
                </div>
            </div>
            <div class="home-box">
                <h2>Weapons</h2>
                <div class="item-preview-grid">
                    <button class="icon-button" id="vandal" onclick="window.location.href='/weapons/Vandal'">
                        <img class="button-image button-image-weapon" src="https://media.valorant-api.com/weapons/9c82e19d-4575-0200-1a81-3eacf00cf872/displayicon.png" alt="Vandal">
                        <span class="button-text">Vandal</span>
                    </button>
                    <button class="icon-button" id="phantom" onclick="window.location.href='/weapons/Phantom'">
                        <img class="button-image button-image-weapon" src="https://media.valorant-api.com/weapons/ee8e8d15-496b-07ac-e5f6-8fae5d4c7b1a/displayicon.png" alt="Phantom">
                        <span class="button-text">Phantom</span>
                    </button>
                    <button class="icon-button" id="operator" onclick="window.location.href='/weapons/Operator'">
                        <img class="button-image button-image-weapon" src="https://media.valorant-api.com/weapons/a03b24d3-4319-996d-0f8c-94bbfba1dfc7/displayicon.png" alt="Operator">
                        <span class="button-text">Operator</span>
                    </button>
                    <button class="icon-button" id="moreWeapons" onclick="window.location.href='{{ route('wiki.weapons') }}'">
                        <span class="button-text">More Weapons</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
