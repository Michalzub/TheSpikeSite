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
    @vite(['resources/css/app.css'])
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
        <a class="nav-item" href = "index.html">Home</a>
        <a class="nav-item" href = "agents.html">Agents</a>
        <a class="nav-item" href = "maps.html">Maps</a>
        <a class="nav-item" href = "weapons.html">Weapons</a>
    </div>
</nav>
<div class="main-page">
    <div class="home-container">
        <h1>Jett</h1>
        <div class="agent-info-page">
            <div class="agent-main-info">
                <div class="agent-quote">
                    <p>
                        <span class="quote-text"> "Wind go brrrrrrr."</span> <br>
                        <span class="quote-author"> -Jett</span>
                    </p>
                </div>
                <div class="agent-description">
                    <p>
                        Representing her home country of South Korea, Jett's agile and evasive fighting style lets
                        her take risks no one else can. She runs circles around every skirmish, cutting enemies up
                        before they even know what hit them.
                    </p>
                </div>
            </div>
            <div class="agent-sidebar">
                <div class="sidebar-header">
                    Jett
                </div>
                <div class="agent-image-container">
                    <img src="{{ asset("/../images/jettfullportrait.png") }}" height="390" alt="Jett">
                </div>
            </div>
        </div>
        <div class="abilities-info">
            <div class="ability-info" id="ability-1">
                <img class="ability-image" src="{{ asset("/../images/ability1.png") }}" height="80" alt="Updraft">
                <p>
                    <span class="ability-name">
                        Updraft
                    </span>
                    <br>
                    <span class="ability-desc">
                        INSTANTLY propel Jett high into the air.
                    </span>
                </p>
            </div>
            <div class="ability-info" id="ability-2">
                <img class="ability-image" src="{{ asset("/../images/ability2.png") }}" height="80" alt="Tailwind">
                <p>
                    <span class="ability-name">
                        Tailwind
                    </span>
                    <br>
                    <span class="ability-desc">
                        ACTIVATE to prepare a gust of wind for a limited time. RE-USE the wind to propel Jett in the
                        direction she is moving. If Jett is standing still, she propels forward.
                        Tailwind charge resets every two kills.
                    </span>
                </p>
            </div>
            <div class="ability-info" id="ability-3">
                <img class="ability-image" src="{{ asset("/../images/ability3.png") }}" height="80" alt="Cloudburst">
                <p>
                    <span class="ability-name">
                        Cloudburst
                    </span>
                    <br>
                    <span class="ability-desc">
                        INSTANTLY throw a projectile that expands into a brief vision-blocking cloud on impact with a
                        surface. HOLD the ability key to curve the smoke in the direction of your crosshair.
                    </span>
                </p>
            </div>
            <div class="ability-info" id="ability-4">
                <img class="ability-image" src="{{ asset("/../images/ability4.png") }}" height="80" alt="Blade Storm">
                <p>
                    <span class="ability-name">
                        Blade Storm
                    </span>
                    <br>
                    <span class="ability-desc">
                        EQUIP a set of highly accurate throwing knives. FIRE to throw a single knife and recharge
                        knives on a kill. ALT FIRE to throw all remaining daggers but does not recharge on a kill.
                    </span>
                </p>
            </div>
            <div class="ability-info" id="passive">
                <img class="ability-image" src="{{ asset("/../images/passive.png") }}" height="80" alt="Drift">
                <p>
                    <span class="ability-name">
                        Drift
                    </span>
                    <br>
                    <span class="ability-desc">
                        Holding the jump button while falling allows you to glide through the air.
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
