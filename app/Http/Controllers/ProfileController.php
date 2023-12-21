<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Jobs\ImportUniversityCalendarEventsForUserJob;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        try {
            if ($user->university_calendar_url !== null && $user->university_calendar_url !== '') {
                // Dispatch synchronously for now
                ImportUniversityCalendarEventsForUserJob::dispatchSync($user);


                request()->session()->flash('alert', [
                    'type' => 'success',
                    'message' => 'Kalendareinträge von deiner Universität wurden erfolgreich importiert.'
                ]);
            }
        } catch (\Throwable $e) {
            $message = 'Es gab einen Fehler beim Import der der Kalendareinträge von der Universität.';
            Log::error($message, [
                'error' => $e->getMessage(),
                'trace' => $e->getTrace()
            ]);
            request()->session()->flash('alert', [
                'type' => 'error',
                'message' => $message
            ]);

            return Redirect::route('profile.edit')->withErrors(['university_calendar_url' => $message]);
        }

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
