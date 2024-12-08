<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $crews->name }}</title>
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

        h1, h2 {
            text-align: center;
            color: #4CAF50;
        }

        article {
            text-align: center;
            font-size: 18px;
            color: #555;
            margin-top: 10px;
        }

        .crew-info {
            background-color: white;
            padding: 30px;
            margin: 20px auto;
            width: 60%;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .crew-info p {
            font-size: 18px;
            color: #333;
            text-align: center;
            margin: 10px 0;
        }

        .join-button {
            display: block;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .join-button:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            .crew-info {
                width: 80%;
            }
        }
    </style>
</head>
<body>

    <div class="crew-info">
        <h1>{{ $crews->name }}</h1>
        <h2>{{ $crews->slogan }}</h2>

        <article>Año de fundación</article>
        <p>{{ $crews->foundation_date }}</p>

        <a href="/applications" class="join-button">Unirse</a>
    </div>

</body>
</html>
