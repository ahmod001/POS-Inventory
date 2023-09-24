<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Mail;

class userController extends Controller
{
    function loginPage()
    {
        return view('pages.auth.login-page');
    }

    function registerPage()
    {
        return view('pages.auth.registration-page');
    }

    function sendOtpPage()
    {
        return view('pages.auth.send-otp-page');
    }

    function verifyOtpPage()
    {
        return view('pages.auth.verify-otp-page');
    }

    function resetPasswordPage()
    {
        return view('pages.auth.reset-password-page');
    }

    function userRegistration(Request $request)
    {
        try {
            User::create($request->input());
            return response()->json([
                "status" => "success",
                "message" => "Registration successful"
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Registration failed"
            ], 400);
        }

    }

    function userLogin(Request $request)
    {
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))
            ->select('id')->first();

        if ($count !== null) {
            $token = JWTToken::createToken($request->input('email'), $count->id, 'login');

            return response()->json([
                "status" => "success",
                "message" => "Login successful",
                "token" => $token
            ], 200)->cookie('token', $token, 60 * 24 * 30); // expire in 30 days
        } else {
            return response()->json([
                "status" => "failed",
                "message" => "unauthorized"
            ], 401);
        }
    }

    function userLogOut(Request $request)
    {
        return redirect('/login')
            ->cookie('token', '', -1); //Delete Cookie
    }

    function sendOTPCode(Request $request)
    {
        $email = $request->input('email');
        $count = User::where('email', '=', $email)->count();

        if ($count === 1) {
            try {
                // Generate 4 digit Otp
                $otp = rand(1000, 9999);

                // Send OTP via Email
                Mail::to($email)->send(new OTPMail($otp));

                // Update on Database
                User::where('email', '=', $email)->Update([
                    'otp' => $otp
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "4 digits otp verification code sent successfully"
                ], 200);

            } catch (Exception $e) {
                return response()->json([
                    "status" => "failed",
                    "message" => "email sending failed"
                ], 500);
            }
        } else {
            return response()->json([
                "status" => "failed",
                "message" => "unauthorized"
            ], 401);
        }
    }

    function verifyOTPCode(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = User::where('email', '=', $email)
            ->where('otp', '=', $otp)
            ->count();

        if ($count === 1) {
            // Generate JWT 
            $token = JWTToken::createToken($email, 0, 'resetPassword');

            // Reset easting OTP from Database
            User::where('email', '=', $email)->update([
                'otp' => '0'
            ]);

            return response()->json([
                "status" => "success",
                "message" => "otp verification successful",
                "token" => $token
            ], 200)->cookie('token', $token, 60 * 24 * 30); // expire in 30 days
        } else {
            return response()->json([
                "status" => "failed",
                "message" => "unauthorized"
            ], 401);
        }
    }

    function resetPassword(Request $request)
    {
        try {
            $email = $request->header('email');
            $newPassword = $request->input('password');
            User::where('email', '=', $email)->update([
                'password' => $newPassword
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Request successful"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "something went wrong"
            ], 500);
        }
    }
    function userUpdate(Request $request)
    {
        try {
            $email = $request->header('email');
            User::where('email', '=', $email)->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password')
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Profile update successful'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Profile update failed'
            ], 400);
        }
    }
    function userProfile(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', '=', $email)->first();
        return response()->json([
            'status' => 'success',
            'message' => '',
            "data" => $user
        ], 200);
    }
}