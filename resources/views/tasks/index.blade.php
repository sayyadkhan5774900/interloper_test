@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Task List</h1>
         <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="d-inline-block">Task Table</h4>
                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#createTaskModal">Add New Task</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="tbodyclass">
                                    @foreach($tasks as $task)
                                        <tr>
                                            <td>{{ $task->id }}</td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->description }}</td>
                                            <td>
                                                <button class="btn btn-danger delete-task" data-id="{{ $task->id }}">Delete</button>
                                                <button class="btn btn-primary edit-task" data-id="{{ $task->id }}" data-toggle="modal" data-target="#editTaskModal">Edit</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Task Modal -->
        <div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTaskModalLabel">Create Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="createTaskForm">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="createTaskTitle">Title</label>
                                <input type="text" class="form-control" id="createTaskTitle" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="createTaskDescription">Description</label>
                                <textarea class="form-control" id="createTaskDescription" name="description" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Task Modal -->
        <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editTaskForm">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" id="editTaskId" name="id">
                            <div class="form-group">
                                <label for="editTaskTitle">Title</label>
                                <input type="text" class="form-control" id="editTaskTitle" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="editTaskDescription">Description</label>
                                <textarea class="form-control" id="editTaskDescription" name="description" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>   
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add New Task
            $('#createTaskForm').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var url = form.attr('action');
                var method = "POST";
                var data = form.serialize();
                $.ajax({
                    url: "/tasks/create",
                    method: method,
                    data: data,
                    success: function(response) {
                        $('#createTaskModal').modal('hide');
                        form.trigger('reset');
                        $('.card-body').load(window.location.href + ' .card-body');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                alert(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
