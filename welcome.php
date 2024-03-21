<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Bienvenido, <?php echo $_SESSION['username']; ?>!
                    </div>
                    <div class="card-body">
                        <p>Has iniciado sesión correctamente.</p>
                        <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
