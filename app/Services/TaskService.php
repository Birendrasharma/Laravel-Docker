<?php 
namespace App\Services;

use App\Models\Task;

class TaskService 
{
    public function findAll()
    {
        return Task::when(request()->project_id, function ($query) {
            return $query->where('project_id', request()->project_id);
        })->orderBy('priority')->get();
    }

    public function find($id)
    {
        return Task::find($id);
    }

    public function store($data)
    {
        return Task::create($data);
    }

    public function update($task, $data)
    {
        return $task->update($data);
    }

    public function delete($task)
    {
        $task->delete();
    }
}