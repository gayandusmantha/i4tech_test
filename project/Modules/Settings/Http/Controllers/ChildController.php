<?php

namespace Modules\Settings\Http\Controllers;

use App\Models\Child;
use App\Models\Enrollment;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;


class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $child = Child::query()->with('parents')->select('*');

        if ((request()->has('sort_field')) && (request()->sort_field != null)) {
            $sortCol = request()->sort_field;
            $sortDir = request()->sort_order ? request()->sort_order : 'desc';
            if ($sortCol == 'parent') {
                $child = $child->addSelect(DB::raw('(SELECT name from parents WHERE  parent_id = parents.id) as parent'));
                $child = $child->orderByDesc('parent', $sortDir);
            }
            if ($sortCol == 'phone') {
                $child = $child->addSelect(DB::raw('(SELECT phone from parents WHERE  parent_id = parents.id) as phone'));
                $child = $child->orderByDesc('phone', $sortDir);

            } else {
                $child = $child->orderBy($sortCol, $sortDir);

            }
        } else {
            $child = $child->orderBy('id', 'desc');
        }

        $perPage = request()->has('per_page') ? (int)request()->per_page : null;
        $child = $child->paginate($perPage);
        return response()->json($child, 201);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function dropdown()
    {

        $childInfo = Child::orderBy('name', 'asc');
        $field = request()->has('field') ? (string)request()->field : null;
        $search = request()->has('value') ? (string)request()->value : null;
        if($field && $search){
            $childInfo = $childInfo->where($field,'like',"%". $search."%");
        }
        $childInfo = $childInfo->get();
        // return response()->json($subjectList, 201);
        return response()->json([
            'meta' => [
                'status' => true,
                'status_message' => 'Data found',
                'timestamp' => Carbon::now(),
            ],
            'data' => $childInfo,
        ], 201);
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
        $childInfo  = Child::with('parents','enrollment.programme')->find($id);
        return response()->json([
            'meta' => [
                'status' => true,
                'status_message' => 'Data found',
                'timestamp' => Carbon::now(),
            ],
            'data' => $childInfo
        ], 201);
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
