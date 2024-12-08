<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
}

.navbar {
    background-color: #4CAF50;
    padding: 10px 20px;
    border-radius: 5px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
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


@media (max-width: 768px) {
    .navbar ul {
        flex-direction: column;
    }

    .navbar ul li {
        margin: 10px 0;
    }
}
        </style>

        
    </head>
    
    
    <body>
       @include('./parts/navbar' )
        
        
    </body>
</html>
