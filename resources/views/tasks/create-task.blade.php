@extends('layouts.app')
@section('content')



<section class="container dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Tasks</h5>
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success my-3">Add Task</a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="" id="storecolor" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="errMsgContainer"></div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" name="title" class="form-control" id="title">
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Description</label>
                                                <input type="text" name="description" class="form-control" id="description">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary add_task">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Default Table -->
                        <table class="table" id="colorTable">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Complete</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $key => $task)
                                <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$task->title}}</td>
                                <td>{{$task->description}}</td>
                                @if($task->completed == 0)
                                <td><a href="{{url('mark-read', $task->id)}}" style="cursor: pointer;" class="badge bg-info p-2 complete-task" data-mark-id="{{ $task->id }}"> Incomplete </a></td>
                                @else
                                <td>Completed</td>
                                @endif
                                    <td scope="col">
                                        <a style="cursor: pointer;" class="badge bg-primary update_task" data-bs-toggle="modal" data-bs-target="#editModal" data-task-id="{{$task->id}}" data-task-title="{{$task->title}}"  data-task-description="{{$task->description}}">Edit</a>
                                        <a style="cursor: pointer;" class="badge bg-danger delete-task" data-task-id="{{ $task->id }}">Delete</a>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="" id="editcolor" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="errMsgContainer"></div>
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Title</label>
                                                        <input type="hidden" class="task_id" id="task_id">
                                                        <input type="text" name="up_title" class="form-control up_title" id="up_title">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Description</label>
                                                        <input type="text" name="up_description" class="form-control up_description" id="up_description">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary edit_task">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                {!! $tasks->links() !!}
                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
                    </div>
                </div>

            </div>
        </div><!-- End Left side columns -->

    </div>
</section>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        // --------- add new task 
        $(document).on('click', '.add_task', function(e) {
            e.preventDefault();
            let title = $('#title').val();
            let description = $('#description').val();
            // alert('hiii');
            $.ajax({
                url: "{{ route('store-task') }}",
                method: 'post',
                data: {
                    title: title,
                    description: description,
                },
                success: function(response) {
                    console.log(response.status)
                    if (response.status === 'success') {

                        $('#title').val('');
                        $('#description').val('');
                        $('#exampleModal').modal('hide');
                        $('.table').load(location.href + ' .table');

                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $('.errMsgContainer').empty();
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>' + '<br>');
                    });
                }
            });
        });
        // --------- delte color
        $(document).on('click', '.delete-task', function(e) {
            e.preventDefault();

            var taskId = $(this).data('task-id');

            $.ajax({
                type: 'DELETE',
                url: '/delete-task/' + taskId,
                success: function(response) {
                    $('.table').load(location.href + ' .table');

                },
                error: function() {
                    console.error('Error deleting task.');
                }
            });
        });
        // --------- edit color 
        $(document).on('click', '.update_task', function(e) {
            let taskId = $(this).data('task-id');
            let newtitle = $(this).data('task-title');
            let newdescription = $(this).data('task-description');
            $('.up_title').val(newtitle);
            $('.task_id').val(taskId);
            $('.up_description').val(newdescription);
            

            $(document).on('click', '.edit_task', function(e) {
                e.preventDefault();
                let up_id = $('#task_id').val();
                let up_title = $('#up_title').val();
                let up_description = $('#up_description').val();
                console.log(up_id);
                // console.log(up_title);
                // console.log(up_description);
                $.ajax({
                    url: "{{ route('task-update') }}",
                    method: 'post',
                    data: {
                        up_id: up_id,
                        up_title: up_title,
                        up_description: up_description,
                    },
                    success: function(response) {
                        console.log(response.status);
                        // On success, update the table with the new data
                        if (response.status === 'success') {
                            // $('.up_name').val('');
                            $('.errMsgContainer').empty();
                            $('#editModal').modal('hide');
                            $('.table').load(location.href + ' .table');
                        }
                    },
                    error: function(err) {
                        let error = err.responseJSON;
                        $('.errMsgContainer').empty();
                        $.each(error.errors, function(index, value) {
                            $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>' + '<br>');
                        });
                    }
                });
            });
        });
         // --------- mark task
         $(document).on('click', '.complete-task', function(e) {
            e.preventDefault();

            var taskId = $(this).data('mark-id');

            $.ajax({
                type: 'GET',
                url: '/complete-task/' + taskId, 
                success: function(response) {
                    $('.table').load(location.href + ' .table');
                },
                error: function() {
                    console.error('Error mark task.');
                }
            });
        });
    });
</script>
@endpush