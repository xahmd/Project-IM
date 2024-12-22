@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h3 class="text-center mb-4">Edit Staff Details</h3>

                    <form action="/editstaffs/{{$user->id}}" method="POST">
                        @csrf
                        {{-- @method('PUT') --}}

                        <!-- First Name Field -->
                        <div class="form-group">
                            <label for="inputFname">First Name</label>
                            <input type="text" name="firstName" value="{{ $user->firstName }}" class="form-control" id="inputFname" placeholder="Enter First Name">
                        </div>

                        <!-- Last Name Field -->
                        <div class="form-group">
                            <label for="inputLname">Last Name</label>
                            <input type="text" name="lastName" value="{{ $user->lastName }}" class="form-control" id="inputLname" placeholder="Enter Last Name">
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="inputPassword4">Password</label>
                            <input type="password" name="password" value="{{ $user->password }}" class="form-control" id="inputPassword4" placeholder="Enter Password">
                        </div>

                        <!-- Staff ID Field -->
                        <div class="form-group">
                            <label for="inputStaffID">Staff ID</label>
                            <input type="text" name="staffID" value="{{ $user->staffID }}" class="form-control" id="inputStaffID" placeholder="Enter Staff ID">
                        </div>

                        <!-- Role Field -->
                        <div class="form-group">
                            <label for="inputRole">Role</label>
                            <select id="inputRole" name="role" class="form-control">
                                <option selected>Select Role...</option>
                                <option value="LineManager" {{ $user->role == 'LineManager' ? 'selected' : '' }}>Line Manager</option>
                                <option value="RegularStaff" {{ $user->role == 'RegularStaff' ? 'selected' : '' }}>Regular Staff</option>
                            </select>
                        </div>

                        <!-- Line Manager Field -->
                        <div class="form-group">
                            <label for="inputManagerID">Line Manager</label>
                            <select id="inputManagerID" name="managerID" class="form-control">
                                <option value="">Select Line Manager</option>
                                @foreach ($managers as $manager)
                                <option value="{{ $manager->staffID }}" {{ $user->managerID == $manager->staffID ? 'selected' : '' }}>
                                    {{ $manager->firstName }} {{ $manager->lastName }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Update Button -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Update</button>
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
    /* Card Styling */
    .card {
        border-radius: 10px;
    }

    .card-body {
        padding: 2rem;
    }

    /* Input and Select Field Styling */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-control {
        border-radius: 5px;
        box-shadow: none;
        padding: 0.75rem;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.25rem rgba(38, 143, 255, 0.25);
    }

    /* Button Styling */
    .btn {
        border-radius: 5px;
        padding: 10px 30px;
        font-size: 16px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }

        .btn {
            font-size: 14px;
            padding: 8px 20px;
        }
    }
</style>
@endsection
