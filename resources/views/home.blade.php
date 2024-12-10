@extends('layouts.app')

@section('content')





@if(Auth::user()->role == 'Admin')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard for the Admin</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Welcome Admin to your portal!<br />
                  
                </div>
            </div>
        </div>
    </div>
</div>

@elseif(Auth::user()->role == 'LineManager')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard for Line Managers</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome {{Auth::user()->firstName }}  {{Auth::user()->lastName}} <br />
                    {{-- Welcome {{Auth::user()->firstName }}  {{Auth::user()->lastName}} <br />
                    Welcome {{Auth::user()->firstName }}  {{Auth::user()->lastName}} <br /> --}}
                    
                </div>
            </div>
        </div>
    </div>
</div>



@else
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard for Regular staffs</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                    Welcome {{Auth::user()->firstName }}  {{Auth::user()->lastName}}<br />
                    



                </div>
            </div>
        </div>
    </div>
</div>
@endif



@endsection
