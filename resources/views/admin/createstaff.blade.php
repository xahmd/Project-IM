@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h3 class="text-center mb-4">Create New Staff</h3>
                    <form action="{{ url('createstaff') }}" method="POST">
                        @csrf
                        
                        <!-- First Name -->
                        <div class="form-group">
                            <label for="inputFname" class="font-weight-bold">First Name</label>
                            <input type="text" name="firstName" class="form-control" id="inputFname" placeholder="Enter first name" required>
                        </div>

                        <!-- Last Name -->
                        <div class="form-group">
                            <label for="inputLname" class="font-weight-bold">Last Name</label>
                            <input type="text" name="lastName" class="form-control" id="inputLname" placeholder="Enter last name" required>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="inputPassword4" class="font-weight-bold">Password</label>
                            <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Enter password" required>
                        </div>

                        <!-- Staff ID -->
                        <div class="form-group">
                            <label for="inputStaffID" class="font-weight-bold">Staff ID</label>
                            <input type="text" name="staffID" class="form-control" id="inputStaffID" placeholder="Enter staff ID" required>
                        </div>

                        <!-- Role -->
                        <div class="form-group">
                            <label for="inputRole" class="font-weight-bold">Role</label>
                            <select id="inputRole" name="role" class="form-control" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="LineManager">Line Manager</option>
                                <option value="RegularStaff">Regular Staff</option>
                            </select>
                        </div>

                        <!-- Line Manager (Visible when LineManager role is selected) -->
                        <div class="form-group" id="managerField">
                            <label for="inputManagerID" class="font-weight-bold">Line Manager</label>
                            <select id="inputManagerID" name="managerID" class="form-control" required>
                                <option value="" disabled selected>Select Line Manager</option>
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->staffID }}">{{ $manager->firstName }} {{ $manager->lastName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Create Staff</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    /* Add custom styles for the form */
    .form-group input, .form-group select {
        border-radius: 0.375rem;  /* Rounded corners for input fields */
        box-shadow: none;
        transition: box-shadow 0.3s ease-in-out;
    }
    
    .form-group input:focus, .form-group select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 0.375rem;
        padding: 12px 24px;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .card {
        border: none;
        border-radius: 0.5rem;
    }

    .card-body {
        padding: 3rem;
    }
</style>
@endsection
