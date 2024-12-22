@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Success Message -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success text-center col-md-8 offset-md-2 mb-4">
        <p>{{ $message }}</p>
    </div>
    @endif

    <!-- Error Message -->
    @if ($message = Session::get('danger'))
    <div class="alert alert-danger text-center col-md-8 offset-md-2 mb-4">
        <p>{{ $message }}</p>
    </div>
    @endif

    <!-- Staff Table -->
    <div class="card shadow-lg">
        <div class="card-body">
            <h3 class="text-center mb-4">All Staffs</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Staff ID</th>
                            <th scope="col">Role</th>
                            <th scope="col">Line Manager</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allStaffs as $allstaff)
                        <tr>
                            <td>{{ $allstaff->firstName }}</td>
                            <td>{{ $allstaff->lastName }}</td>
                            <td>{{ $allstaff->staffID }}</td>
                            <td>{{ $allstaff->role }}</td>
                            <td>{{ $allstaff->managerID }}</td>
                            <td>
                                <!-- Delete Button -->
                                <form action="/allstaffs/{{$allstaff->id}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>

                                <!-- Edit Button -->
                                <a href="/editstaffs/{{$allstaff->id}}" class="d-inline">
                                    <button type="button" class="btn btn-info btn-sm ml-2">Edit</button>
                                </a>
                            </td>
                        </tr>  
                        @endforeach    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="text-center mt-4">
        {{ $allStaffs->links() }}
    </div>
</div>

@endsection

@section('styles')
<style>
    /* Table Style */
    .table {
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        vertical-align: middle;
    }

    .table th {
        background-color: #343a40;
        color: white;
    }

    .table td {
        font-size: 14px;
    }

    /* Card Style */
    .card {
        border: none;
        border-radius: 10px;
    }

    .card-body {
        padding: 2rem;
    }

    /* Button Styling */
    .btn {
        padding: 8px 16px;
        border-radius: 5px;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }

    /* Pagination Styling */
    .pagination {
        justify-content: center;
    }

    /* Alert Styling */
    .alert {
        font-weight: bold;
        border-radius: 0.375rem;
    }
</style>
@endsection
