<x-app-layout>
    <div class="main-page">
        <div class="home-container">
            <h1 class="centered">Maps</h1>
            <p class="centered">Each match of VALORANT takes place on a map. Four maps were available at launch, and
                annually a new standard map is released[1]. Overall, there are currently 17 playable maps: 11 for
                standard play, 5 for Team Deathmatch, and one made for practice and training new players. </p>
            <div class="map-grid">
                @foreach($maps as $map)
                    <div class="agent-preview">
                        <img class="agent-preview-image" src="{{ $map['listViewIconTall'] }}"
                             onclick="window.location.href='/maps/{{ $map['displayName'] }}'"
                             height="390" alt="{{ $map['displayName'] }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
