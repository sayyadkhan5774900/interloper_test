@extends('layouts.app')

@section('content')
<h1>Create New Task</h1>
<form id="createTaskForm">
    @csrf
    <label for="title">Task Title:</label>
    <input type="text" name="title" required>
    <br>
    <label for="description">Task Description:</label>
    <textarea name="description" required></textarea>
    <br>
    <button type="submit">Create Task</button>
</form>
@endsection