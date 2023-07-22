@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Tasks</h3>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#task_modal">
                            Add Tasks
                        </button>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Priority</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="taskTable">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="task_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="task_form">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control">
                                    <div class="error-msg text-danger" id="error-title"></div>
                                </div>

                                <div class="form-group">
                                    <label for="">Due Date</label>
                                    <input type="date" name="due_date" class="form-control">
                                    <div class="error-msg text-danger" id="error-due_date"></div>
                                </div>

                                <div class="form-group">
                                    <label for="">Priority</label>
                                    <select name="priority" class="form-control">
                                        <option value="" selected disabled>choose one</option>
                                        <option value="1">High</option>
                                        <option value="2">Low</option>
                                    </select>
                                    <div class="error-msg text-danger" id="error-priority"></div>
                                </div>

                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="3"></textarea>
                                    <div class="error-msg text-danger" id="error-description"></div>
                                </div>

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save_task">Add Task </button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="edit_task_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="update_task_form">
                        <input type="hidden" name="task_id">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Due Date</label>
                                    <input type="date" name="due_date" class="form-control" required>
                                </div>


                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="3" required></textarea>
                                </div>

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_task">Save Changes </button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            getTasks();

            function getTasks() {

                $.ajax({

                    url: '{{ url('/get_tasks') }}',
                    type: 'get',
                    async: false,
                    dataType: 'json',

                    success: function(data) {

                        console.log(data);

                        var html = '';
                        var i;
                        var c = 0;

                        for (i = 0; i < data.length; i++) {

                            c++;
                            html += '<tr>' +
                                '<td>' + c + '</td>' +
                                '<td>' + data[i].title + '</td>' +
                                '<td>' + data[i].description + '</td>' +
                                '<td>' + data[i].priority + '</td>' +
                                '<td>' + data[i].due_date + '</td>' +
                                '<td><button type="submit" class="btn btn-success btn-sm edit_task" data="' +
                                data[i].id + '">Edit</button></td>' +
                                '</tr>';
                        }


                        $('#taskTable').html(html);

                    },
                    error: function() {
                        toastr.error('something went wrong');
                    }

                });
            }


            //Add Task
            $('#task_form').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData($('#task_form')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ url('store_tasks') }}",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.save_task').text('Waiting...');
                        $(".save_task").prop("disabled", true);
                    },
                    success: function(response) {

                        if (response.status == 200) {
                            $('.save_task').text('Add Task');
                            $(".save_task").prop("disabled", false);
                            $("#task_modal").modal('hide');
                            $('#task_form')[0].reset();
                            getTasks();
                        }

                        if (response.errors) {
                            $('.save_task').text('Add Task');
                            $(".save_task").prop("disabled", false);
                            // Handle validation errors
                            $.each(response.errors, function(key, value) {
                                $('#error-' + key).html(value[0]);
                            });
                        } else {
                            // Handle success response here, e.g., show success message, clear form, etc.
                            console.log(response);
                            // Clear the form after successful submission
                            $('#task_form')[0].reset();
                        }
                    },
                    error: function() {
                        $('.save_task').text('Add Task');
                        $(".save_task").prop("disabled", false);
                        toastr.error('something went wrong');
                    },
                });

            });


            //Edit Task
            $('#taskTable').on('click', '.edit_task', function(e) {
                e.preventDefault();

                var id = $(this).attr('data');

                $('#edit_task_modal').modal('show');

                $.ajax({

                    type: 'ajax',
                    method: 'get',
                    url: '{{ url('edit_tasks') }}',
                    data: {
                        id: id
                    },
                    async: false,
                    dataType: 'json',
                    success: function(data) {

                        $('input[name=task_id]').val(data.tasks.id);
                        $('input[name=title]').val(data.tasks.title);
                        $('input[name=due_date]').val(data.tasks.due_date);
                        $('textarea[name=description]').val(data.tasks.description);
                    },

                    error: function() {

                    }

                });

            });


            //Update Category
            $('.update_task').on('click', function(e) {
                e.preventDefault();


                let EditFormData = new FormData($('#update_task_form')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ url('update_tasks') }}",
                    data: EditFormData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function() {
                        $('.update_task').text('Waiting...');
                        $(".update_task").prop("disabled", true);
                    },
                    success: function(response) {

                        if (response.status == 200) {
                            $('#edit_task_modal').modal('hide');
                            $('#update_task_form').find('input').val("");
                            $('.update_task').text('Save changes');
                            $(".update_task").prop("disabled", false);
                            getTasks();
                        }

                        if (response.errors) {
                            $('.update_task').text('Save changes');
                            $(".update_task").prop("disabled", false);
                        }
                    },
                    error: function() {
                        $('.update_task').text('Save changes');
                        $(".update_task").prop("disabled", false);
                    }
                });

            });

        });
    </script>
@endsection
