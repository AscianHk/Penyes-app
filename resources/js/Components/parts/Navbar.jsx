import React from 'react';

const Navbar = () => {
    return (
        <nav className="navbar">
            <div className="navbar-container">
                <a href="/" className="navbar-brand">Penyes La Vall</a>
                <div className="navbar-links">
                    <a href="/draw">Sorteo</a>
                    <a href="/panel">Panel</a>
                    <a href="/logout">Cerrar Sesión</a>
                </div>
            </div>
        </nav>
    );
};

export default Navbar;