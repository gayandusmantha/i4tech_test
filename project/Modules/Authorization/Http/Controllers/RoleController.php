<?php

namespace Modules\Authorization\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Role;
use Carbon\Carbon;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $roleInfo = Role::orderBy('id', 'desc');
        $perPage = request()->has('per_page') ? (int)request()->per_page : null;
        $roleInfo = $roleInfo->paginate($perPage);
        return response()->json($roleInfo, 201);
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
        $roledata['name'] = $request->name;
        $roledata['guard_name'] = "web";
        $role = Role::create($roledata);
        if ($request->has('permissions')) {
            $role->syncPermissions($request['permissions']);
        }
        return response()->json([
            'meta' => [
                'status' => true,
                'status_message' => 'Data found',
                'timestamp' => Carbon::now()
            ],
            'data' => $role,
        ], 201);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $roleInfo = null;
        $roleInfo = Role::find($id);
        return response()->json([
            'meta' => [
                'status' => true,
                'status_message' => 'Data found',
                'timestamp' => Carbon::now(),
            ],
            'data' =>  $roleInfo,
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
    public function update($id,Request $request)
    {
        $role = Role::find($id);
        $role->update($request->all());
        if ($request->has('permissions')) {
            $role->permissions()->sync($request['permissions']);
        }
        return response()->json([
            'meta' => [
                'status' => true,
                'status_message' => 'Data found',
                'timestamp' => Carbon::now()
            ],
            'data' => $role
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
