<?php

namespace Modules\Settings\Http\Controllers;

use App\Models\Parents;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $parents = Parents::query()->select('*');

        if ((request()->has('sort_field')) && (request()->sort_field != null)) {
            $sortCol = request()->sort_field;
            $sortDir = request()->sort_order ? request()->sort_order : 'desc';
            $parents = $parents->orderBy($sortCol, $sortDir);
        } else {
            $parents = $parents->orderBy('parents.id', 'desc');
        }

        $perPage = request()->has('per_page') ? (int)request()->per_page : null;
        $parents = $parents->paginate($perPage);
        return response()->json($parents, 201);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('settings::create');
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
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('settings::edit');
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
