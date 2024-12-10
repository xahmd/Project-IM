@extends('layouts.app')

@section('content')
 <div class="container"> 
 <form action="{{ url('createleave') }}" method="POST">
        @csrf
         
          <div class="form-group col-md-2">
            <label for="inputLeaveType">Leave Type: </label>
            <select id="inputLeaveType" name="leave_type" class="form-control">
              @foreach ($leave as $leavetype)
              <option value="{{$leavetype->name}}">{{$leavetype->name}} </option>
              @endforeach
            </select>
          </div>


          <div class="form-group col-md-2">
            <label for="inputSdate">Start Date:</label>
            <input type="date" name="startdate" class="form-control" id="inputLname" placeholder="">
          </div>
            <div class="form-group col-md-2">
              <label for="inputEdate">End Date:</label>
              <input type="date" name="enddate" class="form-control" id="inputEdate" placeholder="">
            </div>

            <div class="form-group col-md-2">
                <label for="inputRdate">Resumption Date:</label>
                <input type="date" name="resumdate" class="form-control" id="inputRdate" placeholder="">
              </div>
  
       
      
        <div class="form-group col-md-4">
        <button type="submit" class="btn btn-primary">Apply</button>
        </div>
      </form>

                   
                </div>
            </div>
        </div>
    </div>
</div> 

@endsection