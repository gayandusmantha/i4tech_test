<?php

namespace Modules\Authorization\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('authorization::index');
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
        $userInfo = null;
        $userInfo =  User::find($id);
        return response()->json([
            'meta' => [
                'status' => true,
                'status_message' => 'Data found',
                'timestamp' => Carbon::now(),
            ],
            'data' => $userInfo,
        ], 201);
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
        $user = User::find($id);
        $user->update($request->all());
        if ($request->has('roles')) {
            $user->roles()->sync($request['roles']);
        }
        return response()->json([
            'meta' => [
                'status' => true,
                'status_message' => 'Data found',
                'timestamp' => Carbon::now()
            ],
            'data' => $user,
        ], 201);
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
