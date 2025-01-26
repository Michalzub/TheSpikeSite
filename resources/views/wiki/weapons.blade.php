<x-app-layout>
    <div class="main-page">
        <div class="home-container">
            <h1 class="centered">Weapons</h1>
            <p class="centered"></p>
            <div class="agent-grid">
                @foreach($weapons as $weapon)
                    <div>
                        {{ $weapon['displayName'] }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
