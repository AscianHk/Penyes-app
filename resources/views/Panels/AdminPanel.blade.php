<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    
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
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .navbar {
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
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

        .panel {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .panel h2 {
            color: #4CAF50;
            margin-bottom: 15px;
        }

        .panel .secondary-option {
            background-color: #e8f5e9;
            border: 1px solid #4CAF50;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .panel .secondary-option:hover {
            background-color: #c8e6c9;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="date"],
        form input[type="submit"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            .navbar ul {
                flex-direction: column;
            }

            .navbar ul li {
                margin: 10px 0;
            }

            .panel {
                margin: 10px;
                padding: 15px;
            }
        }
        .view-applications-btn {
            display: inline-block;
            padding: 15px 30px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
    </style>
</head>
<body>


   


    <div class="panel">
        <h1>Back Office</h1>

        <a href="/applications" class="view-applications-btn">Ver Solicitudes</a>

        <h2>Opciones del Administrador</h2>

        <div class="secondary-option" id="create-user-option">
            <h3>Crear Usuario</h3>
        </div>


        <div id="create-user-form" style="display:none;">
            <h3>Formulario de Registro</h3>
            @include('./Auth/register')
        </div>

        <script>
            document.getElementById('create-user-option').onclick = function() {
                var form = document.getElementById('create-user-form');
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }
        </script>
    </div>
</body>
</html>
