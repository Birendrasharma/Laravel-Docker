@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Task List</span>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">New Task</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Project</th>
                        <th scope="col">Task Name</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="task-list">
                    @foreach($tasks as $item)
                        <tr data-id="{{ $item->id }}">
                            <td class="task-index">{{ $loop->iteration }}</td>
                            <td>{{ $item->project->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="task-priority">{{ $item->priority }}</td>
                            <td>
                                <a href="{{ route('tasks.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('tasks.destroy', $item->id) }}" method="POST" style="display:inline;">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
$(document).ready(function () {
    const taskList = document.getElementById("task-list");

    const sortable = new Sortable(taskList, {
        animation: 150,
        ghostClass: 'sortable-ghost',
        onEnd: updateTaskOrder
    });

    function updateTaskOrder() {
        let order = [];

        $("#task-list tr").each(function (index) {
            order.push({ id: $(this).data("id"), priority: index + 1 });
        });

        $.post("{{ route('tasks.reorder') }}", {
            _token: "{{ csrf_token() }}",
            order: order
        }).done(function (response) {
            if (response.success) {
                $("#task-list tr").each(function (index) {
                    $(this).find(".task-priority").text(index + 1);
                });
            }
        }).fail(function () {
            alert("Failed to update task order. Please try again.");
        });
    }
});
</script>
@endsection
