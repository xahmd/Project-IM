@extends('layouts.layout')

@section('content')

<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Welcome to Leaves Applying System
        </div>

        <div class="description">
            <p>Manage your leave applications effortlessly with our user-friendly platform. Check your leave balance, apply for leave, and track your application status all in one place.</p>
        </div>

        <div class="features">
            <ul>
                <li>Easily apply for leave online</li>
                <li>Track your leave history</li>`
                <li>Get real-time updates on your application status</li>
                <li>Manage your leave balance efficiently</li>
            </ul>
        </div>

        <div class="actions">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endauth
        </div>
    </div>
</div>

@endsection
