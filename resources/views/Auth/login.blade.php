<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Fondo y tipografía */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Contenedor principal */
    .login-container {
        background-color: white;
        padding: 20px 40px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    h1 {
        text-align: center;
        color: #4CAF50;
        margin-bottom: 20px;
    }

    .input-field {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .input-field:focus {
        border-color: #4CAF50;
        outline: none;
    }

    .submit-btn {
        width: 100%;
        padding: 12px;
        background-color: #4CAF50;
        border: none;
        color: white;
        font-size: 18px;
        font-weight: bold;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-btn:hover {
        background-color: #45a049;
    }

    .form-footer {
        text-align: center;
        margin-top: 15px;
    }

    .form-footer a {
        text-decoration: none;
        color: #4CAF50;
        font-weight: bold;
    }

    .form-footer a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .login-container {
            padding: 20px;
            width: 90%;
        }
    }
</style>
</head>
<body>

<div class="login-container">
    <h1>Login</h1>
    <form action="/verifyAuth" method="POST">
        @csrf
        <input type="email" name="email" class="input-field" placeholder="Email" required>
        <input type="password" name="password" class="input-field" placeholder="Password" required>
        <input type="submit" class="submit-btn" value="Login">
    </form>
    <div class="form-footer">
        <p>¿No tienes cuenta? <a href="/register">Regístrate aquí</a></p>
    </div>
</div>
</body>
</html>