<?php

namespace Modules\Authorization\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authorization\Http\Requests\LoginRequest;
use Validator, Input, Redirect  , Response;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function login(LoginRequest $request)
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
                $tokenResult =  $user->createToken('MyApp',array('test'));
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
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('authorization::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('authorization::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('authorization::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
