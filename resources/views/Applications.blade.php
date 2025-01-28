<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Crew</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        h2 {
            color: #333;
            margin-top: 20px;
        }

        form {
            margin: 20px 0;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 16px;
            margin-right: 10px;
        }

        select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 16px;
            width: 200px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        form button {
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
            margin: 0 5px;
        }

        form button.accept {
            background-color: #4CAF50;
            color: white;
        }

        form button.reject {
            background-color: #f44336;
            color: white;
        }

        form button:hover {
            opacity: 0.8;
        }

        .no-available {
            color: gray;
        }
    </style>
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
            title: 'Error',
            text: '{{ session('error') }}',
        });
    </script>
@endif

    @if (auth()->user()->role && auth()->user()->role->isAdmin)
        <h2>Solicitudes Pendientes</h2>
        @if ($applications->isEmpty())
            <p>No hay solicitudes pendientes.</p>
        @else
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
                                {{-- @dd($application->crews->name) --}}
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
                                        <button type="submit" class="reject">Rechazar</button>
                                    </form>
                                @else
                                    <span class="no-available">No disponible</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
</html>
