@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h1 class="card-title mb-3">Welcome to the Task Management System</h1>
                    <p class="card-text mb-4">Organize your tasks, manage roles, and boost productivity.</p>

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg m-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-success btn-lg m-2">Register</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-info btn-lg m-2">Go to Dashboard</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
