@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Apply for Leave</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('createleave') }}" method="POST" id="leaveForm">
                        @csrf
                        <div class="form-group">
                            <label for="inputLeaveType" class="font-weight-bold">Leave Type:</label>
                            <select id="inputLeaveType" name="leave_type" class="form-control" required>
                                <option disabled selected>Select a leave type</option>
                                @foreach ($leave as $leavetype)
                                <option value="{{ $leavetype->name }}">{{ $leavetype->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputSdate" class="font-weight-bold">Start Date:</label>
                                <input type="date" name="startdate" class="form-control" id="inputSdate" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEdate" class="font-weight-bold">End Date:</label>
                                <input type="date" name="enddate" class="form-control" id="inputEdate" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputRdate" class="font-weight-bold">Resumption Date:</label>
                            <input type="date" name="resumdate" class="form-control" id="inputRdate" required>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitButton">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('leaveForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Perform the form submission via AJAX
        const form = event.target;
        const formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            // Check if the response is OK
            if (response.ok) {
                return response.json();
            } else {
                // If not, throw an error
                console.error('Error in response:', response);
                throw new Error('Form submission failed');
            }
        })
        .then(data => {
            // Show SweetAlert success message
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Your leave application has been submitted successfully!',
                confirmButtonText: 'OK'
            }).then(() => {
                // Redirect to /home after the alert
                window.location.href = "{{ url('/home') }}";
            });
        })
        .catch(error => {
            console.error('Error occurred:', error);
            // Show SweetAlert error message
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while submitting your application. Please try again later.'
            });
        });
    });
</script>
@endsection
