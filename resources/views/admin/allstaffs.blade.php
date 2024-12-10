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
        
        <th scope="col">FirstName</th>
        <th scope="col">LastName</th>
        <th scope="col">ID</th>
        <th scope="col">Role</th>
        <th scope="col">Line Manager</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($allStaffs as $allstaff)
        <tr>
            
    <td>{{$allstaff->firstName}}</td>
    <td>{{$allstaff->lastName}}</td>
    <td>{{$allstaff->staffID}}</td>
    <td>{{$allstaff->role}}</td>
    <td>{{$allstaff->managerID}}</td>

    <td>
          
<form action="/allstaffs/{{$allstaff->id}}" method="POST">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Delete</button> </form>
    </td>

    <td>
          
    <a href="/editstaffs/{{$allstaff->id}}"> <button type="button" class="btn btn-info">Edit</button></a>
       
       
            </td>
          </tr>  
        @endforeach    
    </tbody>
  </table>



{{ $allStaffs->links() }}


@endsection