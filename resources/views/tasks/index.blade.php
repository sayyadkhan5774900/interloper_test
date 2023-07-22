@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">All Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3"> Add Task </a>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <th scope="row" {{$loop->iteration}} </th>
                    <td>{{$task->title}} </td>
                    <td>{{$task->description}} </td>
                    <td>
                        @if($task->completed_at)
                        <span class="badge bg-success">Completed</span>
                        @else
                        <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        @unless ($task->completed_at)
                        <button class="btn btn-success complete-btn" task-id="{{ $task->id }}">Mark as Completed</button>
                        @endunless
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $tasks->links() }}
</div>
@endsection