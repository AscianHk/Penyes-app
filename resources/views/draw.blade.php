<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteo</title>
    
</head>
<body>
    @include('./parts/navbar')
    <h2>Sorteo de Ubicación</h2>


    <div class="year-selector">
        <label for="year" class="year-label">Seleccionar Año:</label>
        <select id="year" class="year-select" onchange="location = this.value;">
            @for ($i = 2015; $i <= 2025; $i++)
                <option value="/draw/{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
    </div>


    @if (auth()->user()->role && auth()->user()->role->isAdmin)
        <form action="{{ route('draw.draw') }}" method="POST">
            @csrf
            <button type="submit" class="btn-draw" {{ $showDrawButton ? '' : 'disabled' }}>Realizar Sorteo</button>
        </form>
        <form action="/deletedraw" id="deleteForm" method="POST">
            @csrf
            <button type="submit"  class="btn-draw" {{ ($showDrawButton || $year != 2025) ? 'disabled' : '' }}>Eliminar Sorteo actual</button>
        </form>

    @endif


    <div class="board">
        @for ($y = 0; $y < 5; $y++)
            @for ($x = 0; $x < 5; $x++)
                <div class="cell">
                    @foreach ($locations as $location)
                        @if ($location->x == $x && $location->y == $y)
                            @foreach ($crews as $crew)
                                @if ($location->crews_id == $crew->id)
                                    <span>{{ $crew->name }}</span>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
            @endfor
        @endfor
    </div>

    @include('./parts/footer')
</body>
</html>
<script>
    function borrar(e){
        e.preventDefault(); 
        
        Swal.fire({
            title: "¿Quieres borrar el sorteo?",
            text: "No podrás revertir esta acción",
            icon: "warning",
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: "Si",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Se ha eliminado el sorteo", "", "success").then(() => {
                    document.getElementById('deleteForm').submit();
                });
            } 
        });
    }

    document.getElementById('deleteForm').addEventListener('submit', borrar);

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
        text-align: center;
        padding: 20px;
    }
    
    h2 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: #f8f9fa;
        text-shadow: 2px 2px 8px rgba(255, 255, 255, 0.2);
    }

    .board {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
        max-width: 500px;
        margin: 20px auto;
        background-color: #1b263b;
        border-radius: 16px;
        padding: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
    }

    .cell {
        width: 80px;
        height: 80px;
        background-color: #2c3e50;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.2rem;
        font-weight: bold;
        color: #ecf0f1;
        transition: transform 0.3s ease, background-color 0.3s ease;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    .cell:hover {
        background-color: #34495e;
        transform: scale(1.2);
    }

    .btn-draw {
        background-color: #1abc9c;
        color: white;
        padding: 20px 50px;
        border: none;
        border-radius: 12px;
        font-size: 1.6rem;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
    }

    .btn-draw:hover {
        background-color: #16a085;
        transform: scale(1.1);
    }

    .btn-draw:disabled {
        background-color: #95a5a6;
        cursor: not-allowed;
    }


    .year-selector {
        margin: 20px auto;
        text-align: center;
    }

    .year-select {
        padding: 12px;
        font-size: 1.4rem;
        border-radius: 8px;
        border: 2px solid #ccc;
        cursor: pointer;
        background-color: #1b263b;
        color: white;
        transition: all 0.3s ease;
    }

    .year-select:hover {
        border-color: #1abc9c;
    }
</style>