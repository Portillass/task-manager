@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Task Details</h2>

    <div class="card p-3">
        <p><strong>Title:</strong> {{ $task->title }}</p>
        <p><strong>Description:</strong> {{ $task->description }}</p>
        <p><strong>Assigned To:</strong> {{ $task->user->first_name ?? 'N/A' }}</p>
        <p><strong>Created By:</strong> {{ $task->creator->first_name ?? 'N/A' }}</p>
        <p><strong>Priority:</strong> {{ $task->priority }}</p>
        <p><strong>Status:</strong> {{ $task->status }}</p>
        <p><strong>Due Date:</strong> {{ $task->due_date ? $task->due_date->format('Y-m-d H:i') : 'N/A' }}</p>
        <p><strong>Completed At:</strong> {{ $task->completed_at ? $task->completed_at->format('Y-m-d H:i') : 'N/A' }}</p>
    </div>

    <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
