<?php
include "controlador/Control_Login.php";
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
    
<!-- Ejemplo de uso -->
    <?php
        // Crear instancia del controlador de login y registro
        $controlLogin = new Control_Login();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

            if ($action === 'login') {
                $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

                if ($resultado = $controlLogin->autenticarUsuario($user_id, $password)) {
                    
                    $ListaUsuarios = $controlLogin->traerUsuarioC($user_id, $password);
                    $user_id = $ListaUsuarios[0];
                    $tipo = $ListaUsuarios[1];
                    
                    if ($tipo == 0) {

                        $_SESSION['user_id'] = strtoupper($user_id);
                        header("Location: confirmarC.php");
                        exit();
                    } elseif ($tipo == 1) {

                        $_SESSION['user_id'] = strtoupper($user_id);
                        header("Location: confirmarE.php");
                        exit();
                    }
                    
                } else {
                    $mensaje_error = "Credenciales incorrectas. Intente de nuevo.";
                }

            } elseif ($action === 'register') {
                $dni = filter_input(INPUT_POST, 'dni', FILTER_SANITIZE_STRING);
                $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
                $edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);
                $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
                $direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
                $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
                $tipo_usuario = filter_input(INPUT_POST, 'tipo_usuario', FILTER_SANITIZE_STRING);
                $contraseña = filter_input(INPUT_POST, 'contraseña', FILTER_SANITIZE_STRING);
                $estado = "Activo";

                if ($controlLogin->registrarUsuarioC($dni, $nombre, $edad, $correo, $direccion, $telefono, $tipo_usuario, $contraseña, $estado)) {
                    header("Location: Index.php"); // Redirige a una página de confirmación de registro
                    exit();
                } else {
                    $mensaje_error_R = "Error en el registro. Intente de nuevo.";
                }
            }

        }
    ?>
<br>
<br>
<div class="cont">
    <div class="form sign-in">
        <form method="POST">
            <h2>Welcome</h2>
            <label>
                <span>Email</span>
                <input type="email" id="user_id" name="user_id" required/>
            </label>
            <label>
                <span>Password</span>
                <input type="password" id="password" name="password" required/>
            </label>
            <p class="forgot-pass">Forgot password?</p>
            <input type="hidden" name="action" value="login">
            <button type="submit" class="submit">Sign in</button>
        </form>
        <?php if (!empty($mensaje_error)) { ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $mensaje_error; ?>
            </div>
        <?php } ?>
    </div>

    <div class="sub-cont">
        <div class="img">
            <div class="img__text m--up">
                <h3>Don't have an account? Please Sign up!<h3>
            </div>
            <div class="img__text m--in">
                <h3>If you already has an account, just sign in.<h3>
            </div>
            <div class="img__btn">
                <span class="m--up">Sign Up</span>
                <span class="m--in">Sign In</span>
            </div>
        </div>

        <div class="form sign-up">
            <form method="POST">
                <h2>Create your Account</h2>
                <div class="columns">
                    <div class="column">
                        <label>
                            <span>DNI</span>
                            <input type="text" name="dni" id="dni" required />
                        </label>
                        <label>
                            <span>Name</span>
                            <input type="text" name="nombre" id="nombre" required />
                        </label>
                        <label>
                            <span>Age</span>
                            <input type="number" name="edad" id="edad" required />
                        </label>
                        <label>
                            <span>Address</span>
                            <input type="text" name="direccion" id="direccion" required />
                        </label>
                    </div>
                    <div class="column">
                        <label>
                            <span>Phone</span>
                            <input type="tel" name="telefono" id="telefono" required />
                        </label>
                        <label>
                            <span>Tipo de Usuario</span>
                            <select name="tipo_usuario" class="styled-select" id="tipo_usuario" required>
                                <option value="0">Cliente</option>
                                <option value="1">Empleado</option>
                            </select>
                        </label>
                        <label>
                            <span>Email</span>
                            <input type="email" name="correo" id="correo" required />
                        </label>
                        <label>
                            <span>Password</span>
                            <input type="password" name="contraseña" id="contraseña" required />
                        </label>
                    </div>
                </div>
                <input type="hidden" name="action" value="register">
                <button type="submit" class="submit">Sign Up</button>
            </form>
            <?php if (!empty($mensaje_error_R)) { ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $mensaje_error_R; ?>
                </div>
            <?php } ?>
        </div>
    </div>

<script>
    document.querySelector('.img__btn').addEventListener('click', function() {
        document.querySelector('.cont').classList.toggle('s--signup');
    });
</script>

</body>
</html>
