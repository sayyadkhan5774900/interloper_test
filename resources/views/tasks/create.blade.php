@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Create New Task</h1>
    <form id="createTaskForm">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Task Title:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Task Description:</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <a href="{{ url('/tasks') }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>
@endsection