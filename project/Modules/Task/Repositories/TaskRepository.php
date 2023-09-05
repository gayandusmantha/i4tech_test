<?php

namespace Modules\Task\Repositories;
use Modules\Task\Repositories\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function storeTask($data)
    {
        return Task::create($data);
    }

    public function updateTaskStatus($data, $id)
    {
        $category = Task::where('id', $id)->first();
        return $category->update($data);

    }

   public function viewTask($data){
       $taskInfo = Task::query()->with('ProjectInfo');
       if ((request()->has('sort')) && (request()->sort != null)) {
           list($sortCol, $sortDir) = explode('|', request()->sort);
           if ($sortCol == 'due_date') {
               $taskInfo = $taskInfo->orderBy($sortCol, $sortDir);
           }
       } else {
           $taskInfo = $taskInfo->orderBy('due_date', 'desc');
       }

       if (isset(request()->project_name) && !empty(request()->project_name)) {
           $projectName = request()->project_name;
           $taskInfo = $taskInfo->whereHas('ProjectInfo', function ($q) use ($projectName) {
               $q->where('name', 'like', '%' . $projectName . '%');
           });
       }

       $perPage = request()->has('per_page') ? (int)request()->per_page : null;
       $taskInfo = $taskInfo->paginate($perPage);
       return $taskInfo;
   }

}
