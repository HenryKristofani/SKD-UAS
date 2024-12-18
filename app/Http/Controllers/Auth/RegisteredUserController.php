<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OTPVerificationMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate and send OTP
        $otp = $user->generateOTP();
        
        // Send OTP via email
        Mail::to($user->email)->send(new OTPVerificationMail($otp));

        // Redirect to OTP verification page
        return redirect()->route('otp.verify', ['email' => $user->email]);
    }

    public function showOTPVerification(Request $request)
    {
        return Inertia::render('Auth/OTPVerify', [
            'email' => $request->email
        ]);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found']);
        }

        if ($user->verifyOTP($request->otp)) {
            $user->clearOTP();
            auth()->login($user);
            return redirect()->route('home')->with('success', 'Email verified successfully');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP']);
    }
}