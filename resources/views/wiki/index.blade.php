<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Spike Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("/../css/style.css") }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<nav>
    <div class="logo">The Spike Site</div>
    <button class="menu-button" id="menu-btn" aria-label="Toggle Menu">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </button>
    <div class="nav-items">
        <a class="nav-item active" href = "index.html">Home</a>
        <a class="nav-item" href = "agents.html">Agents</a>
        <a class="nav-item" href = "maps.html">Maps</a>
        <a class="nav-item" href = "weapons.html">Weapons</a>
    </div>
</nav>
<div class="main-page">
    <div class="home-container">
        <h1>Home</h1>
        <div class="home-box">
            <img src="{{ asset("/../images/Valorant_logo_-_pink_color_version.png") }}" width="150" alt="Valorant logo">
            <p>
                <span class="welcome-message"> Welcome to The Spike Site!</span> <br>
                The Valorant encyclopedia for all your needs regarding valorant
                <a class="link-word" href="{{ url("agents.html") }}">agents</a>,
                <a class="link-word" href="{{ url("maps.html") }}">maps</a> and
                <a class="link-word" href="{{ url("weapons.html") }}">weapons</a>.<br>
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
                <button class="icon-button" id="moreAgents" onclick="window.location.href='agents.html'">More</button>
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


</body>
</html>
