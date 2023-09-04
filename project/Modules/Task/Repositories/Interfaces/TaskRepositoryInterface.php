<?php

namespace Modules\Task\Repositories\Interfaces;
Interface TaskRepositoryInterface{
    public function storeTask($data);
    public function updateTaskStatus($data, $id);
    public function viewTask($data);

}
