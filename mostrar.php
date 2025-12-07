<?php
include('1conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mostrar Tablas | Admin MeowWoof</title>
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
      max-width: 1200px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }

    h2 {
      color: #0078d7;
      text-align: center;
      margin-top: 40px;
    }

    .tabla {
      margin-bottom: 50px;
      overflow-x: auto;
      background-color: #fdfdfd;
      border-radius: 10px;
      padding: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #0078d7;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #0078d7;
      color: white;
      font-weight: 600;
    }

    tr:nth-child(even) {
      background-color: #f2f7fc;
    }

    tr:hover {
      background-color: #e8f2ff;
    }

    .volver {
      display: inline-block;
      text-decoration: none;
      background: #0078d7;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      margin: 20px auto;
      font-weight: 600;
      transition: 0.3s;
    }

    .volver:hover {
      background: #005fa3;
    }

    footer {
      text-align: center;
      padding: 15px;
      background: #0078d7;
      color: white;
      margin-top: 50px;
      font-size: 14px;
    }

    .vacio {
      text-align: center;
      color: #777;
      font-style: italic;
    }
  </style>
</head>
<body>
  <header>🐾 Panel de Administración - MeowWoof</header>

  <div class="contenedor">
    <h2>📋 Tablas registradas en la base de datos</h2>

    <?php
    $consultaTablas = mysqli_query($conexion, "SHOW TABLES");

    if (mysqli_num_rows($consultaTablas) > 0) {
      while ($filaTabla = mysqli_fetch_array($consultaTablas)) {
        $nombreTabla = $filaTabla[0];
        echo "<div class='tabla'>";
        echo "<h3 style='color:#005fa3; text-align:center;'>📑 Tabla: <b>$nombreTabla</b></h3>";

        $consultaDatos = mysqli_query($conexion, "SELECT * FROM $nombreTabla");

        if (mysqli_num_rows($consultaDatos) > 0) {
          echo "<table>";
          $columnas = mysqli_fetch_fields($consultaDatos);
          echo "<tr>";
          foreach ($columnas as $columna) {
            if ($columna->name !== 'foto') {
              echo "<th>{$columna->name}</th>";
            }
          }
          echo "</tr>";

          while ($fila = mysqli_fetch_assoc($consultaDatos)) {
            echo "<tr>";
            foreach ($fila as $campo => $valor) {
              if ($campo !== 'foto') { 
                echo "<td>" . htmlspecialchars($valor) . "</td>";
              }
            }
            echo "</tr>";
          }

          echo "</table>";
        } else {
          echo "<p class='vacio'>Esta tabla no contiene registros.</p>";
        }

        echo "</div>";
      }
    } else {
      echo "<p style='text-align:center; color:red;'>No se encontraron tablas en la base de datos.</p>";
    }

    mysqli_close($conexion);
    ?>

    <center><a href="1panel_admin.html" class="volver">⬅ Volver al panel</a></center>
  </div>
</body>
</html>

