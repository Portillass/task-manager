@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tasks</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filters -->
    <form method="GET" action="{{ route('tasks.index') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Search title/description" value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-control">
                <option value="">All Status</option>
                <option value="Todo" {{ request('status')=='Todo' ? 'selected' : '' }}>Todo</option>
                <option value="InProgress" {{ request('status')=='InProgress' ? 'selected' : '' }}>In Progress</option>
                <option value="Done" {{ request('status')=='Done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="priority" class="form-control">
                <option value="">All Priority</option>
                <option value="Low" {{ request('priority')=='Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ request('priority')=='Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ request('priority')=='High' ? 'selected' : '' }}>High</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="user_id" class="form-control">
                <option value="">All Users</option>
                @if(isset($users) && $users->count())
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id')==$user->id ? 'selected' : '' }}>
                            {{ $user->first_name }} {{ $user->last_name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <!-- Create Task Button -->
    <div class="mb-3">
        <a href="{{ route('tasks.create') }}" class="btn btn-success">Create Task</a>
    </div>

    <!-- Tasks Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Assigned To</th>
                    <th>Created By</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->user->first_name ?? 'N/A' }}</td>
                        <td>{{ $task->creator->first_name ?? 'N/A' }}</td>
                        <td>{{ $task->priority }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->due_date ? $task->due_date->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this task?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div>
        {{ $tasks->withQueryString()->links() }}
    </div>
</div>
@endsection
