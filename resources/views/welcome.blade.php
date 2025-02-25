<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    
    </head>
    @php
    $user = Auth::user();
@endphp
    <body>
        @include('./parts/navbar')

    <div class="carousel">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="{{ asset('Imagenes/img-1.jpg') }}" alt="Peña 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('Imagenes/img-2.jpg') }}" alt="Peña 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('Imagenes/img-3.jpeg') }}" alt="Peña 3">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('Imagenes/img-4.jpg') }}" alt="Peña 4">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('Imagenes/img-5.jpeg') }}" alt="Peña 5">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('Imagenes/img-6.jpeg') }}" alt="Peña 6">
            </div>
        </div>
        <div class="carousel-controls">
            <button class="prev">&lt;</button>
            <button class="next">&gt;</button>
        </div>
        <div class="carousel-indicators"></div>
    </div>



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




        <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=vall%20de%20uxo+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/collections/drones/">best drones</a></iframe></div>
    
        @include('./parts/footer')
    
    
    </body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.querySelector('.carousel-inner');
            const items = document.querySelectorAll('.carousel-item');
            const prevBtn = document.querySelector('.prev');
            const nextBtn = document.querySelector('.next');
            let currentIndex = 0;
    
            function updateCarousel() {
                carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
            }
    
            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + items.length) % items.length;
                updateCarousel();
            });
    
            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % items.length;
                updateCarousel();
            });
    

            setInterval(() => {
                currentIndex = (currentIndex + 1) % items.length;
                updateCarousel();
            }, 5000);
        });
    </script>



    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #1a1a1a;
    color: #fff;
    padding: 20px;
    line-height: 1.6;
}

h1 {
    text-align: center;
    color: #4CAF50;
    margin-bottom: 30px;
    font-size: 2.5rem;
    text-transform: uppercase;
    letter-spacing: 2px;
}

h2 {
    color: #4CAF50;
    margin: 40px 0 20px;
    font-size: 2rem;
    text-align: center;
    position: relative;
}

.main-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.main-content p {
    color: #ccc;
    font-size: 1.1rem;
    text-align: center;
    margin-bottom: 2rem;
}

.section {
    margin: 40px 0;
    background-color: #222;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

.peñas-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    gap: 30px;
    margin-top: 3rem;
}

.peña {
    background-color: #222;
    padding: 25px;
    border-radius: 12px;
    width: 30%;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #333;
}

.peña:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 20px rgba(76, 175, 80, 0.2);
    border-color: #4CAF50;
}

.peña h3 {
    font-size: 1.5rem;
    color: #4CAF50;
    margin: 15px 0;
    text-transform: uppercase;
}

.peña p {
    font-size: 1rem;
    color: #ccc;
    line-height: 1.6;
}

.carousel {
    position: relative;
    width: 100%;
    max-width: 1000px;
    margin: 40px auto;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    border: 1px solid #333;
}

.carousel-inner {
    display: flex;
    transition: transform 0.5s ease-in-out;
    height: 500px;
}

.carousel-item {
    min-width: 100%;
    flex-shrink: 0;
}

.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.8);
}

.carousel-controls button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(76, 175, 80, 0.8);
    color: white;
    border: none;
    padding: 15px 20px;
    cursor: pointer;
    font-size: 24px;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    z-index: 10;
}

.carousel-controls .prev {
    left: 20px;
}

.carousel-controls .next {
    right: 20px;
}

.carousel-controls button:hover {
    background: rgba(76, 175, 80, 1);
    transform: translateY(-50%) scale(1.1);
}

.carousel-indicators {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 10;
}

.indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.indicator.active {
    background: #4CAF50;
}

.mapouter {
    margin: 40px auto;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    border: 1px solid #333;
}

.gmap_canvas {
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
}

.gmap_canvas iframe {
    width: 100%;
    height: 500px;
}

@media (max-width: 768px) {
    .peñas-list {
        flex-direction: column;
        align-items: center;
    }

    .peña {
        width: 90%;
    }

    .carousel-item img {
        height: 300px;
    }
}
        
    </style>
</html>
