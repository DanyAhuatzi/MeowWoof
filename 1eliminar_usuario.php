<?php
include('1conexion.php');
$mensaje = "";
$tipo = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = trim($_POST['id']);

  if (!empty($id)) {
    $check = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id = '$id'");
    if (mysqli_num_rows($check) > 0) {
      $delete = mysqli_query($conexion, "DELETE FROM usuarios WHERE id = '$id'");
      if ($delete) {
        $mensaje = " Usuario eliminado correctamente.";
        $tipo = "exito";
      } else {
        $mensaje = " Error al eliminar el usuario.";
        $tipo = "error";
      }
    } else {
      $mensaje = " No existe ningún usuario con ese ID.";
      $tipo = "error";
    }
  } else {
    $mensaje = " Ingrese un ID válido.";
    $tipo = "error";
  }
}
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Eliminar Usuario | MeowWoof</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #a2c2e0, #f6e6e9);
      margin: 0;
      padding: 0;
      color: #333;
    }

    header {
      background: #0078d7;
      color: #fff;
      text-align: center;
      padding: 20px;
      font-size: 1.8rem;
      font-weight: bold;
    }

    .contenedor {
      max-width: 500px;
      margin: 80px auto;
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
      text-align: center;
    }

    h2 {
      color: #0078d7;
      margin-bottom: 20px;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
    }

    input[type="number"] {
      width: 80%;
      padding: 10px;
      border: 2px solid #0078d7;
      border-radius: 8px;
      outline: none;
      font-size: 16px;
      transition: 0.3s;
    }

    input[type="number"]:focus {
      border-color: #005fa3;
      box-shadow: 0 0 5px rgba(0,120,215,0.5);
    }

    button {
      background: #0078d7;
      color: white;
      border: none;
      padding: 10px 25px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #005fa3;
    }

    .mensaje {
      margin-top: 20px;
      padding: 10px;
      border-radius: 8px;
      font-weight: 500;
    }

    .exito {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

    .volver {
      display: inline-block;
      margin-top: 25px;
      text-decoration: none;
      background: #0078d7;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      transition: 0.3s;
    }

    .volver:hover {
      background: #005fa3;
    }
  </style>
</head>
<body>
  <header> Eliminar Usuario - MeowWoof</header>

  <div class="contenedor">
    <h2>Eliminar Usuario por ID</h2>
    <form method="POST" action="">
      <input type="number" name="id" placeholder="Ingrese ID del usuario" required>
      <button type="submit">Eliminar</button>
    </form>

    <?php if (!empty($mensaje)): ?>
      <div class="mensaje <?php echo $tipo; ?>">
        <?php echo $mensaje; ?>
      </div>
    <?php endif; ?>

    <a href="1panel_admin.html" class="volver">⬅ Volver al panel</a>
  </div>
</body>
</html>


