@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Edit Task:  {{ $task->name }}</span>
            <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-sm">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="project" class="form-label">Select Project</label>
                    <select class="form-select" id="project" name="project_id" required>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $project->id == $task->project_id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <div class="invalid-feedback" style="display:block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="taskName" class="form-label">Task Name</label>
                    <input type="text" class="form-control" id="taskName" name="name" value="{{ $task->name }}" required>
                    @error('name')
                        <div class="invalid-feedback" style="display:block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="taskName" class="form-label">Priority</label>
                    <input type="number" class="form-control" id="taskName" name="priority" value="{{ $task->priority }}" required>
                    @error('priority')
                        <div class="invalid-feedback" style="display:block">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Update Task</button>
            </form>
        </div>
    </div>

@endsection
