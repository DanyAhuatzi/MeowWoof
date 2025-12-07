<?php
include('1conexion.php');
$mensaje = "";
$tipo = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = trim($_POST['id']);
  $nombre = trim($_POST['nombre']);
  $email = trim($_POST['email']);
  $telefono = trim($_POST['telefono']);
  $password = trim($_POST['password']);

  if (!empty($id)) {
    $check = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id = '$id'");
    if (mysqli_num_rows($check) > 0) {
      $sql = "UPDATE usuarios SET 
              nombre='$nombre', 
              email='$email', 
              telefono='$telefono', 
              password='$password'
              WHERE id='$id'";
      if (mysqli_query($conexion, $sql)) {
        $mensaje = " Usuario actualizado correctamente.";
        $tipo = "exito";
      } else {
        $mensaje = " Error al actualizar el usuario.";
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
  <title>Actualizar Usuario | MeowWoof</title>
  <style>
    body {font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#a2c2e0,#f6e6e9);}
    .container{max-width:420px;margin:60px auto;background:#fff;padding:35px;border-radius:15px;box-shadow:0 6px 20px rgba(0,0,0,0.15);}
    h2{text-align:center;color:#0078d7;margin-bottom:20px;}
    label{font-weight:600;display:block;margin-top:12px;}
    input{width:100%;padding:10px;border-radius:8px;border:1.5px solid #ccc;margin-top:5px;font-size:15px;}
    input:focus{border-color:#0078d7;box-shadow:0 0 6px rgba(0,120,215,0.4);}
    small.error{color:#e74c3c;font-size:13px;display:none;}
    button{width:100%;background:#0078d7;color:white;border:none;padding:12px;border-radius:8px;margin-top:20px;cursor:pointer;font-size:16px;font-weight:bold;}
    button:hover{background:#005fa3;}
    .mensaje{text-align:center;margin-top:15px;font-weight:bold;}
    .mensaje.exito{color:#27ae60;}
    .mensaje.error{color:#e74c3c;}
    .volver{display:block;text-align:center;margin-top:15px;text-decoration:none;color:#0078d7;font-weight:600;}
  </style>
</head>
<body>
  <div class="container">
    <h2>Actualizar Usuario</h2>
    <form method="POST" id="formActualizar" novalidate>
      <label>ID del Usuario:</label>
      <input type="text" name="id" id="id" required>
      <small class="error" id="errorId"></small>

      <label>Nombre:</label>
      <input type="text" name="nombre" id="nombre">
      <small class="error" id="errorNombre"></small>

      <label>Email:</label>
      <input type="email" name="email" id="email">
      <small class="error" id="errorEmail"></small>

      <label>Teléfono:</label>
      <input type="text" name="telefono" id="telefono" maxlength="10">
      <small class="error" id="errorTelefono"></small>

      <label>Contraseña:</label>
      <input type="password" name="password" id="password">
      <small class="error" id="errorPassword"></small>

      <button type="submit">Actualizar Usuario</button>
      <div class="mensaje <?php echo $tipo; ?>"><?php echo $mensaje; ?></div>
    </form>

    <a href="1panel_admin.html" class="volver">⬅ Volver al Panel</a>
  </div>

  <script>
    const regexId = /^[0-9]+$/;
    const regexNombre = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,40}$/;
    const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const regexTel = /^\d{10}$/;

    const validar = (campo, regex, idError, mensaje) => {
      const valor = campo.value.trim();
      const error = document.getElementById(idError);
      if (!regex.test(valor) && valor !== "") {
        error.textContent = mensaje;
        error.style.display = "block";
      } else {
        error.style.display = "none";
      }
    };

    document.getElementById("id").addEventListener("input", e => validar(e.target, regexId, "errorId", "Solo números enteros"));
    document.getElementById("nombre").addEventListener("input", e => validar(e.target, regexNombre, "errorNombre", "Solo letras, mínimo 3 caracteres"));
    document.getElementById("email").addEventListener("input", e => validar(e.target, regexEmail, "errorEmail", "Correo no válido"));
    document.getElementById("telefono").addEventListener("input", e => validar(e.target, regexTel, "errorTelefono", "Debe tener 10 dígitos"));
    document.getElementById("password").addEventListener("input", e => {
      const error = document.getElementById("errorPassword");
      error.style.display = e.target.value.length > 0 && e.target.value.length < 6 ? "block" : "none";
      error.textContent = "Mínimo 6 caracteres";
    });
  </script>
</body>
</html>
