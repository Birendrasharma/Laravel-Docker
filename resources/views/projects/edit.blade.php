@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Edit Project</span>
            <a href="{{ route('projects.index') }}" class="btn btn-primary btn-sm">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="taskName" class="form-label">Prject Name</label>
                    <input type="text" class="form-control" id="taskName" name="name" value="{{ $project->name }}" required>
                    @error('name')
                        <div class="invalid-feedback" style="display:block">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
