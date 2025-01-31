<x-app-layout>
    <div class="main-page">
        <div class="home-container">
            <h1>{{ $weapon['displayName'] }}</h1>
            <div class="weapon-details">
                <div class="weapon-image">
                    <img src="{{ $weapon['displayIcon'] }}" alt="{{ $weapon['displayName'] }}">
                </div>
                @if(isset($weapon['weaponStats']))
                    <div class="weapon-info">
                        <p><strong>Category:</strong> {{ Str::after($weapon['category'], '::') ?? 'N/A'  }}</p>

                        <p><strong>Cost:</strong> {{ $weapon['shopData']['cost'] ?? 'N/A'  }}</p>
                        <p><strong>Magazine Size:</strong> {{ $weapon['weaponStats']['magazineSize'] ?? 'N/A'  }}</p>
                        <p><strong>Fire Rate:</strong> {{ $weapon['weaponStats']['fireRate'] ?? 'N/A'  }} rounds per second</p>
                        <p><strong>Reload Time:</strong> {{ $weapon['weaponStats']['reloadTimeSeconds'] ?? 'N/A'  }} seconds</p>
                        <p><strong>First Bullet Accuracy:</strong> {{ $weapon['weaponStats']['firstBulletAccuracy'] ?? 'N/A'  }}</p>
                        <p><strong>Wall Penetration:</strong> {{ Str::after($weapon['weaponStats']['wallPenetration'], '::') ?? 'N/A' }}</p>
                        <p><strong>Run Speed Multiplier:</strong> {{ $weapon['weaponStats']['runSpeedMultiplier'] ?? 'N/A'  }}</p>
                        <p><strong>Equip Time:</strong> {{ $weapon['weaponStats']['equipTimeSeconds'] ?? 'N/A'  }} seconds</p>
                        <p><strong>Damage Ranges:</strong></p>
                        <ul>
                            @foreach($weapon['weaponStats']['damageRanges'] as $range)
                                <li>
                                    {{ $range['rangeStartMeters'] }}m - {{ $range['rangeEndMeters'] }}m:
                                    Head Damage: {{ $range['headDamage'] }},
                                    Body Damage: {{ $range['bodyDamage'] }},
                                    Leg Damage: {{ $range['legDamage'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <p><strong>Weapon stats are not available for this weapon.</strong></p>
                @endif
            </div>

            <div class="weapon-skins">
                @if(count($skins) > 0)
                    <div class="image-gallery">
                        <button class="prev" onclick="changeImage(-1)">&#10094;</button>
                        <img id="skinImage" src="{{ $skins[0]['displayIcon'] }}" alt="Weapon Skin">
                        <p id="skinName" class="skin-name">{{ $skins[0]['displayName'] }}</p>
                        <button class="next" onclick="changeImage(1)">&#10095;</button>
                    </div>
                @else
                    <p>No skins available for this weapon.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let currentIndex = 0;
    const skins = @json($skins);

    function changeImage(direction) {
        currentIndex = (currentIndex + direction + skins.length) % skins.length;
        if(skins[currentIndex].displayIcon == null) {
            document.getElementById('skinImage').src = "https://media.valorant-api.com/weaponskins/f454efd1-49cb-372f-7096-d394df615308/displayicon.png"
        } else {
            document.getElementById('skinImage').src = skins[currentIndex].displayIcon;
        }
        document.getElementById('skinName').textContent = skins[currentIndex].displayName;
    }
</script>
