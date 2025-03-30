<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use App\Services\ProjectService;

class TaskController extends Controller
{
    //
    public function __construct(
        protected ProjectService $projectService, 
        protected TaskService $taskService) 
    {

    }

    public function index()
    {
        $tasks = $this->taskService->findAll();
        $projects = $this->projectService->findAll();
        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function create()
    {
        $projects = $this->projectService->findAll();
        return view('tasks.create', compact('projects'));
    }

    public function store(TaskRequest $request)
    {
        $tasks = $this->taskService->store($request->only('project_id', 'name', 'priority', 'status'));
        
        return redirect()->route('tasks.index')->with('success', 'Successfully created.');
    }

    public function edit($id)
    {
        $task = $this->taskService->find($id);
        $projects = $this->projectService->findAll();
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(TaskRequest $request, $id)
    {
        if(!$task = $this->taskService->find($id)) {
            return redirect()->back();
        }

        $tasks = $this->taskService->update($task, $request->only('project_id', 'name', 'priority', 'status'));

        return redirect()->route('tasks.index')->with('success', 'Successfully upated.');;
    }

    public function destroy($id)
    {
        if(!$task = $this->taskService->find($id)) {
            return redirect()->back();
        }

        $tasks = $this->taskService->delete($task);
        return redirect()->route('tasks.index')->with('success', 'Successfully deleted.');;
    }

    public function reorder(Request $request)
    {
        $newsOrders = $request->order;

        foreach ($newsOrders as $priority=>$item) {

            if(!$task = $this->taskService->find($item['id'])) {
                return ;
            } 
            $tasks = $this->taskService->update($task, ['priority' => $priority + 1]);
        }
        
        return response()->json(['success'=> true, 'message' => 'Reordered successfully']);
    }

}
