document.addEventListener('DOMContentLoaded', () => {
    // Carga inicial de los colores desde el servidor
    fetch('obtener_colores.php?json=true')
        .then(response => response.json())
        .then(data => {
            window.roomColors = data;
            initializeUI(); // Inicializa la interfaz de usuario una vez cargados los colores
        })
        .catch(error => console.error('Error al cargar los colores:', error));
});

function initializeUI() {
    const rooms = ['cocina-room', 'entrada-room', 'balcon-room', 'hall-room'];
    const buttons = ['btnCocina', 'btnEntrada', 'btnBalcon', 'btnHall'];
    const specialRooms = ['habitacion1-room', 'habitacion2-room', 'bano-room', 'dormitorio-room', 'salon-room'];
    const specialButtons = ['btnHabitacion1', 'btnHabitacion2', 'btnBano', 'btnDormitorio', 'btnSalon'];

    // Funcionalidad para activar/desactivar A/C
    const activarACBtn = document.getElementById('btnActivarAC');
    if (activarACBtn) {
        activarACBtn.addEventListener('click', () => {
            console.log('Aire acondicionado activado');
        });
    }

    const desactivarACBtn = document.getElementById('btnDesactivarAC');
    if (desactivarACBtn) {
        desactivarACBtn.addEventListener('click', () => {
            console.log('Aire acondicionado desactivado');
        });
    }

    // Actualizar el valor del slider de temperatura
    const sliderTemperatura = document.getElementById('sliderTemperatura');
    if (sliderTemperatura) {
        sliderTemperatura.addEventListener('input', () => {
            document.getElementById('valorTemperatura').textContent = `${sliderTemperatura.value}°C`;
        });
    }

    // Aplicar cambios de temperatura
    const aplicarCambiosBtn = document.getElementById('btnAplicarCambios');
    if (aplicarCambiosBtn) {
        aplicarCambiosBtn.addEventListener('click', () => {
            console.log(`Temperatura ajustada a ${sliderTemperatura.value}°C`);
        });
    }

    // Configura todos los elementos de la interfaz aquí...
    rooms.forEach(room => {
        const roomElement = document.getElementById(room);
        const roomLink = document.getElementById(room.replace('room', 'link'));
        if (roomElement && roomLink) {
            const roomState = localStorage.getItem(room);
            if (roomState === 'disabled') {
                roomLink.classList.add('disabled-link', 'no-hover');
            }
        }
    });

    specialRooms.forEach(room => {
        const roomElement = document.getElementById(room);
        const roomLink = document.getElementById(room.replace('room', 'link'));
        if (roomElement && roomLink) {
            const roomState = localStorage.getItem(room);
            if (roomState === 'disabled') {
                roomLink.classList.add('disabled-link', 'no-hover');
            }
        }
    });

    buttons.forEach(buttonId => {
        const buttonElement = document.getElementById(buttonId);
        if (buttonElement) {
            const buttonState = localStorage.getItem(buttonId);
            if (buttonState === 'disabled') {
                buttonElement.classList.add('habitacion-desactivada', 'hover-permanente');
            }
            buttonElement.addEventListener('click', function () {
                const roomId = this.id.replace('btn', '').toLowerCase() + '-room';
                toggleRoomState(roomId, this);
                this.classList.toggle('hover-permanente');
                if (buttonElement.classList.contains('habitacion-desactivada')) {
                    localStorage.setItem(buttonId, 'disabled');
                } else {
                    localStorage.removeItem(buttonId);
                }
            });
        }
    });

    specialButtons.forEach(buttonId => {
        const buttonElement = document.getElementById(buttonId);
        if (buttonElement) {
            const buttonState = localStorage.getItem(buttonId);
            if (buttonState === 'disabled') {
                buttonElement.classList.add('habitacion-desactivada', 'hover-permanente');
            }
            buttonElement.addEventListener('click', function () {
                const roomId = this.id.replace('btn', '').toLowerCase() + '-room';
                toggleSpecialRoomState(roomId, this);
                this.classList.toggle('hover-permanente');
                if (buttonElement.classList.contains('habitacion-desactivada')) {
                    localStorage.setItem(buttonId, 'disabled');
                } else {
                    localStorage.removeItem(buttonId);
                }
            });
        }
    });
}

function toggleRoomState(roomId, buttonElement) {
    const roomElement = document.getElementById(roomId);
    const roomLink = document.getElementById(roomId.replace('room', 'link'));
    if (roomElement && roomLink) {
        if (roomElement.style.backgroundColor === 'grey') {
            roomElement.style.backgroundColor = 'rgba(128, 128, 128, 0.522)';
            roomElement.style.color = 'black';
            roomLink.classList.remove('disabled-link');
            buttonElement.classList.remove('habitacion-desactivada', 'hover-permanente');
            localStorage.setItem(roomId, 'disabled');
        } else {
            roomElement.style.backgroundColor = 'grey';
            roomElement.style.color = 'black';
            roomLink.classList.add('disabled-link');
            buttonElement.classList.add('habitacion-desactivada');
            localStorage.setItem(roomId, 'disabled');
        }
    }
}

function toggleSpecialRoomState(roomId, buttonElement) {
    const roomElement = document.getElementById(roomId);
    const roomLink = document.getElementById(roomId.replace('room', 'link'));
    const roomColor = window.roomColors[roomId];
    if (roomElement && roomLink) {
        if (roomElement.style.backgroundColor === 'rgba(128, 128, 128, 0.522)') {
            roomElement.style.backgroundColor = roomColor;
            roomLink.classList.remove('disabled-link');
            buttonElement.classList.remove('habitacion-desactivada', 'hover-permanente');
            localStorage.setItem(roomId, 'enabled');
        } else if (roomElement.style.backgroundColor === roomColor) {
            roomElement.style.backgroundColor = 'rgba(128, 128, 128, 0.522)';
            roomElement.style.color = 'black';
            roomLink.classList.add('disabled-link');
            buttonElement.classList.add('habitacion-desactivada');
            localStorage.setItem(roomId, 'disabled');
        } else {
            roomElement.style.backgroundColor = roomColor;
            roomLink.classList.remove('disabled-link');
            buttonElement.classList.remove('habitacion-desactivada');
            localStorage.setItem(roomId, 'enabled');
        }
    }
}
