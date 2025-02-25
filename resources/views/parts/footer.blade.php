<meta name="csrf-token" content="{{ csrf_token() }}">


<footer class="footer">
    <div class="footer-content">
        <div class="footer-brand">
            <h3>Penyes La Vall</h3>
        </div>
        <div class="footer-contact">
            <p>¿Necesitas ayuda?</p>
            <button onclick="showContactForm()" class="contact-btn">Contáctanos</button>
        </div>
        <div class="footer-copyright">
            <p>&copy; {{ date('Y') }} Penyes La Vall. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function showContactForm() {
    Swal.fire({
        title: 'Formulario de Contacto',
        html: `
            <form id="contactForm" class="contact-form">
                <div class="swal2-input-group">
                    <input type="text" id="name" class="swal2-input" placeholder="Nombre" required>
                </div>
                <div class="swal2-input-group">
                    <input type="email" id="email" class="swal2-input" placeholder="Email" required>
                </div>
                <div class="swal2-input-group">
                    <textarea id="description" class="swal2-textarea" placeholder="Describe tu problema" required></textarea>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Enviar',
        cancelButtonText: 'Cancelar',
        preConfirm: () => {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const description = document.getElementById('description').value;

            if (!name || !email || !description) {
                Swal.showValidationMessage('Por favor, rellena todos los campos');
                return false;
            }

            return fetch('/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ name, email, description })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    throw new Error(data.message || 'Error al enviar el mensaje');
                }
                return data;
            })
            .catch(error => {
                Swal.showValidationMessage(error.message);
                throw error;
            });
        },
        buttonsStyling: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: '¡Enviado!',
                text: 'Tu mensaje ha sido enviado correctamente',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
}
 
</script>


<style>
    .contact-btn {
        background-color: #1abc9c;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .contact-btn:hover {
        background-color: #16a085;
    }

    /* SweetAlert Custom Styles */
    .swal2-popup {
    background-color: #1b263b !important;
    color: #e0e1dd !important;
    border-radius: 12px !important;
}

.swal2-title {
    color: #1abc9c !important;
    font-size: 24px !important;
    margin-bottom: 20px !important;
}

.contact-form {
    padding: 20px;
    max-width: 500px;
    margin: 0 auto;
}

.swal2-input-group {
    margin-bottom: 20px !important;
    text-align: left;
}

.swal2-input, .swal2-textarea {
    width: 100% !important;
    padding: 12px !important;
    background-color: #2c3e50 !important;
    border: 1px solid #34495e !important;
    color: #e0e1dd !important;
    border-radius: 8px !important;
    font-size: 16px !important;
    transition: all 0.3s ease !important;
}

.swal2-input:focus, .swal2-textarea:focus {
    border-color: #1abc9c !important;
    box-shadow: 0 0 0 2px rgba(26, 188, 156, 0.2) !important;
    outline: none !important;
}

.swal2-textarea {
    min-height: 150px !important;
    resize: vertical !important;
}

.swal2-confirm, .swal2-cancel {
    padding: 12px 24px !important;
    font-size: 16px !important;
    border-radius: 8px !important;
    font-weight: bold !important;
}

.swal2-confirm {
    background-color: #1abc9c !important;
}

.swal2-cancel {
    background-color: #e74c3c !important;
}

    .contact-form {
        text-align: left;
        margin-top: 20px;
    }

    .swal2-input-group {
        margin-bottom: 15px;
    }


    .footer {
        background-color: #222;
        color: #fff;
        padding: 2rem 0;
        margin-top: 3rem;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        text-align: center;
    }

    .footer-brand h3 {
        font-size: 1.8rem;
        margin-bottom: 1rem;
        color: #4CAF50;
    }

    .footer-contact {
        margin: 1rem 0;
    }

    .footer-contact a {
        color: #4CAF50;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-contact a:hover {
        color: #66bb6a;
    }

    .footer-copyright {
        margin-top: 1.5rem;
        font-size: 0.9rem;
        color: #888;
    }
</style>