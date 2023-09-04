<?php

namespace Modules\Task\Http\Controllers;

use Carbon\Carbon;
use Modules\Task\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Task\Http\Requests\TaskRequest;
class TaskController extends Controller
{

    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('task::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(TaskRequest $request)
    {
        $request = $request->validated();
     //   dd($request);
        $task = $this->taskRepository->storeTask($request);
        return response()->json([
            'meta' => [
                'status' => true,
                'status_message' => 'Data found',
                'timestamp' => Carbon::now(),
            ],
            'data' => $task
        ], 201);
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {
        $taskInfo = $this->taskRepository->viewTask(request());
        return response()->json($taskInfo, 201);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('task::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $atatus = array('status' => 'completed');
        $task = $this->taskRepository->updateTaskStatus($atatus,$id);
        return response()->json([
            'meta' => [
                'status' => true,
                'status_message' => 'Data found',
                'timestamp' => Carbon::now(),
            ],
            'data' => $task,
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
