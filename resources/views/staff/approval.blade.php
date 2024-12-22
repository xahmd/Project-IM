@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success col-md-6 offset-md-3 text-center">
        <p>{{ $message }}</p>
    </div>
@endif

@if ($message = Session::get('danger'))
    <div class="alert alert-danger col-md-6 offset-md-3 text-center">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h3 class="text-center mb-4">Leave Approvals</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Staff ID</th>
                            <th scope="col">Time</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Resumption Date</th>
                            <th scope="col">Leave Type</th>
                            <th scope="col">Initial Leave Balance</th>
                            <th scope="col">Final Leave Balance</th>
                            <th scope="col">Status</th>
                            <th scope="col">Rejection Reason</th>
                            @if(Auth::user()->role == 'LineManager')
                                <th scope="col">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approvals as $approval)
                        <tr>
                            <td>{{ $approval->name }}</td>
                            <td>{{ $approval->staffID }}</td>
                            <td>{{ $approval->requested_at }}</td>
                            <td>{{ $approval->startdate }}</td>
                            <td>{{ $approval->enddate }}</td>
                            <td>{{ $approval->resumdate }}</td>
                            <td>{{ $approval->leave_type }}</td>
                            <td>{{ $approval->initial_leave_bal }}</td>
                            <td>{{ $approval->final_leave_bal }}</td>
                            <td>
                                <span class="badge 
                                    @if($approval->status == 'Approved') badge-success 
                                    @elseif($approval->status == 'Pending') badge-warning 
                                    @else badge-danger @endif">
                                    {{ $approval->status }}
                                </span>
                            </td>
                            <td>{{ $approval->Reason }}</td>
                            @if(Auth::user()->role == 'LineManager')
                                <td>
                                    @if ($approval->status == 'Pending')
                                        <!-- Approve Button -->
                                        <form action="/approval/{{ $approval->id }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>

                                        <!-- Reject Button -->
                                        <button type="button" class="btn btn-danger btn-sm mt-2" data-toggle="modal" data-target="#rejectModal{{ $approval->id }}">
                                            Reject
                                        </button>

                                        <!-- Reject Modal -->
                                        <div class="modal fade" id="rejectModal{{ $approval->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel{{ $approval->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rejectModalLabel{{ $approval->id }}">Rejection Reason</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/rejection/{{ $approval->id }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="reasonTextarea{{ $approval->id }}">Reason</label>
                                                                <textarea class="form-control" name="Reason" id="reasonTextarea{{ $approval->id }}" rows="3" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Reject</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="text-center">
    {{ $approvals->links() }}
</div>

@endsection
