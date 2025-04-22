<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Email ID not matched!'], 404);
        }

        // Generate a reset token
        $token = Str::random(60);

        // Save the reset token (you might use a password_resets table or another method)
        // Assuming you have a PasswordReset model and migration
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        // Send the reset email
        Mail::send('emails.password_reset', ['token' => $token], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Password Reset Request');
        });

        return response()->json(['success' => true, 'message' => 'Reset link sent to your email!']);
    }

    public function showResetForm(Request $request)
    {
        // Here we will pass the token to the reset form
        return view('auth.passwords.reset', ['token' => $request->token]);
    }

    public function resetPassword(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'new_password' => [
                'required',
                'string',
                'min:6',
                'confirmed', // Ensures new_password matches confirm_password
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/', $value)) {
                        $fail('Password must be at least 6 characters long, include at least one uppercase letter, and one special character.');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Get the user by the token (this can be implemented as needed, depending on your setup)
        // For example, you might have a User model that stores the reset token

        // Find the reset request by token
        $token = $request->input('token');
        $reset = DB::table('password_resets')->where('token', $token)->first();

        if (!$reset) {
            return redirect()->route('password.reset')->with('status_error', 'Invalid reset token. Please try again.');
        }

        // Check if the token is expired (e.g., valid for 60 minutes)
        $tokenLifetime = config('auth.passwords.users.expire', 60); // Default: 60 minutes
        $tokenCreatedAt = Carbon::parse($reset->created_at);

        if ($tokenCreatedAt->addMinutes($tokenLifetime)->isPast()) {
            return redirect()->route('password.reset')->with('status_error', 'The reset token has expired. Please try again.');
        }


        $user = User::where('email', $reset->email)->first();

        if (!$user) {
            return back()->withErrors(['token' => 'Invalid or expired token.'])->withInput();
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('login_dashboard')->with('status', 'Password updated successfully!');
    }
}
