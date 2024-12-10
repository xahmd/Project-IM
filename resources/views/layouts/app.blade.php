<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
       
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
              @guest
            <a class="navbar-brand" href="{{ url('/') }}">LeaveApp</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            @else
            <a class="navbar-brand" href="{{ url('/') }}">LeaveApp</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            @if(Auth::user()->role == 'Admin')
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Staff Management
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="{{ url('createstaff') }}">Create Staff</a>
                      <a class="dropdown-item" href="{{ url('allstaffs') }}">All Staffs</a>
                      
                    </div>
                  </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Leave Management
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('/staff/adminLeaveHistory') }}">Leave History</a>
                  
                  </div>
                </li>
                
              </ul> 
            </div>


            @elseif(Auth::user()->role == 'LineManager')

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Leave Management
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('/staff/managerLeaveHistory') }}">Leave Approval</a>
                    {{-- <a class="dropdown-item" href="{{ url(' ') }}">Approval status</a> --}}
                  
                  </div>
                </li>
                
              </ul> 
            </div>
            @else
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Leave Management
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('/staff/approval') }}">Leave History</a>
                    <a class="dropdown-item" href="{{ url('createleave') }}">Apply for Leave</a>
                  
                  </div>
                </li>
                
              </ul> 
            </div>

            @endif

            <ul class="navbar-nav">
              
              <li class="nav-item  float-right">
                <a class="nav-link" href="{{ route('logout') }}" aria-haspopup="true" aria-expanded="false"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
            </ul>
            @endguest
          </nav>
          

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
