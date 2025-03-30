@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Project List</span>
            <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm">New Project</a>
        </div>
        @include('layouts.notification')
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="task-list">
                    @foreach($projects as $key=>$item)
                        <tr data-id="{{ $item->id }}">
                            <td>{{ $key }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ route('projects.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('projects.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let taskList = document.getElementById('task-list');
            
            new Sortable(taskList, {
                animation: 150,
                ghostClass: 'sortable-ghost',
                onEnd: function (evt) {
                    let order = [];
                    document.querySelectorAll('#task-list tr').forEach((row, index) => {
                        order.push({ id: row.dataset.id, priority: index + 1 });
                    });

                    fetch("{{ route('tasks.reorder') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ order })
                    }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelectorAll('#task-list tr').forEach((row, index) => {
                                row.querySelector('.task-priority').innerText = index + 1;
                            });
                        }
                    });
                }
            });
        });
    </script>

@endsection
