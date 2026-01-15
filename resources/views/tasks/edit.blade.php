@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Task</h2>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $task->title) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Assign To</label>
            <select class="form-control" name="user_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $task->user_id)==$user->id?'selected':'' }}>{{ $user->first_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Priority</label>
            <select class="form-control" name="priority">
                <option value="Low" {{ $task->priority=='Low'?'selected':'' }}>Low</option>
                <option value="Medium" {{ $task->priority=='Medium'?'selected':'' }}>Medium</option>
                <option value="High" {{ $task->priority=='High'?'selected':'' }}>High</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" name="status">
                <option value="Todo" {{ $task->status=='Todo'?'selected':'' }}>Todo</option>
                <option value="InProgress" {{ $task->status=='InProgress'?'selected':'' }}>In Progress</option>
                <option value="Done" {{ $task->status=='Done'?'selected':'' }}>Done</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="datetime-local" class="form-control" name="due_date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d\TH:i') : '') }}">
        </div>

        <button type="submit" class="btn btn-success">Update Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
