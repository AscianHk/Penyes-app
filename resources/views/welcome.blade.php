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
                padding: 20px;
            }

            h1 {
                text-align: center;
                color: #4CAF50;
                margin-bottom: 20px;
                font-size: 36px;
            }

            h2 {
                color: #333;
                margin-top: 20px;
                font-size: 28px;
                text-align: center;
            }

            .section {
                margin: 40px 0;
                background-color: #ffffff;
                border-radius: 8px;
                padding: 30px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .section h2 {
                font-size: 24px;
                color: #4CAF50;
                margin-bottom: 15px;
            }

            .section p {
                font-size: 18px;
                line-height: 1.6;
                color: #666;
            }

            .peñas-list {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
                gap: 20px;
            }

            .peña {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                width: 30%;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                text-align: center;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .peña:hover {
                transform: translateY(-10px);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            }

            .peña h3 {
                font-size: 22px;
                color: #4CAF50;
                margin: 15px 0;
            }

            .peña p {
                font-size: 16px;
                color: #666;
            }

            footer {
                text-align: center;
                margin-top: 40px;
                padding: 20px 0;
                background-color: #4CAF50;
                color: white;
                border-radius: 5px;
            }

            footer p {
                font-size: 16px;
            }

            @media (max-width: 768px) {
                .peñas-list {
                    flex-direction: column;
                    align-items: center;
                }

                .peña {
                    width: 80%;
                    margin-bottom: 20px;
                }
            }
        </style>
    </head>

    <body>
        @include('./parts/navbar')

        <div class="main-content">
            <h1>Bienvenidos a las Peñas en la Vall</h1>
            <p>Las peñas de la Vall son grupos de amigos y entusiastas que se reúnen para compartir momentos de diversión, cultura y tradición. Cada peña tiene su propia identidad, pero todas comparten el mismo objetivo: disfrutar y vivir la experiencia en comunidad.</p>

            <h2>Conoce algunas de nuestras peñas</h2>
            
            <div class="peñas-list">
                <div class="peña">
                    <h3>Peña Los Amigos</h3>
                    <p>Una peña formada por amigos de toda la vida, comprometidos con la tradición y siempre listos para disfrutar de las fiestas de la Vall.</p>
                </div>
                <div class="peña">
                    <h3>Peña La Diversión</h3>
                    <p>Una peña joven con muchas ganas de pasarlo bien, organizar eventos y ser parte de la comunidad.</p>
                </div>
                <div class="peña">
                    <h3>Peña El Rincón</h3>
                    <p>Un grupo que busca siempre dar lo mejor en cada evento, desde las fiestas hasta las actividades culturales.</p>
                </div>
            </div>
        </div>
    </body>

</html>
