@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Role Details</h2>

    <div class="card p-3">
        <p><strong>ID:</strong> {{ $role->id }}</p>
        <p><strong>Role Name:</strong> {{ $role->role_name }}</p>
        <p><strong>Description:</strong> {{ $role->role_description }}</p>
        <p><strong>Created At:</strong> {{ $role->created_at->format('Y-m-d H:i') }}</p>
        <p><strong>Updated At:</strong> {{ $role->updated_at->format('Y-m-d H:i') }}</p>
    </div>

    <a href="{{ route('roles.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
