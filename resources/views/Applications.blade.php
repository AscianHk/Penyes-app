<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Crew</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>
<body>
    @include('./parts/navbar')
    <h1>Solicitudes de Crew</h1>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
            });
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Solicitud Rechazada',
                
            });
        </script>
    @endif

    @if (auth()->user()->role && auth()->user()->role->isAdmin)
        <h2>Solicitudes Pendientes</h2>
        @if ($applications->isEmpty())
            <p>No hay solicitudes pendientes.</p>
        @else
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Crew</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <tr>
                                <td>{{ $application->id }}</td>
                                <td>{{ $application->user ? $application->user->name : 'Sin usuario' }}</td>
                                <td>
                                    @foreach ($application->crews as $crew)
                                        {{ $crew->name }} 
                                    @endforeach
                                </td>
                                <td>{{ $application->status }}</td>
                                <td>
                                    @if ($application->status === 'pending')
                                        <form action="{{ route('applications.update', $application->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="accept">Aceptar</button>
                                        </form>
                                        <form action="{{ route('applications.update', $application->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="denied">
                                            <button type="submit" class="reject" style="background-color: #e74c3c">Rechazar</button>
                                        </form>
                                    @else
                                        <span class="no-available">No disponible</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        @else
            <h2>Enviar Solicitud</h2>
            <form action="{{ route('applications.store') }}" method="POST">
                    @csrf
                <label for="crews_id">Seleccionar Crew:</label>
                <select name="crews_id" id="crews_id" required>
                <option value="" disabled selected>Selecciona una crew</option>
                        @foreach ($crews as $crew)
                            <option value="{{ $crew->id }}">{{ $crew->name }}</option>
                        @endforeach
                </select>
                <button type="submit">Enviar Solicitud</button>
            </form>
    @endif
</body>
<style>
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
        text-align: center;
    }

    h1 {
        color: #1abc9c;
        margin-bottom: 20px;
    }

    h2 {
        color: #f4d03f;
        margin-top: 20px;
    }

    .table-container {
        overflow-x: auto;
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        background-color: #1b263b;
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border: 1px solid #2c3e50;
        white-space: nowrap;
    }

    th {
        background-color: #1abc9c;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #2c3e50;
    }

    .accept, .reject {
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 14px;
        cursor: pointer;
        transition: opacity 0.3s;
    }

    .accept {
        background-color: #1abc9c;
    }

    .reject {
        background-color: #e74c3c;
    }

    .accept:hover, .reject:hover {
        opacity: 0.8;
    }

    .no-available {
        color: gray;
    }
    form {
        max-width: 400px;
        margin: 40px auto;
        padding: 25px;
        background-color: #1b263b;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    label {
        display: block;
        margin-bottom: 10px;
        color: #e0e1dd;
        font-size: 1.1rem;
        font-weight: 500;
        text-align: left;
    }

    select {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        background-color: #0d1b2a;
        border: 2px solid #2c3e50;
        border-radius: 8px;
        color: #e0e1dd;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    select:focus {
        outline: none;
        border-color: #1abc9c;
        box-shadow: 0 0 0 2px rgba(26, 188, 156, 0.2);
    }

    form button[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #1abc9c;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    form button[type="submit"]:hover {
        background-color: #16a085;
        transform: translateY(-2px);
    }

    form button[type="submit"]:active {
        transform: translateY(0);
    }

    /* Override inline form styles for admin buttons */
    form[style*="display:inline"] {
        max-width: none;
        margin: 0;
        padding: 0;
        background-color: transparent;
        box-shadow: none;
    }

    form[style*="display:inline"] button {
        width: auto;
    }
</style>
</html>
