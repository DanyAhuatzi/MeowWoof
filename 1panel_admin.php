<?php
session_start();
include("conexion.php");

// Evitar volver atrás y forzar recarga siempre
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// Verificar si hay sesión activa y si es administrador
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración | MeowWoof</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #a2c2e0, #f6e6e9);
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #0078d7;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 25px;
    }

    header h1 {
      margin: 0;
      font-size: 1.6rem;
    }

    .perfil {
      position: relative;
      cursor: pointer;
    }

    .perfil img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      border: 2px solid white;
      object-fit: cover;
    }

    .menu-perfil {
      display: none;
      position: absolute;
      right: 0;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      padding: 10px;
      margin-top: 10px;
      min-width: 220px;
      z-index: 100;
    }

    .menu-perfil.visible {
      display: block;
    }

    .menu-perfil p {
      margin: 8px 0;
      color: #333;
      font-size: 14px;
    }

    .cerrar-sesion {
      display: block;
      text-align: center;
      padding: 8px;
      background-color: #d9534f;
      color: white;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      margin-top: 10px;
      transition: 0.3s;
    }

    .cerrar-sesion:hover {
      background-color: #b52b27;
    }

    main {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 85vh;
    }

    .panel {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
      width: 380px;
      text-align: center;
    }

    .panel h2 {
      color: #0078d7;
      margin-bottom: 20px;
    }

    .botones {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .botones a {
      display: block;
      padding: 12px;
      border-radius: 8px;
      background-color: #0078d7;
      color: white;
      text-decoration: none;
      font-size: 16px;
      font-weight: 600;
      transition: 0.3s;
    }

    .botones a:hover {
      background-color: #005fa3;
    }
  </style>
</head>
<body>
  <header>
    <h1>🐾 Panel de Administración - MeowWoof</h1>
    <div class="perfil" onclick="toggleMenu()">
      <img src="img/perfil.png" alt="Perfil">
      <div class="menu-perfil" id="menuPerfil">
        <p><strong>Nombre:</strong> <?php echo $_SESSION['nombre']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
        <p><strong>Teléfono:</strong> <?php echo $_SESSION['telefono']; ?></p>
        <a href="logout.php" class="cerrar-sesion">Cerrar sesión</a>
      </div>
    </div>
  </header>

  <main>
    <div class="panel">
      <h2>Opciones disponibles</h2>
      <div class="botones">
        <a href="mostrar.php">Mostrar tablas</a>
        <a href="1registrar_usuario.php">Registrar usuario</a>
        <a href="1actualizar_usuario.php">Actualizar usuario</a>
        <a href="1eliminar_usuario.php">Eliminar usuario</a>
      </div>
    </div>
  </main>

  <script>
    function toggleMenu() {
      const menu = document.getElementById('menuPerfil');
      menu.classList.toggle('visible');
    }

    // Cierra el menú si haces clic fuera
    document.addEventListener('click', (e) => {
      const perfil = document.querySelector('.perfil');
      const menu = document.getElementById('menuPerfil');
      if (!perfil.contains(e.target)) {
        menu.classList.remove('visible');
      }
    });
  </script>
</body>
</html>
