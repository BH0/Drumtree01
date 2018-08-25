
<nav class="navbar navbar-expand-lg navbar-light bg-light"> 
    <ul class="navbar-nav">
        @if (Auth::user()) 
            <li class="nav-item"> 
                <a class="nav-link" href="{{ route('signout') }}">Signout</a> 
            </li> 
            <li class="nav-item"> 
                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a> 
            </li> 
        @else 
            <li class="nav-item"> 
                <a class="nav-link" href="{{ route('welcome') }}">Sign in/Sign up</a> 
            </li> 
        @endif 
        <li class="nav-item">
            <a class="nav-link" href="{{ route('drums') }}">View Drums</a> 
        </li> 
    </ul> 
</nav> 