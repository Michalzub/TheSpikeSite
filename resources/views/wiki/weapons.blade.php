<x-app-layout>
    <div class="main-page">
        <div class="home-container">
            <h1 class="centered">Weapons</h1>
            <p class="centered">Weapons (also known as Arsenal) are used by agents to damage and kill/destroy enemy agents and their utility. </p>
            <div class="weapon-grid">
                @foreach($weapons as $weapon)
                    <div class="weapon-preview">
                        <img class="agent-preview-image" src="{{ $weapon['displayIcon'] }}"
                             onclick="window.location.href='/weapons/{{ $weapon['displayName'] }}'"
                             height="125" alt="{{ $weapon['displayName'] }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
