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
    function userRegistration(Request $request)
    {
        try {
            User::create($request->input());
            return response()->json([
                "status" => "success",
                "message" => "user registration successful"
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "user registration failed"
            ], 500);
        }

    }

    function userLogin(Request $request)
    {
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))
            ->count();

        if ($count === 1) {
            $token = JWTToken::createToken($request->input('email'), 'login');

            return response()->json([
                "status" => "success",
                "message" => "login successful",
                "token" => $token
            ], 200);
        } else {
            return response()->json([
                "status" => "failed",
                "message" => "unauthorized"
            ], 401);
        }
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
            $token = JWTToken::createToken($email, 'resetPassword');

            // Reset easting OTP from Database
            User::where('email', '=', $email)->update([
                'otp' => '0'
            ]);

            return response()->json([
                "status" => "success",
                "message" => "otp verification successful",
                "token" => $token
            ], 200);
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
}