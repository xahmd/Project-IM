@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
        <div class="alert alert-success col-md-6 offset-md-3">
            <p>{{ $message }}</p>
        </div>
    @endif

    
    
@if ($message = Session::get('danger'))
<div class="alert alert-danger col-md-6 offset-md-3">
    <p>{{ $message }}</p>
</div>
@endif

    
<table class="table">
    <thead class="thead-primary">
      <tr>
        
        <th scope="col">Name</th>
        <th scope="col">Staff ID</th>
        <th scope="col">Time</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Resumption Date</th>
        <th scope="col">LeaveType</th>
        <th scope="col">LeaveBalance(i)</th>
        <th scope="col">LeaveBalance(f)</th>
        <!-- <th scope="col">TotalLeave</th> -->
        <th scope="col">Status</th>
        <th scope="col">Rejection Reason</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($approvals as $approval)
        <tr>
            
    <td>{{$approval->name}}</td>
    <td>{{$approval->staffID}}</td>
    <td>{{$approval->requested_at}}</td>
    <td>{{$approval->startdate}}</td>
    <td>{{$approval->enddate}}</td>
    <td>{{$approval->resumdate}}</td>
    <td>{{$approval->leave_type}}</td>
    <td>{{$approval->initial_leave_bal}}</td>
    <td>{{$approval->final_leave_bal}}</td>
    <td>{{$approval->status}}</td>
    <td>{{$approval->Reason}}</td>


@if(Auth::user()->role == 'LineManager')
    <td>


@if ($approval->status == 'Pending' )

    <form action="/approval/{{$approval->id}}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="approved">
        <button type="submit" class="btn btn-info">Approve</button> </form>


        <!-- Button trigger modal -->
<button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#exampleModal">
    Reject
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reason</h5>
         
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/rejection/{{$approval->id}}" method="POST">
        <div class="modal-body">
           
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="rejected">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1"> </label>
                    <textarea class="form-control" name="Reason" id="exampleFormControlTextarea1" rows="3"></textarea>
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

  
{{ $approvals->links() }}

  @endsection