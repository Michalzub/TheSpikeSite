<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Discussion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


        $favoriteAgents = Favorite::where('user_id', $user->id)
            ->where('type', 'agent')
            ->get();

        $favoriteWeapons = Favorite::where('user_id', $user->id)
            ->where('type', 'weapon')
            ->get();

        $favoriteMaps = Favorite::where('user_id', $user->id)
            ->where('type', 'map')
            ->get();

        $discussions = Discussion::where('author_id', $user->id)->get();

        return view('profile.profile', compact('user', 'favoriteAgents', 'favoriteWeapons', 'favoriteMaps', 'discussions'));
    }

    public function login() {
        return view('forum.index');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

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


        if ($existingFavorite) {
            \DB::table('favorites')
                ->where('user_id', $userId)
                ->where('uuid', $uuid)
                ->where('type', $type)
                ->delete();
            return response()->json(['message' => 'Removed from favorites']);
        } else {
            Favorite::create([
                'user_id' => $userId,
                'uuid' => $uuid,
                'type' => $type,
            ]);
            return response()->json(['message' => 'Added to favorites']);
        }
    }
}
