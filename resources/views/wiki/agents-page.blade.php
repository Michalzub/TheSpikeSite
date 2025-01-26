<x-app-layout>
<div class="main-page">
    <div class="home-container">
        <h1>{{ $agent['displayName'] }}</h1>
        <div class="agent-info-page">
            <div class="agent-main-info">
                <div class="agent-quote">
                    <p>
                        <span class="quote-text"> "Wind go brrrrrrr."</span> <br>
                        <span class="quote-author"> -{{ $agent['displayName'] }}</span>
                    </p>
                </div>
                <div class="agent-description">
                    <p>
                        {{ $agent['description'] }}
                    </p>
                </div>
            </div>
            <div class="agent-sidebar">
                <div class="sidebar-header">
                    {{ $agent['displayName'] }}
                </div>
                <div class="agent-image-container">
                    <img src="{{ $agent['fullPortrait'] }}" height="390" alt="{{ $agent['displayName'] }}">
                </div>
            </div>
        </div>
        <div class="abilities-info">
            @foreach($agent['abilities'] as $ability)
                <div class="ability-info">
                    <img class="ability-image" src="{{ $ability['displayIcon'] }}" height="80" alt="{{ $ability['displayName'] }}">
                    <p>
                    <span class="ability-name">
                        {{ $ability['displayName'] }}
                    </span>
                            <br>
                            <span class="ability-desc">
                        {{ $ability['description'] }}
                    </span>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>
</x-app-layout>
