<x-app-layout>
<div class="main-page">
    <div class="home-container">
        <h1 class="centered">Agents</h1>
        <p class="centered">Agents are the playable characters in VALORANT, representing an agent of the VALORANT Protocol. Each agent serves as a different class with four abilities.</p>
        <div class="agent-grid">
            @foreach($agents as $agent)
                <div class="agent-preview">
                    <img class="agent-preview-image" src="{{ $agent['fullPortrait'] }}"
                         onclick="window.location.href='/agents/{{ $agent['displayName'] }}'"
                         height="390" alt="{{ $agent['displayName'] }}">
                    <img class="agent-preview-background" src="{{ $agent['background'] ?? '' }}"
                         height="390" alt="{{ $agent['displayName'] }} background">
                </div>
            @endforeach
        </div>
    </div>
</div>
</x-app-layout>
