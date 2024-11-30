<x-app-layout>
<div class="main-page">
    <div class="home-container">
        <h1 class="centered">Agents</h1>
        <p class="centered">Agents are the playable characters in VALORANT, representing an agent of the VALORANT Protocol. Each agent serves as a different class with four abilities.</p>
        <div class="agent-grid">
            <div class="agent-preview agent-1">
                <img class="agent-preview-image" src="{{ asset("/tempImages/jettfullportrait.png") }}"
                     onclick="window.location.href='agent-page.html'" height="390"
                     alt="Jett"
                >
                <img class="agent-preview-background" src="{{ asset("/tempImages/jettfullportraitbackground.png") }}"
                     height="390" alt="Jett background"
                >
            </div>
            <div class="agent-preview agent-2">
            </div>
            <div class="agent-preview agent-3">
            </div>
            <div class="agent-preview agent-4">
            </div>
            <div class="agent-preview agent-5">
            </div>
            <div class="agent-preview agent-6">
            </div>
            <div class="agent-preview agent-7">
            </div>
        </div>
    </div>
</div>
</x-app-layout>
