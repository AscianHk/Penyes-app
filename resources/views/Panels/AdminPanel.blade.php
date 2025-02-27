<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel</title>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @include('./parts/navbar')
    <div class="admin-panel">
        <h1>Back Office</h1>
    
        <div class="admin-box">
            <h2>Opciones del Administrador</h2>
    
            <div class="options-container">
                <div class="secondary-option" id="create-user-option">
                    <h3>Crear Usuario</h3>
                </div>
                <div class="secondary-option" id="create-crew-option">
                    <h3>Crear Crew</h3>
                </div>
                <a href="/applications" class="secondary-option">
                    <h3>Ver Solicitudes</h3>
                </a>
                <a href="/draw" class="secondary-option">Ir a Sorteos</a>
            </div>
        </div>
        <div id="create-user-form" class="form-container" style="display:none;">
            <h3>Formulario de Registro</h3>
            @include('./Auth/other-register')
        </div>

        <div id="create-crew-form" class="form-container" style="display:none;">
            <h3>Formulario de Crear Crew</h3>
            @include('./Auth/Create_crew')
        </div>
    </div>

        <div class="table-container">
            <h3>Usuarios</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo Electrónico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Eliminar Usuario</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <div class="table-container">
            <h3>Peñas</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($crews as $crew)
                    <tr>
                        <td>{{ $crew->name }}</td>
                        <td>{{ $crew->capacity }}</td>
                        <td>
                            <button onclick="editCrew({{ $crew->id }}, '{{ $crew->name }}', {{ $crew->capacity }})" class="btn-edit">
                                Editar Peña
                            </button>
                            <form action="{{ route('crews.destroy', $crew->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Eliminar Peña</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session('success') }}',
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
        });
    </script>
@endif

</body>
<script>
document.getElementById('create-user-option').onclick = function() {
        var userForm = document.getElementById('create-user-form');
        userForm.style.display = userForm.style.display === 'none' || userForm.style.display === '' ? 'block' : 'none';
    };

document.getElementById('create-crew-option').onclick = function() {
        var crewForm = document.getElementById('create-crew-form');
        crewForm.style.display = crewForm.style.display === 'none' || crewForm.style.display === '' ? 'block' : 'none';
    };



function editCrew(crewId, crewName, crewCapacity) {
        Swal.fire({
            title: 'Editar Peña',
            html: `
                <form id="editCrewForm">
                    <div class="swal2-input-group">
                        <label for="name">Nombre de la Peña:</label>
                        <input type="text" id="name" class="swal2-input" value="${crewName}" required>
                    </div>
                    <div class="swal2-input-group">
                        <label for="capacity">Capacidad:</label>
                        <input type="number" id="capacity" class="swal2-input" value="${crewCapacity}" required>
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Actualizar',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const name = document.getElementById('name').value;
                const capacity = document.getElementById('capacity').value;

                return fetch(`/crews/${crewId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        _method: 'PATCH',
                        name: name,
                        capacity: capacity
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al actualizar la peña');
                    }
                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(error.message);
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'La peña ha sido actualizada correctamente',
                    timer: 1500
                }).then(() => {
                    window.location.reload();
                });
            }
        });
    }


document.getElementById('create-user-option').onclick = function() {
    Swal.fire({
        title: 'Crear Usuario',
        html: `
            <form id="registerForm" class="register-form">
                <div class="swal2-input-group">
                    <input type="text" id="name" class="swal2-input" placeholder="Nombre" required>
                </div>
                <div class="swal2-input-group">
                    <input type="text" id="surname" class="swal2-input" placeholder="Apellidos" required>
                </div>
                <div class="swal2-input-group">
                    <input type="date" id="birth_date" class="swal2-input" required>
                </div>
                <div class="swal2-input-group">
                    <input type="email" id="email" class="swal2-input" placeholder="Email" required>
                </div>
                <div class="swal2-input-group">
                    <input type="password" id="password" class="swal2-input" placeholder="Contraseña" required>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Crear Usuario',
        cancelButtonText: 'Cancelar',
        preConfirm: () => {
            const formData = {
                name: document.getElementById('name').value,
                surname: document.getElementById('surname').value,
                birth_date: document.getElementById('birth_date').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            };

            return fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(text || 'Error en la respuesta del servidor');
                    });
                }
                return Promise.resolve();
            })
            .catch(error => {
                Swal.showValidationMessage(`Error: ${error.message}`);
                throw error;
            });
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: '¡Usuario Creado!',
                text: 'El usuario ha sido creado correctamente',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.reload();
            });
        }
    }).catch(() => {
        // Error already handled in preConfirm
    });
};
document.getElementById('create-crew-option').onclick = function() {
    Swal.fire({
        title: 'Crear Peña',
        html: `
            <form id="createCrewForm" class="register-form">
                <div class="swal2-input-group">
                    <input type="text" id="name" class="swal2-input" placeholder="Nombre de la Peña" required>
                </div>
                <div class="swal2-input-group">
                    <input type="text" id="color" class="swal2-input" placeholder="Color" required>
                </div>
                <div class="swal2-input-group">
                    <input type="text" id="slogan" class="swal2-input" placeholder="Slogan" required>
                </div>
                <div class="swal2-input-group">
                    <input type="number" id="capacity" class="swal2-input" placeholder="Capacidad" required>
                </div>
                <div class="swal2-input-group">
                    <input type="date" id="foundation_date" class="swal2-input" required>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Crear Peña',
        cancelButtonText: 'Cancelar',
        preConfirm: () => {
            const formData = {
                name: document.getElementById('name').value,
                color: document.getElementById('color').value,
                slogan: document.getElementById('slogan').value,
                capacity: document.getElementById('capacity').value,
                foundation_date: document.getElementById('foundation_date').value
            };

            return fetch('/createcrew', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(text || 'Error al crear la peña');
                    });
                }
                return Promise.resolve();
            })
            .catch(error => {
                Swal.showValidationMessage(`Error: ${error.message}`);
                throw error;
            });
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: '¡Peña Creada!',
                text: 'La peña ha sido creada correctamente',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.reload();
            });
        }
    }).catch(() => {
      
    });
};



