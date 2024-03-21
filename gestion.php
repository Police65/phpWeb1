<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar'])) {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];
    $nota4 = $_POST['nota4'];

    // Conexion
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_example";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si el alumno ya existe en la base de datos
    $sql_select = "SELECT * FROM alumnos WHERE cedula='$cedula'";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        // El alumno ya existe, actualizar sus notas y calcular promedio
        $sql_update = "UPDATE alumnos SET nombre='$nombre', nota1='$nota1', nota2='$nota2', nota3='$nota3', nota4='$nota4' WHERE cedula='$cedula'";
        if ($conn->query($sql_update) === TRUE) {
          
            $promedio = ($nota1 + $nota2 + $nota3 + $nota4) / 4;
            
            // Actualizar el promedio
            $sql_promedio = "UPDATE alumnos SET promedio='$promedio' WHERE cedula='$cedula'";
            if ($conn->query($sql_promedio) === TRUE) {
                echo '<div class="alert alert-success" role="alert">Notas actualizadas correctamente para el alumno. Promedio calculado y guardado.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error al calcular y guardar el promedio: ' . $conn->error . '</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al actualizar notas: ' . $conn->error . '</div>';
        }
    } else {
        // Validacion
        $sql_insert = "INSERT INTO alumnos (cedula, nombre, nota1, nota2, nota3, nota4) VALUES ('$cedula', '$nombre', '$nota1', '$nota2', '$nota3', '$nota4')";
        if ($conn->query($sql_insert) === TRUE) {
          
            $promedio = ($nota1 + $nota2 + $nota3 + $nota4) / 4;

      
            $sql_promedio = "UPDATE alumnos SET promedio='$promedio' WHERE cedula='$cedula'";
            if ($conn->query($sql_promedio) === TRUE) {
                echo '<div class="alert alert-success" role="alert">Alumno y notas agregados correctamente. Promedio calculado y guardado.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error al calcular y guardar el promedio: ' . $conn->error . '</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al agregar alumno y notas: ' . $conn->error . '</div>';
        }
    }

    $conn->close();
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Notas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h2>Gestión de Notas de Alumnos</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
             
                    <div class="form-group">
                        <label for="cedula">Cédula del Alumno:</label>
                        <input type="text" class="form-control" id="cedula" name="cedula">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre del Alumno:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>

          
                    <div class="form-group">
                        <label for="nota1">Nota 1:</label>
                        <input type="text" class="form-control" id="nota1" name="nota1">
                    </div>
                    <div class="form-group">
                        <label for="nota2">Nota 2:</label>
                        <input type="text" class="form-control" id="nota2" name="nota2">
                    </div>
                    <div class="form-group">
                        <label for="nota3">Nota 3:</label>
                        <input type="text" class="form-control" id="nota3" name="nota3">
                    </div>
                    <div class="form-group">
                        <label for="nota4">Nota 4:</label>
                        <input type="text" class="form-control" id="nota4" name="nota4">
                    </div>

                 

                    <button type="submit" class="btn btn-primary" name="agregar">Agregar Alumno o Actualizar Notas</button>
                     

                     <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
