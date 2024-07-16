<?php
include "controlador/Control_ClienteMain.php";
include "controlador/Control_FormPrestamo.php";
require_once 'dao/DAO_Libro.php';
session_start();

// Verifica si el user_id está en la sesión
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $control = new Control_ClienteMain();

    $userdata = $control->getUserDataC($user_id);


} else {
    // Si no hay user_id en la sesión, redirige al usuario a la página de inicio de sesión
    header("Location: Index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/cssForm.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.2/css/all.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Establecer la fecha actual en el campo de fecha de préstamo
            var today = new Date();
            var day = String(today.getDate()).padStart(2, '0');
            var month = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0!
            var year = today.getFullYear();
            var currentDate = year + '-' + month + '-' + day;
            document.getElementById('fec_pre').value = currentDate;

            // Establecer la hora actual en el campo de hora de préstamo
            var hours = String(today.getHours()).padStart(2, '0');
            var minutes = String(today.getMinutes()).padStart(2, '0');
            var currentTime = hours + ':' + minutes;
            document.getElementById('hor_pre').value = currentTime;
            document.getElementById('hor_dev').value = currentTime;

            // Calcular la fecha máxima de devolución (una semana a partir de hoy)
            var maxDate = new Date();
            maxDate.setDate(today.getDate() + 7);
            var maxDay = String(maxDate.getDate()).padStart(2, '0');
            var maxMonth = String(maxDate.getMonth() + 1).padStart(2, '0'); // Enero es 0!
            var maxYear = maxDate.getFullYear();
            var maxDateString = maxYear + '-' + maxMonth + '-' + maxDay;

            // Establecer los valores mínimos y máximos para el campo de fecha de devolución
            document.getElementById('fec_dev').setAttribute('min', currentDate);
            document.getElementById('fec_dev').setAttribute('max', maxDateString);
        });
    </script>

</head>

<body id="page-top">

    <?php
        // Crear instancia del controlador de login y registro
        //$control = new Control_FormPrestamo();
        if (isset($_GET['id_lib'])) {
            $id_lib = $_GET['id_lib'];
        } else {
            echo "No se ha proporcionado el ID del libro.";
        }

        $user_id = $_SESSION['user_id'];

        $controlPrestamo = new Control_FormPrestamo();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificamos que la acción sea 'register'
            $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
            if ($action === 'register') {
                // Recogemos los datos del formulario
                $id_persona = filter_input(INPUT_POST, 'id_per', FILTER_VALIDATE_INT);
                $id_libro = filter_input(INPUT_POST, 'id_lib', FILTER_VALIDATE_INT);
                $fecha_prestamo = filter_input(INPUT_POST, 'fec_pre', FILTER_SANITIZE_STRING); // No editable, readonly en HTML
                $hora_prestamo = filter_input(INPUT_POST, 'hor_pre', FILTER_SANITIZE_STRING); // No editable, readonly en HTML
                $fecha_devolucion = filter_input(INPUT_POST, 'fec_dev', FILTER_SANITIZE_STRING);
                $hora_devolucion = filter_input(INPUT_POST, 'hor_dev', FILTER_SANITIZE_STRING); // No editable, readonly en HTML
        
                // Aquí podrías realizar validaciones adicionales si es necesario
        
                // Ejemplo de datos adicionales
                $estado = "Pendiente entrega"; // O cualquier otro estado que definas

                $state = 0;
                        $daoLib = new DAO_Libro();
                        $daoLib->actualizarEstado($id_libro, $state);
        
                // Llamar a tu función para registrar el préstamo
                $respuesta = $controlPrestamo->registrarPrestamo($id_persona, $id_libro, $fecha_prestamo, $hora_prestamo, $fecha_devolucion, $hora_devolucion, $estado);

                if ($respuesta) {
                    header("Location: VistaClienteMain.php"); // Redirige a la página principal u otra página de confirmación
                    exit();
                } else {
                    $mensaje_error_R = "Error en el registro del préstamo. Intente de nuevo.";
                }
            }
        }


    ?>



    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="VistaClienteMain.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-book"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Libreria Mery </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Funciones
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="VistaClienteMain.php">
                    <i class="fa-solid fa-book-open"></i>
                    <span>Libros</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="VistaClientePrestamos.php">
                    <i class="fa-solid fa-bookmark"></i>
                    <span>Prestamos</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="VistaClienteCalendario.php">
                    <i class="fa-solid fa-calendar-alt"></i>
                    <span>Calendario</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="VistaClientePenalizaciones.php">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>Penalizaciones</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                About us
            </div>

            
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fa-brands fa-facebook"></i>
                    <span>Facebook</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fa-brands fa-instagram"></i>
                    <span>Instagram</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>WhatsApp</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="controlador/Control_Logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Log Out</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$userdata[0]?> - <?=$userdata[1]?></span>
                                
                                <i class="fa-solid fa-id-card"></i>

                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Editar Informacion Personal
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Formulario para Registrar un Prestamo</h1>
                        
                    </div>

                    <!-- Content Row Formulario-->
                    <div class="row">

                        <form id="formPrestamo" method="POST">

                            <div class="columns">
                                <div class="column">
                                    <div class="form-group">
                                        <label for="id_per">ID Persona</label>
                                        <input type="number" class="form-control" id="id_per" name="id_per" value="<?php echo $user_id; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_lib">ID Libro</label>
                                        <input type="number" class="form-control" id="id_lib" name="id_lib" value="<?php echo $id_lib; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="fec_pre">Fecha de Préstamo</label>
                                        <input type="date" class="form-control" id="fec_pre" name="fec_pre" readonly>
                                    </div>
                                </div> 

                                <div class="column"> 
                                    <div class="form-group">
                                        <label for="hor_pre">Hora de Préstamo</label>
                                        <input type="time" class="form-control" id="hor_pre" name="hor_pre" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="fec_dev">Fecha de Devolución</label>
                                        <input type="date" class="form-control" id="fec_dev" name="fec_dev" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="hor_dev">Hora de Devolución</label>
                                        <input type="time" class="form-control" id="hor_dev" name="hor_dev" readonly>
                                    </div>
                                </div>

                            </div>
                            <input type="hidden" name="action" value="register">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>

                        <?php if (!empty($mensaje_error_R)) { ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo $mensaje_error_R; ?>
                            </div>
                        <?php } ?>

                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>