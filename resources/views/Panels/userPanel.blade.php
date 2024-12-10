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
            margin-bottom: 20px;
        }

        .navbar {
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            justify-content: center;
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

        .panel-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            width: 50%;
        }

        .panel-content a {
            color: #4CAF50;
            text-decoration: none;
            font-size: 18px;
            margin: 10px 0;
            transition: color 0.3s ease;
        }

        .panel-content a:hover {
            color: #f4d03f;
        }

        @media (max-width: 768px) {
            .navbar ul {
                flex-direction: column;
            }

            .navbar ul li {
                margin: 10px 0;
            }

            .panel-content {
                width: 80%;
            }
        }

        .crews-section {
            margin-top: 30px;
            width: 100%;
            padding: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .crews-section h2 {
            color: #4CAF50;
            margin-bottom: 15px;
        }

        .crews-section ul {
            list-style: none;
            padding-left: 0;
        }

        .crews-section ul li {
            padding: 10px;
            margin: 10px 0;
            background-color: #f9f9f9;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .crews-section ul li:hover {
            background-color: #f4d03f;
        }

        .join-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .join-button:hover {
            background-color: #45a049;
        }
    </style>
    {{-- <script>
        import swal from 'sweetalert2';
        const Swal = require('sweetalert2')
        function botonsin(){
        const boton = document.getElementById("algo")
        let cesped = Swal.fire({
        title: 'Error!',
        text: 'Do you want to continue',
        icon: 'error',
        confirmButtonText: 'Cool'})

        }
        return ;

    </script> --}}
</head>
<body>

    @include('./parts/navbar')

    <div class="panel-content">
        <h1>Front Office</h1>

        <a href="/deleteacc">Borrar cuenta</a>
    </div>

    <div class="crews-section">
        <h2>Peñas Disponibles</h2>
        <ul>
           
            @foreach ($crews as $crew)
                <li>
                    <span>{{ $crew->name }}</span>
                  
                    <a href="{{ url('/crews/' . $crew->id) }}" class="join-button">Ver mas</a>
                </li>
            @endforeach
        </ul>
        <button id="algo">asodq</button>
    </div>

</body>
</html>
