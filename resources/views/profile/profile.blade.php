<x-app-layout>
    <div class="home-container">

        <h1>Profile of {{ $user->name }}</h1>

        <h2>Favorite Agents</h2>
        <div>
            @if($favoriteAgents->isEmpty())
                <p>No favorite agents yet.</p>
            @else
                <div class="profile-favourite">
                    @foreach($favoriteAgents as $agent)
                        @php
                            $agent = collect(session('agents'))->firstWhere('uuid', $agent->uuid);
                        @endphp
                        @if($agent)
                            <button class="icon-button" id="{{ $agent['displayName'] }}" onclick="window.location.href='/agents/{{ $agent['displayName'] }}'">
                                <img class="button-image" src="{{ $agent['displayIcon'] }}" alt="{{ $agent['displayName'] }}">
                                <span class="button-text">{{ $agent['displayName'] }}</span>
                            </button>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <hr>

        <h2>Favorite Maps</h2>
        <div>
            @if($favoriteMaps->isEmpty())
                <p>No favorite maps yet.</p>
            @else
                <div class="profile-favourite">
                    @foreach($favoriteMaps as $map)
                        @php
                            $map = collect(session('maps'))->firstWhere('uuid', $map->uuid);
                        @endphp
                        @if($map)
                            <button class="icon-button" onclick="window.location.href='/maps/{{ $map['displayName'] }}'">
                                <img class="button-image" src="{{ $map['splash'] }}" alt="{{ $map['displayName'] }}">
                                <span class="button-text">{{ $map['displayName'] }}</span>
                            </button>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <hr>

        <h2>Favorite Weapons</h2>
        <div>

            @if($favoriteWeapons->isEmpty())
                <p>No favorite weapons yet.</p>
            @else
                <div class="profile-favourite">
                    @foreach($favoriteWeapons as $weapon)
                        @php
                            $weapon = collect(session('weapons'))->firstWhere('uuid', $weapon->uuid);
                        @endphp
                        @if($weapon)
                            <button class="icon-button" onclick="window.location.href='/weapons/{{ $weapon['displayName'] }}'">
                                <img class="button-image" src="{{ $weapon['displayIcon'] }}" alt="{{ $weapon['displayName'] }}">
                                <span class="button-text">{{ $weapon['displayName'] }}</span>
                            </button>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <hr>

        <div>
            <h2>Discussions</h2>
            @if($discussions->isEmpty())
                <p>No discussions started yet.</p>
            @else
                <ul>
                    @foreach($discussions as $discussion)
                        <li>
                            <a class="discussion-link" href="{{ route('discussion.show', $discussion->id) }}">
                                {{ $discussion->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
