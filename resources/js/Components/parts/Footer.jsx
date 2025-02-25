import React from 'react';

const Footer = () => {
    return (
        <footer className="footer">
            <div className="footer-content">
                <div className="footer-brand">
                    <h3>Penyes La Vall</h3>
                </div>
                <div className="footer-contact">
                    <p>¿Necesitas ayuda?</p>
                    <button onClick={() => {/* Add contact form logic */}} className="contact-btn">
                        Contáctanos
                    </button>
                </div>
                <div className="footer-copyright">
                    <p>&copy; {new Date().getFullYear()} Penyes La Vall. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
    );
};

export default Footer;