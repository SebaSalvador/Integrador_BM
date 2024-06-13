<?php
include "controlador/Control_Login.php";
require_once "dao/DAO_Libro.php";
require_once "modelo/Libro.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/cssLogin.css">
</head>
<body>
    <?php
    $daoLibro = new DAO_Libro();
    $array = $daoLibro->listarLibros();
    foreach ($array as $obj) {
        $titulo = $obj->getTitulo();
        echo $titulo.'<br>';

    }
    ?>


<!-- Ejemplo de uso -->
<?php
// Crear instancia del controlador
$controlLogin = new Control_Login();

// Intentar autenticar al usuario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if ($resultado = $controlLogin->autenticarUsuario($user_id, $password)) {
        $_SESSION['user_id'] = strtoupper($user_id);
        header("Location: confirmar.php");
        exit();
    } else {
        $mensaje_error = "Credenciales incorrectas. Intente de nuevo.";
    }
}

?>

    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="path/to/logo.png" alt="Logo">
            </div>
            <h2>Please sign in</h2>
            <form method="POST">
                <div class="input-group">
                    <label for="email">Email address</label>
                    <input type="text" id="user_id" name="user_id" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <button type="submit">Sign in</button>
            </form>
            <?php if (!empty($mensaje_error)) { ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $mensaje_error; ?>
                </div>
                <?php } ?>
            <footer>
                <p>© 2017–2024</p>
            </footer>
        </div>
    </div>
</body>
</html>