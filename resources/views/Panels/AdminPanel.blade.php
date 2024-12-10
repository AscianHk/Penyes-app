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
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    padding: 20px;
}


.admin-panel {
    max-width: 900px;
    margin: 0 auto;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.admin-panel h1 {
    text-align: center;
    color: #4CAF50;
    margin-bottom: 20px;
}

.admin-box {
    border: 2px solid #4CAF50;
    border-radius: 8px;
    padding: 20px;
    background-color: #e8f5e9;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

.admin-box h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}


.options-container {
    display: flex;
    justify-content: space-around;
    gap: 10px;
}

.secondary-option {
    flex: 1;
    text-align: center;
    padding: 15px;
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.secondary-option:hover {
    background-color: #45a049;
    transform: scale(1.05);
}

.form-container {
    display: none;
    margin-top: 20px;
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

.form-container h3 {
    margin-bottom: 15px;
    text-align: center;
    color: #4CAF50;
}

.form-container form {
    display: flex;
    flex-direction: column;
}

.form-container form input {
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.form-container form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-container form input[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
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
                <a href="/applications" class="secondary-option" id="view-requests-option">
                    <h3>Ver Solicitudes</h3>
                </a>
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
    </div>
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
</script>

</html>
