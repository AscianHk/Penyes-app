        @php
            $user = Auth::user();
        @endphp
        <nav class="navbar">
    <div class="navbar-brand">
        <a href="/" class="logo">Penyes La Vall</a>
    </div>
    <ul class="nav-links">
        <li><a href="/">Inicio</a></li>
        @auth
            @if($user && $user->role && $user->role->isAdmin)
                <li><a href="/AdminPanel">Panel Admin</a></li>
            @else
                <li><a href="/UserPanel">Mi Panel</a></li>
            @endif
            <li><a href="/logout">Cerrar Sesión</a></li>
        @else
            <li><a href="/login">Iniciar Sesión</a></li>
            <li><a href="/register">Registro</a></li>
        @endauth


        
    </ul>
</nav>

<style>
.navbar {
    background-color: #222;
    padding: 15px 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    border: 1px solid #333;
    margin: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar-brand {
    flex-shrink: 0;
}

.navbar-brand .logo {
    color: #4CAF50;
    font-size: 1.5rem;
    font-weight: bold;
    text-decoration: none;
    letter-spacing: 1px;
}

.nav-links {
    list-style: none;
    display: flex;
    align-items: center;
    gap: 30px;
    margin: 0;
    padding: 0;
}

.nav-links li {
    margin: 0;
}

.nav-links li a {
    text-decoration: none;
    color: #ccc;
    font-size: 1.1rem;
    font-weight: 500;
    transition: all 0.3s ease;
    padding: 8px 16px;
    border-radius: 8px;
    border: 1px solid transparent;
}

.nav-links li a:hover {
    color: #4CAF50;
    background-color: rgba(76, 175, 80, 0.1);
    border-color: #4CAF50;
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .navbar {
        flex-direction: column;
        padding: 15px;
        gap: 15px;
        margin: 10px;
    }

    .nav-links {
        flex-direction: column;
        width: 100%;
        gap: 10px;
    }

    .nav-links li a {
        display: block;
        text-align: center;
        padding: 12px 24px;
    }
}
</style>


