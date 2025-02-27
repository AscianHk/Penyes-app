<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Front Office - Panel de Usuario</title>
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
            overflow-x: hidden;
        }

        .navbar {
            background-color: #1abc9c;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }

        .panel-content {
            background-color: #1b263b;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            width: 50%;
            margin: 0 auto;
        }

        .panel-content .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            font-weight: bold;
            color: white;
            background-color: #1abc9c;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .panel-content .delete {
            background-color: #e74c3c;
        }

        .panel-content .button:hover {
            background-color: #16a085;
        }

        .sidebar-toggle {
            position: fixed;
            left: 20px;
            top: 20px;
            background: #1abc9c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .sidebar {
            position: fixed;
            left: -300px;
            top: 0;
            width: 250px;
            height: 100%;
            background: #1b263b;
            padding: 20px;
            box-shadow: 4px 0px 10px rgba(0, 0, 0, 0.3);
            transition: left 0.3s ease;
            z-index: 20;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar h2 {
            color: #1abc9c;
            margin-bottom: 15px;
            border-radius: 15px;
            background-color: #1b262b
        }

        .sidebar p {
            margin-bottom: 10px;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 15;
        }

        .overlay.active {
            display: block;
        }

        .crews-section {
            margin-top: 30px;
            width: 80%;
            padding: 20px;
            background-color: #1b263b;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            margin: 20px auto;
        }

        .crews-section h2 {
            color: #1abc9c;
            margin-bottom: 15px;
        }

        .crews-section ul {
            list-style: none;
            padding-left: 0;
        }

        .crews-section ul li {
            padding: 12px;
            margin: 10px 0;
            background-color: #2c3e50;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .crews-section ul li:hover {
            background-color: #f4d03f;
            color: #0d1b2a;
        }
        .join-button {
            background-color: #1abc9c;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .join-button:hover {
            background-color: #16a085;
        }
</style>

</head>
<body>
    @include('./parts/navbar')

    <button class="sidebar-toggle" onclick="toggleSidebar()">&#9776;</button>
    <div class="overlay" id="overlay" onclick="closeSidebar()"></div>
    <div class="sidebar" id="sidebar">
        <h2>Datos del Usuario</h2>
        <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Apellidos:</strong> {{ Auth::user()->surname }}</p>
        <p><strong>Correo:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ Auth::user()->birthday_date }}</p>
        <p><strong>Pertenece a: </strong>
            

{{--             
           @if(($users_crews->user_id) )
            <p>{{$crews->crew_name}}</p>            
           @else
           <p>ninguna</p>
           
            @endif --}}
            
        <p>
    </div>

    <div class="container">
        <div class="panel-content">
            <h1>Front Office</h1>
            <div class="options">
                <a href="/draw" class="button">Ir a Sorteos</a>
                <a href="/deleteacc" class="button delete">Borrar cuenta</a>
            </div>
        </div>

        <div class="crews-section">
            <h2>Peñas Disponibles</h2>
            <ul>
                @foreach ($crews as $crew)
                    <li>
                        <span>{{ $crew->name }}</span>
                        <button onclick="showCrewInfo('{{ $crew->name }}', '{{ $crew->slogan }}', '{{ $crew->foundation_date }}', '{{ $crew->Logo }}')" 
                            class="join-button" 
                            id="verpeñita">
                        Ver más
                    </button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    @include('./parts/footer')

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('overlay').classList.toggle('active');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        }

   
    </script>
    <script>
        // ...existing sidebar code...
    
        function showCrewInfo(name, slogan, foundationDate, logo) {
            Swal.fire({
                title: name,
                html: `
                    ${logo ? `<img src="${logo}" class="crew-logo" style="
                        width: 120px;
                        height: 120px;
                        border-radius: 50%;
                        object-fit: cover;
                        margin-bottom: 15px;
                        border: 3px solid #1abc9c;
                    ">` : ''}
                    <h2 style="color: #f4d03f; margin-bottom: 20px; font-size: 20px;">${slogan}</h2>
                    <p style="margin: 10px 0;"><strong>Año de fundación:</strong> ${foundationDate}</p>
                    <div style="margin-top: 20px;">
                        <a href="/applications" class="join-button" style="
                            background-color: #1abc9c;
                            color: white;
                            border: none;
                            padding: 12px 20px;
                            border-radius: 6px;
                            text-decoration: none;
                            font-size: 18px;
                            transition: background-color 0.3s ease;
                        ">Unirse</a>
                    </div>
                `,
                showConfirmButton: false,
                customClass: {
                    popup: 'crew-popup'
                }
            });
        }
    </script>
    
</body>
</html>
