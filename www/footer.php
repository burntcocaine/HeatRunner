<footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h2>Contacto</h2>
                <p>Dirección: Calle Falsa 123, Ciudad, País</p>
                <p>Teléfono: +123 456 789</p>
                <p>Email: contacto@heatrunner.com</p>
            </div>
            <div class="footer-section">
                <h2>Navegación</h2>
                <ul>
                    <li><a href="../vivienda.php">Inicio</a></li>
                    <li><a href="../about.php">Sobre Nosotros</a></li>
                    <li><a href="../services.php">Servicios</a></li>
                    <li><a href="../cerrarSesion.php">Cerrar sesión</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h2>Síguenos</h2>
                <ul class="social-links">
                    <li><a href="https://facebook.com" target="_blank">Facebook</a></li>
                    <li><a href="https://twitter.com" target="_blank">Twitter</a></li>
                    <li><a href="https://instagram.com" target="_blank">Instagram</a></li>
                    <li><a href="https://linkedin.com" target="_blank">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 HeatRunner. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script type="text/javascript">
        window.roomColors = <?php echo json_encode($colores); ?>;
    </script>
    <script type="text/javascript" src="vivienda.js"></script>
</body>
</html>
