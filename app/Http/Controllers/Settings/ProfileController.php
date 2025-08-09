<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\DestroyProfileRequest;
use App\Http\Requests\Settings\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Show the user's profile settings page.
     */
    public function edit(Request $request): Response|RedirectResponse
    {
        $user = request()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        return Inertia::render('settings/Profile', [
            'mustVerifyEmail' => ! $user->hasVerifiedEmail(),
            'status' => $request->session()->get('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = request()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return to_route('profile.edit');
    }

    /**
     * Delete the user's profile.
     */
    public function destroy(DestroyProfileRequest $request): RedirectResponse
    {
        $request->validated();
        $user = request()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        Auth::logout();

        $user->delete();

        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }
}
