@extends('layouts.app')

@section('content')
<h1>All Tasks</h1>
<a href="{{ route('tasks.create') }}" class="btn btn-primary"> Add Task </a>
<ul>
    @foreach ($tasks as $task)
    <li>{{ $task->title }}</li>
    @endforeach
</ul>
{{ $tasks->links() }}
@endsection