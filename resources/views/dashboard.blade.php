@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Dashboard</h2>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>

    <p>Welcome, {{ auth()->user()->first_name }}!</p>

    <!-- Display User Role -->
    <p>
        Role: {{ auth()->user()->role ? auth()->user()->role->role_name : 'N/A' }}
    </p>

    <div class="row mt-4">

        <!-- Admin Quick Links -->
        @if(auth()->user()->hasRole('admin'))
            <div class="col-md-3">
                <div class="card p-3 text-center">
                    <h5>Manage Users</h5>
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm mt-2">Go</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3 text-center">
                    <h5>Manage Roles</h5>
                    <a href="{{ route('roles.index') }}" class="btn btn-warning btn-sm mt-2">Go</a>
                </div>
            </div>
        @endif

        <!-- Task Links (All Users) -->
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <h5>My Tasks</h5>
                <a href="{{ route('tasks.index') }}" class="btn btn-success btn-sm mt-2">View Tasks</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 text-center">
                <h5>Create Task</h5>
                <a href="{{ route('tasks.create') }}" class="btn btn-info btn-sm mt-2">New Task</a>
            </div>
        </div>

    </div>

    <!-- Recent Tasks Table -->
    <div class="mt-5">
        <h4>Recent Tasks</h4>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Assigned To</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach(auth()->user()->tasks()->latest()->take(5)->get() as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->user->first_name ?? 'N/A' }}</td>
                        <td>{{ $task->priority }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d H:i') : 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-2">View All Tasks</a>
    </div>
</div>
@endsection
