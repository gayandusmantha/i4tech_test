<?php

namespace Modules\Authorization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authorization\Http\Requests\LoginRequest;
use Validator, Input, Redirect, Response;

class LoginController extends Controller
{
    /**
     * Login User.
     * @return type
     */
    public function  login(LoginRequest $request)
    {
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return Response::json([
                'meta' => [
                    'status' => 'false',
                    'status_message' => 'Invalid Email name or Password'
                ],
            ], 200);
        } else {
            $user = auth()->getLastAttempted();
            if ($user->name) {
                $permissions = $user->getAllPermissions()->pluck('name')->toArray();
                $user = auth()->user();
                $tokenResult =  $user->createToken('MyApp',$permissions);
                return response()->json([
                    'meta' => [
                        'status' => 'true',
                        'status_message' => 'Successfully logged in'
                    ],
                    'authentication_data' => [
                        'access_token' => $tokenResult->accessToken,
                        'token_type' => 'Bearer'
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

    /**
     * Logout the user.
     * @return type
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'meta' => [
                'status' => 'true',
                'status_message' => 'Successfully logged out'
            ],
        ], 200);
    }

}
