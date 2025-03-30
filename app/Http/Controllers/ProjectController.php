<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;
use App\Models\Project;

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService) 
    {

    }
    public function index()
    {
        $projects = $this->projectService->findAll();;
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(ProjectRequest $request)
    {
        $this->projectService->store($request->only('name'));
        
        return redirect()->route('projects.index')->with('success', 'Successfully created.');;
    }

    public function edit($id)
    {
        $project = $this->projectService->find($id);
        return view('projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, $id)
    {
        if(!$project = $this->projectService->find($id)) {
            return redirect()->back();
        }

        $this->projectService->update($project, $request->only('name'));

        return redirect()->route('projects.index')->with('success', 'Successfully updated.');;
    }

    public function destroy($id)
    {
        if(!$project = $this->projectService->find($id)) {
            return redirect()->back();
        }

        $this->projectService->delete($project);
        return redirect()->route('projects.index')->with('success', 'Successfully deleted.');;
    }

    
}
