<x-app-layout>
    <div class="main-page">
        <div class="home-container">
            <h1>{{ $map['displayName'] }}</h1>

            <div class="favorite-button-map">
                <button class="favorite-btn" id="favorite-btn" data-uuid="{{ $map['uuid'] }}" data-type="map" data-displayName="{{$map['displayName']}}" data-imageUrl="{{$map['splash']}}">
                    @if(auth()->check() && auth()->user()->favorites->contains('uuid', $map['uuid']))
                        Unfavorite
                    @else
                        Favorite
                    @endif
                </button>
            </div>

            <div class="home-box">
                <img class="map-splash" id="map-splash" src="{{ $map['splash'] }}" alt="Map Splash" class="map-splash">
                <img class="map-display-icon" id="map-display-icon" src="{{ $map['displayIcon'] }}" alt="Map Display Icon">
            </div>
        </div>
    </div>
</x-app-layout>
