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
     * Create new Task.
     * @return Type
     */
    public function create(TaskRequest $request)
    {
        $request = $request->validated();
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
     * Show All Task List
     * @return Type
     */
    public function show()
    {
        $taskInfo = $this->taskRepository->viewTask(request());
        return response()->json($taskInfo, 201);
    }


    /**
     * Update Task Status.
     * @param Request $request
     * @param int $id
     * @return Type
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


}
