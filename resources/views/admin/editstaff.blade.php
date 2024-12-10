@extends('layouts.app')

@section('content')
 <div class="container"> 
 <form action="/editstaffs/{{$user->id}}" method="POST">
        @csrf
        {{-- @method('PUT') --}}
          <div class="form-group col-md-4">
            <label for="inputFname">First Name: </label>
            <input type="text" name="firstName" value="{{ $user->firstName }}" class="form-control" id="inputFname" placeholder="">
          </div> <br />
          <div class="form-group col-md-4">
            <label for="inputLname">Last Name:</label>
            <input type="text" name="lastName" value="{{ $user->lastName }}" class="form-control" id="inputLname" placeholder="">
          </div>
            <div class="form-group col-md-4">
              <label for="inputPassword4">Password:</label>
              <input type="password" name="password" value="{{ $user->password }}" class="form-control" id="inputPassword4" placeholder="">
            </div>
       
        <div class="form-group col-md-2">
          <label for="inputStaffID">Staff ID</label>
          <input type="text" name="staffID" value="{{ $user->staffID }}" class="form-control" id="inputStaffID" placeholder=" ">
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
        <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>

                   
                </div>
            </div>
        </div>
    </div>
</div> 


{{-- 
<h1>Add admin</h1>
<form action="" method="post" enctype="multipart/form-data">
<form action="" method="post">
<div class="form-group">
<label for="name">Name</label>
<input type="text" class="form-control" name="admin_name">	
</div>
  <div class="form-group">
    <label for="name">Email</label>
          <input type="text" class="form-control" name="email">	
</div>
<div class="form-group">
    <label for="name">Password</label>
          <input type="text" class="form-control" name="password">	
</div>

<div class="form-group">
    <label for="name">Confirm Password</label>
          <input type="text" class="form-control" name="pword">	
</div>

<div class="form-group">
<label for="image">Upload Image</label>
<input type="file" name="pic" class="form-control">

</div>


<div class="form-group">
<button class="btn btn-primary" type="submit" name="add_admin">Add Admin</button>


</div>
</div>




</div> --}}
@endsection