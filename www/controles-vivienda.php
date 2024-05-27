<div class="controles-vivienda">
            <div class="escala-temperatura">
                <h2>Escala de temperatura</h2>
                <ul>
                    <li><span class="color" style="background-color:#FF0000;"></span>30°C o más</li>
                    <li><span class="color" style="background-color:#FFA500;"></span>25°C - 29°C</li>
                    <li><span class="color" style="background-color:#FFFF00;"></span>20°C - 24°C</li>
                    <li><span class="color" style="background-color:#C0C0C0;"></span>15°C - 19°C</li>
                    <li><span class="color" style="background-color:#808080;"></span>10°C o menos</li>
                </ul>
            </div>
            <div class="desactivar">
                <h2>Desactivar habitaciones</h2>
                <button class="desact" id="btnCocina">Cocina</button>
                <button class="desact" id="btnEntrada">Entrada</button>
                <button class="desact" id="btnSalon">Salón</button>
                <button class="desact" id="btnHabitacion1">Habitación 1</button>
                <button class="desact" id="btnHabitacion2">Habitación 2</button>
                <button class="desact" id="btnDormitorio">Dormitorio</button>
                <button class="desact" id="btnBalcon">Balcón</button>
                <button class="desact" id="btnBano">Baño</button>
                <button class="desact" id="btnHall">Hall</button>
            </div>
            <div class="control-ac">
                <h2>Control de Aire Acondicionado</h2>
                <button class="ac-control" id="btnActivarAC">Activar A/C</button>
                <button class="ac-control" id="btnDesactivarAC">Desactivar A/C</button>
            </div>
            <div class="control-temperatura">
                <h2>Control de Temperatura</h2>
                <input type="range" id="sliderTemperatura" min="10" max="30" value="20" step="1">
                <span id="valorTemperatura">20°C</span>
                <button class="aplicar-cambios" id="btnAplicarCambios">Aplicar Cambios</button>
            </div>
        </div>