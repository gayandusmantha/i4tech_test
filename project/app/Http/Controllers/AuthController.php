<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator, Input, Redirect , Auth , Response;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $loginData = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);


        if ($loginData->fails()) {
            return Response::json([
                'meta' => [
                    'status' => 'false',
                    'status_message' => 'Validation errors found.',
                    'errors' => $loginData->messages()
                ],
            ], 200);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return Response::json([
                'meta' => [
                    'status' => 'false',
                    'status_message' => 'Invalid Email name or Password'
                ],
            ], 200);
        } else {
            $user = Auth::getLastAttempted();
            if (!$user->active) {
                $permissions = $user->getAllPermissions()->pluck('name')->toArray();
                $tokenResult = Auth::user()->createToken('MyApp', $permissions);

                return response()->json([
                    'meta' => [
                        'status' => 'true',
                        'status_message' => 'Successfully logged in'
                    ],
                    'authentication_data' => [
                        'access_token' => $tokenResult->accessToken,
                        'token_type' => 'Bearer',
                        'expires_at' => Carbon::parse(
                            $tokenResult->token->expires_at
                        )->toDateTimeString()
                    ],
                    'user_data' => [
                        'user_id' => auth()->user()->id,
                        'first_name' => auth()->user()->first_name,
                        'last_name' => auth()->user()->last_name,
                        'avatar_location' => auth()->user()->avatar_location,
                        'avatar_type' => auth()->user()->avatar_type,
                        'role' => auth()->user()->roles,
                        'email' => auth()->user()->email,
                        'contact_number' => auth()->user()->contact_number,
                        'last_login_at' => auth()->user()->last_login_at,
                        'last_login_ip' => auth()->user()->last_login_ip,
                    ],
                ], 200);
            } else {
                return Response::json([
                    'meta' => [
                        'status' => 'false',
                        'status_message' => 'Inactive user. Please contact administrator.'
                    ],
                ], 200);
            }
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return Response::json([
            'meta' => [
                'status' => 'true',
                'status_message' => 'Successfully logged out'
            ],
        ], 200);
    }

}