</script>


<style>
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

    .register-form {
        padding: 20px;
        max-width: 400px;
        margin: 0 auto;
    }

    .swal2-input-group {
        margin-bottom: 20px !important;
        text-align: left;
    }

    .swal2-input-group label {
        display: block;
        margin-bottom: 8px;
        color: #1abc9c;
        font-weight: 500;
    }

    .swal2-input {
        width: 100% !important;
        padding: 12px !important;
        background-color: #2c3e50 !important;
        border: 1px solid #34495e !important;
        color: #e0e1dd !important;
        border-radius: 8px !important;
        font-size: 16px !important;
        transition: all 0.3s ease !important;
    }

    .swal2-input:focus {
        border-color: #1abc9c !important;
        box-shadow: 0 0 0 2px rgba(26, 188, 156, 0.2) !important;
        outline: none !important;
    }

    .swal2-input::placeholder {
        color: #95a5a6 !important;
    }

    .swal2-confirm {
        background: #1abc9c !important;
        color: white !important;
        padding: 12px 24px !important;
        border-radius: 8px !important;
        font-weight: bold !important;
        transition: all 0.3s ease !important;
    }

    .swal2-cancel {
        background: #e74c3c !important;
        color: white !important;
        padding: 12px 24px !important;
        border-radius: 8px !important;
        font-weight: bold !important;
        transition: all 0.3s ease !important;
    }

    .swal2-confirm:hover {
        background: #16a085 !important;
        transform: translateY(-2px) !important;
    }

    .swal2-cancel:hover {
        background: #c0392b !important;
        transform: translateY(-2px) !important;
    }

    input[type="date"].swal2-input {
        color: #e0e1dd !important;
        padding: 10px 12px !important;
    }


    input[type="number"].swal2-input {
        padding: 10px 12px !important;
    }


    .swal2-success-circular-line-left,
    .swal2-success-circular-line-right,
    .swal2-success-fix {
        background-color: #1b263b !important;
    }

    .swal2-icon.swal2-success .swal2-success-ring {
        border-color: #1abc9c !important;
    }

    .swal2-icon.swal2-success [class^='swal2-success-line'] {
        background-color: #1abc9c !important;
    }


    .swal2-icon.swal2-error [class^='swal2-x-mark-line'] {
        background-color: #e74c3c !important;
    }

    .swal2-validation-message {
        background: #c0392b !important;
        color: white !important;
        border-radius: 6px !important;
        margin-top: 15px !important;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-color: #0d1b2a;
        color: #e0e1dd;
        padding: 20px;
    }

    .admin-panel {
        max-width: 1100px;
        margin: 0 auto;
        background-color: #1b263b;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.4);
    }


    .admin-panel h1 {
        text-align: center;
        color: #1abc9c;
        margin-bottom: 25px;
        font-size: 28px;
    }

    .admin-box {
        border: 2px solid #1abc9c;
        border-radius: 10px;
        padding: 20px;
        background-color: #2c3e50;
        margin-bottom: 20px;
    }

    .options-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 15px;
    }

    .secondary-option {
        flex: 1;
        text-align: center;
        padding: 15px;
        background-color: #1abc9c;
        color: white;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .secondary-option:hover {
        background-color: #16a085;
        transform: scale(1.05);
    }

    .table-container {
        margin-top: 30px;
        background-color: #1b263b;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #34495e;
    }

    th {
        background-color: #1abc9c;
        color: white;
        text-align: center;
    }

    tr:hover {
        background-color: #2c3e50;
    }

    .btn-delete, .btn-edit {
        padding: 10px 14px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: opacity 0.3s, transform 0.2s;
        text-align: center;
        display: inline-block;
    }

    .btn-delete {
        background-color: #e74c3c;
        color: white;
    }

    .btn-edit {
        background-color: #f4d03f;
        color: black;
    }

    .btn-delete:hover, .btn-edit:hover {
        opacity: 0.85;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .admin-panel {
            padding: 15px;
        }

        .options-container {
            flex-direction: column;
        }

        .secondary-option {
            width: 100%;
        }

        table {
            font-size: 14px;
        }
    }

</style>
</html>