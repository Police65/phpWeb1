<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['username']) && isset($_POST['password'])) {
      
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login_example";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Captura 
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hash
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Usuario registrado correctamente.";
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Por favor, ingresa un nombre de usuario y una contraseña.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Registro de Usuario
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="username">Nombre de usuario</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
