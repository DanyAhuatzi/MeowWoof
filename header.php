<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

$nombre = $_SESSION['nombre'];
$email = $_SESSION['email'];
$telefono = $_SESSION['telefono'];
$tipo = $_SESSION['tipo_usuario'];
?>

<header class="navbar">
    <div class="logo">
        <img src="logomeow.jpg" alt="Logo MeowWoof">
        <h1>MeowWoof</h1>
    </div>

    <nav class="nav-links">

        <a href="contacto.html">Contacto</a>

        <!-- 👉 CONTENEDOR QUE AHORA INCLUYE FOTO + NOMBRE -->
        <div class="perfil-box" onclick="togglePerfil()">
            <img src="perfil.jpg" class="icono-perfil">
            <span class="nombre-perfil"><?php echo $nombre; ?></span>
        </div>
    </nav>
</header>

<!-- PANEL DE PERFIL -->
<div id="perfil-panel" class="perfil-panel oculto">
    <img src="perfil.jpg" class="perfil-img">

    <h3><?php echo $nombre; ?></h3>
    <p><?php echo $email; ?></p>
    <p><?php echo $telefono; ?></p>
    <p>Tipo: <?php echo $tipo; ?></p>

    <a href="cerrar_sesion.php" class="logout-btn">Cerrar sesión</a>
</div>

<!-- SUBMENÚ IGUAL AL ORIGINAL -->
<div class="submenu">
    <a href="perros.html">Perros</a>
    <a href="gatos.html">Gatos</a>
    <a href="recomendaciones.html">Recomendaciones</a>
    <a href="dejar.html">Dejar Mascota</a>
    <a href="quienes_somos.html">¿Quiénes somos?</a>
    <a href="dona.html">Dona</a>
    <a href="ubicacion.html">Ubicación</a>
    <a href="horarios.html">Horarios</a>
</div>

<script>
function togglePerfil() {
    document.getElementById("perfil-panel").classList.toggle("oculto");
}

document.addEventListener("click", function(e) {
    const panel = document.getElementById("perfil-panel");
    const icon = document.querySelector(".perfil-box");

    if (!panel.contains(e.target) && !icon.contains(e.target)) {
        panel.classList.add("oculto");
    }
});
</script>
