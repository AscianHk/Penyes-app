<!DOCTYPE html>
<html>
<head>
    <title>Nueva Incidencia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1abc9c;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 8px 8px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field strong {
            color: #1abc9c;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Nueva Incidencia de Contacto</h2>
    </div>
    <div class="content">
        <div class="field">
            <strong>Nombre:</strong>
            <p>{{ $data['name'] }}</p>
        </div>
        <div class="field">
            <strong>Email:</strong>
            <p>{{ $data['email'] }}</p>
        </div>
        <div class="field">
            <strong>Descripción:</strong>
            <p>{{ $data['description'] }}</p>
        </div>
    </div>
</body>
</html>