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
        <a class="nav-item active" href = "weapons.html">Weapons</a>
    </div>
</nav>
</body>
</html>
