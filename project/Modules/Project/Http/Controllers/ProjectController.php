<?php

namespace Modules\Project\Http\Controllers;
use Carbon\Carbon;
use Modules\Project\Http\Requests\ProjectRequest;
use Modules\Project\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Routing\Controller;

class ProjectController extends Controller
{
    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }


     /**
     * Create Project.
     * @return type
     */
    public function create(ProjectRequest $request)
    {
        $request = $request->validated();
        $project = $this->projectRepository->storeProject($request);
        return response()->json([
            'meta' => [
                'status' => true,
                'status_message' => 'Data found',
                'timestamp' => Carbon::now(),
            ],
            'data' => $project
        ], 201);
    }


    /**
     * Dropdown Project List.
     * @return type
     */
    public function dropdown()
    {
        $project = $this->projectRepository->dropdown();
        return response()->json(
           $project, 201);
    }
}
