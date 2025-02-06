{{-- resources/views/profile/show.blade.php --}}
<x-app-layout>
    <div class="home-container">
        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-bold mb-6">Profile of {{ $user->name }}</h1>

            <!-- Favorite Agents -->
            <h2>Favorite Agents</h2>
            <div class="item-preview-grid">
                @if($favoriteAgents->isEmpty())
                    <p>No favorite agents yet.</p>
                @else
                    <div>
                        @foreach($favoriteAgents as $favorite)
                            @php
                                $agent = collect(session('agents'))->firstWhere('uuid', $favorite->uuid);
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
            <div class="item-preview-grid">
                @if($favoriteMaps->isEmpty())
                    <p>No favorite maps yet.</p>
                @else
                    <div>
                        @foreach($favoriteMaps as $favorite)
                            @php
                                $map = collect(session('maps'))->firstWhere('uuid', $favorite->uuid);
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

            <!-- Favorite Weapons -->
            <h2>Favorite Weapons</h2>
            <div class="item-preview-grid">

                @if($favoriteWeapons->isEmpty())
                    <p>No favorite weapons yet.</p>
                @else
                    <div>
                        @foreach($favoriteWeapons as $favorite)
                            @php
                                $weapon = collect(session('weapons'))->firstWhere('uuid', $favorite->uuid);
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

            <!-- User Discussions -->
            <div>
                <h2>Discussions</h2>
                @if($discussions->isEmpty())
                    <p>No discussions started yet.</p>
                @else
                    <ul>
                        @foreach($discussions as $discussion)
                            <li>
                                <a href="{{ route('discussion.show', $discussion->id) }}">
                                    {{ $discussion->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
