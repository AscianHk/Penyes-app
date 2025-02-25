<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
    background-image: url('{{ asset('Imagenes/img-1.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 20px;
    position: relative;
}


body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(13, 27, 42, 0.7);
    z-index: 1;
}

.login-container {
    position: relative;
    z-index: 2;
    background-color: rgba(27, 38, 59, 0.9);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    width: 100%;
    max-width: 400px;
    text-align: center;
    color: #e0e1dd;
    backdrop-filter: blur(10px);
}

        h1 {
            color: #1abc9c;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .input-field {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            background: #2c3e50;
            color: #e0e1dd;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            background: #34495e;
            outline: none;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #1abc9c;
            border: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #16a085;
        }

        .form-footer {
            margin-top: 15px;
        }

        .form-footer a {
            text-decoration: none;
            color: #1abc9c;
            font-weight: bold;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Iniciar Sesión</h1>
        <form action="/verifyAuth" method="POST">
            @csrf
            <input type="email" name="email" class="input-field" placeholder="Correo Electrónico" required>
            <input type="password" name="password" class="input-field" placeholder="Contraseña" required>
            <input type="submit" class="submit-btn" value="Iniciar Sesión">
        </form>
        <div class="form-footer">
            <p>¿No tienes cuenta? <a href="/register">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>
