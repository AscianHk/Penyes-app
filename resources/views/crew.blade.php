<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $crews->name }}</title>
    
</head>
<body>
    <div class="crew-info">
        @isset($crew->Logo)
            @if($crew->Logo)
                <img src="{{$crew->Logo}}" class="crew-logo">
            @endif
        @endisset

        <h1>{{ $crews->name }}</h1>
        <h2>{{ $crews->slogan }}</h2>

        <p><strong>Año de fundación:</strong> {{ $crews->foundation_date }}</p>

        <a href="/applications" class="join-button">Unirse</a>
    </div>
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

    .crew-info {
        background-color: #1b263b;
        padding: 30px;
        margin: 20px auto;
        width: 60%;
        border-radius: 12px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        text-align: center;
    }

    .crew-logo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
        border: 3px solid #1abc9c;
    }

    h1 {
        color: #1abc9c;
        margin-bottom: 10px;
        font-size: 26px;
    }

    h2 {
        color: #f4d03f;
        margin-bottom: 20px;
        font-size: 20px;
    }

    .crew-info p {
        font-size: 18px;
        color: #e0e1dd;
        margin: 10px 0;
    }

    .join-button {
        display: inline-block;
        background-color: #1abc9c;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 18px;
        transition: background-color 0.3s ease;
    }

    .join-button:hover {
        background-color: #16a085;
    }

    @media (max-width: 768px) {
        .crew-info {
            width: 80%;
            padding: 20px;
        }
    }
</style>
</html>