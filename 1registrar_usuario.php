<?php
include('1conexion.php');
$mensaje = "";
$tipo = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = trim($_POST['nombre']);
  $email = trim($_POST['email']);
  $telefono = trim($_POST['telefono']);
  $password = trim($_POST['password']);

  if ($nombre && $email && $telefono && $password) {
    // Validar si el usuario o correo ya existen
    $check_email = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email='$email'");
    if (mysqli_num_rows($check_email) > 0) {
      $mensaje = " Este correo ya está registrado. Intente con otro.";
      $tipo = "error";
    } else {
      $insertar = "INSERT INTO usuarios (nombre, email, telefono, password) 
                   VALUES ('$nombre', '$email', '$telefono', '$password')";
      if (mysqli_query($conexion, $insertar)) {
        $mensaje = " Usuario registrado correctamente.";
        $tipo = "exito";
      } else {
        $mensaje = " Error al registrar el usuario.";
        $tipo = "error";
      }
    }
  } else {
    $mensaje = " Complete todos los campos antes de continuar.";
    $tipo = "error";
  }
}
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Usuario | MeowWoof</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #a2c2e0, #f6e6e9);
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 420px;
      margin: 60px auto;
      background: #fff;
      padding: 35px;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    h2 {
      text-align: center;
      color: #0078d7;
      margin-bottom: 20px;
    }

    label {
      font-weight: 600;
      display: block;
      margin-top: 12px;
    }

    input {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1.5px solid #ccc;
      margin-top: 5px;
      font-size: 15px;
      outline: none;
      transition: 0.3s;
    }

    input:focus {
      border-color: #0078d7;
      box-shadow: 0 0 6px rgba(0,120,215,0.4);
    }

    small.error {
      color: #e74c3c;
      font-size: 13px;
      display: none;
    }

    .mensaje {
      text-align: center;
      margin-top: 15px;
      font-weight: bold;
      font-size: 15px;
    }

    .mensaje.exito { color: #27ae60; }
    .mensaje.error { color: #e74c3c; }

    button {
      width: 100%;
      background: #0078d7;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      margin-top: 20px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: 0.3s;
    }

    button:hover { background: #005fa3; }

    .volver {
      display: block;
      text-align: center;
      margin-top: 15px;
      text-decoration: none;
      color: #0078d7;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Registrar Usuario</h2>
    <form method="POST" id="formRegistrar" novalidate>
      <label>Nombre Completo:</label>
      <input type="text" name="nombre" id="nombre" required>
      <small class="error" id="errorNombre"></small>

      <label>Correo Electrónico:</label>
      <input type="email" name="email" id="email" required>
      <small class="error" id="errorEmail"></small>

      <label>Teléfono:</label>
      <input type="text" name="telefono" id="telefono" maxlength="10" required>
      <small class="error" id="errorTelefono"></small>

      <label>Contraseña:</label>
      <input type="password" name="password" id="password" required>
      <small class="error" id="errorPassword"></small>

      <button type="submit">Registrar Usuario</button>
      <div class="mensaje <?php echo $tipo; ?>"><?php echo $mensaje; ?></div>
    </form>

    <a href="1panel_admin.html" class="volver">⬅ Volver al Panel</a>
  </div>

  <script>
    const regexNombre = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,40}$/;
    const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const regexTel = /^\d{10}$/;

    const validar = (campo, regex, idError, mensaje) => {
      const valor = campo.value.trim();
      const error = document.getElementById(idError);
      if (valor === "") {
        error.textContent = "Este campo es obligatorio";
        error.style.display = "block";
      } else if (!regex.test(valor)) {
        error.textContent = mensaje;
        error.style.display = "block";
      } else {
        error.style.display = "none";
      }
    };

    document.getElementById("nombre").addEventListener("input", e => validar(e.target, regexNombre, "errorNombre", "Solo letras y mínimo 3 caracteres"));
    document.getElementById("email").addEventListener("input", e => validar(e.target, regexEmail, "errorEmail", "Correo no válido"));
    document.getElementById("telefono").addEventListener("input", e => validar(e.target, regexTel, "errorTelefono", "Debe tener 10 dígitos"));
    document.getElementById("password").addEventListener("input", e => {
      const error = document.getElementById("errorPassword");
      const valor = e.target.value.trim();
      if (valor === "") {
        error.textContent = "Este campo es obligatorio";
        error.style.display = "block";
      } else if (valor.length < 6) {
        error.textContent = "Mínimo 6 caracteres";
        error.style.display = "block";
      } else {
        error.style.display = "none";
      }
    });

    document.getElementById("formRegistrar").addEventListener("submit", e => {
      const campos = ["nombre", "email", "telefono", "password"];
      let valido = true;
      campos.forEach(id => {
        const input = document.getElementById(id);
        if (input.value.trim() === "") {
          document.getElementById("error" + id.charAt(0).toUpperCase() + id.slice(1)).textContent = "Este campo es obligatorio";
          document.getElementById("error" + id.charAt(0).toUpperCase() + id.slice(1)).style.display = "block";
          valido = false;
        }
      });
      if (!valido) e.preventDefault();
    });
  </script>
</body>
</html>
