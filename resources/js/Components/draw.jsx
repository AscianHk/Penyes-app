import React, { useState, useEffect } from 'react';
import Swal from 'sweetalert2';
import Navbar from './parts/Navbar';

import '../../css/draw.css';

const Draw = () => {
    const [year, setYear] = useState(new Date().getFullYear());
    const [showDrawButton, setShowDrawButton] = useState(false);
    const [locations, setLocations] = useState([]);
    const [crews, setCrews] = useState([]);
    const [isAdmin, setIsAdmin] = useState(false);

    useEffect(() => {
        fetchData();
    }, [year]);

    const fetchData = async () => {
        try {
            const response = await fetch(`/api/draw/${year}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                credentials: 'include'
            });
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
    
            const data = await response.json();
            console.log('Data received:', data); // Para depuración
    
            setLocations(data.locations || []);
            setCrews(data.crews || []);
            setShowDrawButton(data.showDrawButton || false);
            setIsAdmin(data.isAdmin || false);
        } catch (error) {
            console.error('Error:', error);

        }
    };
    const handleDraw = async () => {
        try {
            const response = await fetch('/api/draw', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                credentials: 'include',
                body: JSON.stringify({ year })
            });
    
            const data = await response.json();
    
            if (!response.ok) {
                throw new Error(data.message || 'Error al realizar el sorteo');
            }
    
            await fetchData(); // Refresh data after successful draw
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: 'El sorteo se ha realizado correctamente',
                timer: 1500
            });
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Ha ocurrido un error al realizar el sorteo'
            });
        }
    };

    const handleDeleteDraw = (e) => {
        e.preventDefault();
        Swal.fire({
            title: "¿Quieres borrar el sorteo?",
            text: "No podrás revertir esta acción",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí",
            cancelButtonText: "No"
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch('/api/deletedraw', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    if (response.ok) {
                        await fetchData();
                        Swal.fire({
                            icon: 'success',
                            title: 'Sorteo eliminado',
                            text: 'El sorteo se ha eliminado correctamente',
                            timer: 1500
                        });
                    }
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error al eliminar el sorteo'
                    });
                }
            }
        });
    };

    return (
        <div className="app-container">
            <Navbar />
            <main className="main-content">
                <h2>Sorteo de Ubicación</h2>
    
                <div className="year-selector">
                    <label htmlFor="year" className="year-label">Seleccionar Año:</label>
                    <select 
                        id="year" 
                        className="year-select"
                        value={year}
                        onChange={(e) => setYear(parseInt(e.target.value))}
                    >
                        {Array.from({ length: 11 }, (_, i) => 2015 + i).map(y => (
                            <option key={y} value={y}>{y}</option>
                        ))}
                    </select>
                </div>
    
                {isAdmin && (
                    <div className="controls">
                        <button 
                            className="btn-draw"
                            onClick={handleDraw}
                            disabled={!showDrawButton}
                        >
                            Realizar Sorteo
                        </button>
                        <button
                            className="btn-draw delete"
                            onClick={handleDeleteDraw}
                            disabled={showDrawButton}
                        >
                            Eliminar Sorteo actual
                        </button>
                    </div>
                )}
    
                <div className="board">
                    {Array.from({ length: 5 }, (_, y) => (
                        Array.from({ length: 5 }, (_, x) => (
                            <div key={`${x}-${y}`} className="cell">
                                {locations
                                    .filter(loc => loc.x === x && loc.y === y)
                                    .map(loc => {
                                        const crew = crews.find(c => c.id === loc.crews_id);
                                        return crew ? <span key={crew.id}>{crew.name}</span> : null;
                                    })}
                            </div>
                        ))
                    ))}
                </div>
            </main>

        </div>
    );
};

export default Draw;