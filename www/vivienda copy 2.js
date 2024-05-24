document.addEventListener('DOMContentLoaded', () => {
    // Carga inicial de los colores desde el servidor
    fetch('obtener_colores.php')
        .then(response => response.json())
        .then(data => {
            window.roomColors = data;
            console.log('Colores cargados:', window.roomColors);
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
    btnActivarAC.addEventListener('click', () => {
        // Lógica para activar el aire acondicionado
        console.log('Aire acondicionado activado');
    });

    btnDesactivarAC.addEventListener('click', () => {
        // Lógica para desactivar el aire acondicionado
        console.log('Aire acondicionado desactivado');
    });

    // Actualizar el valor del slider de temperatura
    sliderTemperatura.addEventListener('input', () => {
        valorTemperatura.textContent = `${sliderTemperatura.value}°C`;
    });

    // Aplicar cambios de temperatura
    btnAplicarCambios.addEventListener('click', () => {
        // Lógica para aplicar el cambio de temperatura
        console.log(`Temperatura ajustada a ${sliderTemperatura.value}°C`);
    });

    // Configura todos los elementos de la interfaz aquí...
    rooms.forEach(room => {
        const roomElement = document.getElementById(room);
        const roomLink = document.getElementById(room.replace('room', 'link'));
        const roomState = localStorage.getItem(room);
        if (roomState === 'disabled') {
            
            roomLink.classList.add('disabled-link');
        }
    });

    specialRooms.forEach(room => {
        const roomElement = document.getElementById(room);
        const roomLink = document.getElementById(room.replace('room', 'link'));
        const roomState = localStorage.getItem(room);
        if (roomState === 'disabled') {
            
            roomLink.classList.add('disabled-link');
        }
    });

    buttons.forEach(buttonId => {
        const buttonElement = document.getElementById(buttonId);
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
    });

    specialButtons.forEach(buttonId => {
        const buttonElement = document.getElementById(buttonId);
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
    });
}

function toggleRoomState(roomId, buttonElement) {
    const roomElement = document.getElementById(roomId);
    const roomLink = document.getElementById(roomId.replace('room', 'link'));
    if (roomElement.style.backgroundColor === 'grey') {
        roomElement.style.backgroundColor = '#80808085';
        roomElement.style.color = 'black';
        roomLink.classList.remove('disabled-link');
        buttonElement.classList.remove('habitacion-desactivada');
        localStorage.setItem(roomId, 'enabled');
    } else {
        roomElement.style.backgroundColor = 'grey';
        roomElement.style.color = 'white';
        roomLink.classList.add('disabled-link');
        buttonElement.classList.add('habitacion-desactivada');
        localStorage.setItem(roomId, 'disabled');
    }
}

function toggleSpecialRoomState(roomId, buttonElement) {
    const roomElement = document.getElementById(roomId);
    const roomLink = document.getElementById(roomId.replace('room', 'link'));
    var roomColor = roomColors[roomId];
    if (roomElement.style.backgroundColor === 'grey') {
        roomElement.style.backgroundColor = roomColors[roomId];
        roomElement.style.color = 'white';
        roomLink.classList.remove('disabled-link');
        buttonElement.classList.remove('habitacion-desactivada', 'hover-permanente');
        localStorage.setItem(roomId, 'enabled');
    } else if (roomElement.style.backgroundColor === roomColor) {
        roomElement.style.backgroundColor = 'grey';
        roomElement.style.color = 'white';
        roomLink.classList.add('disabled-link');
        buttonElement.classList.add('habitacion-desactivada', 'hover-permanente');
        localStorage.setItem(roomId, 'disabled');
    } else {
        roomElement.style.backgroundColor = roomColor;
        roomElement.style.color = 'white';
        roomLink.classList.remove('disabled-link');
        buttonElement.classList.remove('habitacion-desactivada', 'hover-permanente');
        localStorage.setItem(roomId, 'enabled');
    }
}