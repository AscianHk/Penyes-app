

<nav class="navbar">
    <ul>
        @auth
            <li><a href="/logout">Logout</a></li>
        @endauth
        
        @guest
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
        @endguest
        
        @php
            $user = Auth::user();
        @endphp
        @auth
            @if($user && $user->role && $user->role->isAdmin )
                <li><a href="/AdminPanel">Homepage</a></li>
            @else
                <li><a href="/UserPanel">Homepage</a></li>
            @endif  
        @endauth
        <li><a href="/crews">Peñas</a></li>
    </ul>
</nav>
