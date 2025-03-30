<?php 
namespace App\Services;

use App\Models\Project;

class ProjectService 
{
    public function findAll()
    {
        return Project::latest('id')->get();
    }

    public function find($id)
    {
        return Project::find($id);
    }

    public function store($data)
    {
        return Project::create($data);
    }

    public function update($project, $data)
    {
        return $project->update($data);
    }

    public function delete($project)
    {
        return $project->delete();
    }
}