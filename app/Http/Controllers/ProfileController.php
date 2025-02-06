<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Discussion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function show(User $user)
    {
        $agents = session('agents');

        if (!$agents) {
            $response = Http::get('https://valorant-api.com/v1/agents', ['isPlayableCharacter' => 'true']);
            $agents = $response->json()['data'];

            session(['agents' => $agents]);
        }

        $weapons = session('weapons');

        if (!$weapons) {
            $response = Http::get('https://valorant-api.com/v1/weapons');

            $weapons = collect($response->json()['data'])->map(function($weapon) {
                unset($weapon['skins']);
                return $weapon;
            });
            session(['weapons' => $weapons]);
        }

        $maps = session('maps');

        if (!$maps) {
            $response = Http::get('https://valorant-api.com/v1/maps');

            $maps = $response->json()['data'];

            $excludedMapNames = ['The Range', 'Basic Training'];
            foreach ($maps as $key => $map) {
                if (in_array($map['displayName'], $excludedMapNames)) {
                    unset($maps[$key]);
                }
            }

            $maps = array_values($maps);

            session(['maps' => $maps]);
        }

        // Fetch favorite agents, maps, and weapons based on user_id and type
        $favoriteAgents = Favorite::where('user_id', $user->id)
            ->where('type', 'agent')
            ->get();

        $favoriteWeapons = Favorite::where('user_id', $user->id)
            ->where('type', 'weapon')
            ->get();

        $favoriteMaps = Favorite::where('user_id', $user->id)
            ->where('type', 'map')
            ->get();

        // Fetch user posts
        $discussions = Discussion::where('author_id', $user->id)->get();

        // Pass the data to the profile view
        return view('profile.profile', compact('user', 'favoriteAgents', 'favoriteWeapons', 'favoriteMaps', 'discussions'));
    }

    public function login() {
        return view('forum.index');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function updateFavorite($uuid, $type)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'You must be logged in to favorite an item.'], 401);
        }

        $userId = auth()->id();

        $existingFavorite = Favorite::where('user_id', $userId)
            ->where('uuid', $uuid)
            ->where('type', $type)
            ->first();



        // If the favorite exists, remove it (unfavorite)
        if ($existingFavorite) {
            \DB::table('favorites')
                ->where('user_id', $userId)
                ->where('uuid', $uuid)
                ->where('type', $type)
                ->delete();
            return response()->json(['message' => 'Removed from favorites']);
        } else {
            // If the favorite doesn't exist, add it (favorite)
            Favorite::create([
                'user_id' => $userId,
                'uuid' => $uuid,
                'type' => $type,
            ]);
            return response()->json(['message' => 'Added to favorites']);
        }
    }




}
