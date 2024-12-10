@extends('layouts.app')

@section('content')
 <div class="container"> 
 <form action="{{ url('createstaff') }}" method="POST">
        @csrf
          <div class="form-group col-md-4">
            <label for="inputFname">First Name: </label>
            <input type="text" name="firstName" class="form-control" id="inputFname" placeholder="">
          </div> <br />
          <div class="form-group col-md-4">
            <label for="inputLname">Last Name:</label>
            <input type="text" name="lastName" class="form-control" id="inputLname" placeholder="">
          </div>
            <div class="form-group col-md-4">   
              <label for="inputPassword4">Password:</label>
              <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="">
            </div>
       
        <div class="form-group col-md-2">
          <label for="inputStaffID">Staff ID</label>
          <input type="text" name="staffID" class="form-control" id="inputStaffID" placeholder=" ">
        </div>
        <div class="form-group col-md-2">
          <label for="inputRole">Role</label>
          <select id="inputRole" name="role" class="form-control">
            <option selected>Select...</option>
            <option value="LineManager">Line Manager</option>
            <option value="RegularStaff">Regular Staff</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="inputRole">Line Manager</label>
          <select id="inputRole" name="managerID" class="form-control">
            <option></option>
            @foreach ($managers as $manager)
          <option value="{{$manager->staffID}}">{{$manager->firstName}} {{$manager->lastName}}</option>
            @endforeach
          
          </select> 
        
        </div>
     
       
      
        <div class="form-group col-md-4">
        <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </form>

                   
                </div>
            </div>
        </div>
    </div>
</div> 

@endsection