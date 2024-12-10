@extends('layouts.layout')

@section('content')
        <div class="wrapper staff-details">
        <h1> Leave History for {{ $staff->name}}</h1>
        <p class="leave_type">Type - {{$staff->leave_type}}</p>
        <p class="status">Status - {{$staff->status}}</p>
        </div>

        @endsection
   


        