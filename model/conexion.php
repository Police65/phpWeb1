<?php
include_once('model/conexion.php');

// Verificar si se han enviado datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $cedula = $_POST['cedula'];
    $correo = $_POST['correo'];
    $semestre = $_POST['semestre'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];
    $nota4 = $_POST['nota4'];

    // Calcular el promedio
    $promedio = ($nota1 + $nota2 + $nota3 + $nota4) / 4;

    // Preparar la consulta SQL para insertar los datos en la tabla de alumnos
    $sql = "INSERT INTO alumnos (cedula, correo, semestre, nota1, nota2, nota3, nota4, promedio) 
            VALUES (:cedula, :correo, :semestre, :nota1, :nota2, :nota3, :nota4, :promedio)";
    $stmt = $bd->prepare($sql);

    // Asociar parámetros con valores
    $stmt->bindParam(':cedula', $cedula);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':semestre', $semestre);
    $stmt->bindParam(':nota1', $nota1);
    $stmt->bindParam(':nota2', $nota2);
    $stmt->bindParam(':nota3', $nota3);
    $stmt->bindParam(':nota4', $nota4);
    $stmt->bindParam(':promedio', $promedio);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Alumno registrado exitosamente.";
    } else {
        echo "Error al registrar alumno.";
    }
}
?>
