<?php

namespace Modules\Project\Repositories;

use Modules\Project\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{

    public function storeProject($data)
    {
        return Project::create($data);
    }
}
