

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
        <li><a href="/">Inicio</a></li>
    </ul>
</nav>

<style>
    
.navbar {
    background-color: #4CAF50;
    padding: 10px 20px;
    border-radius: 5px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar ul {
    list-style: none;
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.navbar ul li {
    margin: 0 15px;
}

.navbar ul li a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    font-weight: bold;
    transition: color 0.3s ease;
}

.navbar ul li a:hover {
    color: #f4d03f;
}

/* Responsive Design */
@media (max-width: 768px) {
    .navbar ul {
        flex-direction: column;
    }

    .navbar ul li {
        margin: 10px 0;
    }
}

</style>
