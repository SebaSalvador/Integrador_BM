<?php
include "controlador/Control_ClienteMain.php";
include "controlador/Control_PrestamosCliente.php";
session_start();

// Verifica si el user_id está en la sesión
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $control = new Control_ClienteMain();
    $controlP = new Control_PrestamosCliente();
    

    $userdata = $control->getUserDataC($user_id);
    $listaPrestamosPorUsuario = $controlP->getPrestamosPorUsuario($user_id);

    //$libros = $control->getLibros();

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.2/css/all.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body id="page-top">

    <?php
        // Crear instancia del controlador de login y registro
        $control = new Control_ClienteMain();
        $user_id = $_SESSION['user_id'];
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
                <a class="nav-link" href="index.html">
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
                        <h1 class="h3 mb-0 text-gray-800">Prestamos</h1>
                        
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Prestamo Actual</h5>
                                    <?php
                                        foreach ($listaPrestamosPorUsuario as $prestamo) {
                                            if ($prestamo->getEstado() != "Finalizado") {
                                                echo "<div class='row mb-4'>"; // Fila para cada préstamo
                                                echo "<div class='col-md-9'>"; // Columna izquierda para los detalles del préstamo
                                                echo "<div class='prestamo d-flex align-items-center'>";
                                                
                                                // Estado del libro
                                                echo "<div class='mr-3'>";
                                                echo "<span class='badge badge-success badge-pill'>Estado: " . $prestamo->getEstado() . "</span>";
                                                echo "</div>";
                                                
                                                // Información del préstamo
                                                echo "<div>";
                                                echo "<p>ID Préstamo: " . $prestamo->getIdPre() . "</p>";
                                                echo "<p>Fecha Préstamo: " . $prestamo->getFecPre() . "</p>";
                                                echo "<p>Fecha Devolución: " . $prestamo->getFecDev() . "</p>";
                                                echo "</div>";
                                                
                                                echo "</div>"; // Cierra div prestamo
                                                echo "</div>"; // Cierra columna izquierda
                                                
                                                echo "<div class='col-md-3 text-center'>"; // Columna derecha para la imagen de la portada
                                                $imagenLibro = "galeria/" . $prestamo->getIdLib() . ".jpg"; // Ruta a la imagen del libro
                                                $librodetalle = $control->getLibroDetalle($prestamo->getIdLib());
                                                echo "<img src='$imagenLibro' alt='Portada del libro' class='img-fluid rounded mb-2'>";
                                                echo "<p>" . $librodetalle['titulo'] . "</p>";
                                                echo "</div>"; // Cierra columna derecha
                                                
                                                echo "</div>"; // Cierra fila
                                            }
                                        }
                                    ?>
                                    


                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row Prestamos-Historial -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card mb-4">
                                <div class="col-xl-12 col-lg-7" id="Libros">
                                    <h5 class="card-title">Historial de Prestamos</h5>
                                    <?php
                                        echo "<div class='row mb-4'>";
                                        foreach ($listaPrestamosPorUsuario as $prestamo) {
                                            if ($prestamo->getEstado() == "Finalizado") {
                                                echo "<div class='col-xl-6 col-md-6 mb-4'>";
                                                echo "<div class='card border-left-warning shadow h-100 py-2'>";
                                                echo "<div class='card-body'>";
                                                echo "<div class='row'>";

                                                // ID Préstamo
                                                echo "<div class='col col-md-6'>";
                                                    echo "<div class='text-xs font-weight-bold text-warning text-uppercase mb-1'>ID Préstamo</div>";
                                                    echo "<div class='col'>";
                                                    echo "<div class='h6 mb-0 font-weight-bold text-gray-800'>" . $prestamo->getIdPre() . "</div>";
                                                    echo "</div>";
                                                    echo "<br>";

                                                    // Fecha Inicio - Fecha Devolución
                                                    echo "<div class='text-xs font-weight-bold text-warning text-uppercase mb-1'>Fechas</div>";
                                                    echo "<div class='row'>"; // Añade un margen top para separar las secciones
                                                    
                                                    echo "<div class='col'>";
                                                    echo "<div class='h6 mb-0 font-weight-bold text-gray-800'>Inicio: " . $prestamo->getFecPre() . "</div>";
                                                    echo "<div class='h6 mb-0 font-weight-bold text-gray-800'>Devolución: " . $prestamo->getFecDev() . "</div>";
                                                    echo "</div>";
                                                    echo "</div>";
                                                echo "</div>";
                                                $librodetalle = $control->getLibroDetalle($prestamo->getIdLib());

                                                // Título del Libro y Portada del Libro
                                                echo "<div class='col-xl-3'>";
                                                echo "<div class='text-xs font-weight-bold text-warning text-uppercase mb-1'>Libro</div>";
                                                echo "<div class='h6 mb-0 font-weight-bold text-gray-800'>" .  $librodetalle['titulo'] . "</div>";
                                                echo "<img src='galeria/" . $prestamo->getIdLib() . ".jpg' alt='Carátula del libro' class='img-fluid mt-2' >";
                                                echo "</div>";

                                                echo "</div>"; // Cierra row no-gutters align-items-center
                                                echo "</div>"; // Cierra card-body
                                                echo "</div>"; // Cierra card border-left-warning shadow h-100 py-2
                                                echo "</div>"; // Cierra col-xl-3 col-md-6 mb-4
                                            }
                                        }
                                        echo "</div>";
                                    ?>
                                    
                                    <!-- Aquí se insertarán las tarjetas de los productos -->
                                </div>
                            </div>
                        </div>

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

    <script>
        var getUrl = window.location;
        var base_url = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    </script>

    <!-- Filtro-->
    <script>
        $(document).ready(function(){
            function filtrarDatos() {
                var categoria = $('#Categorias').val();
                var buscar = $('#Search').val();
                var autor = $('#Autores').val(); // Obtener el valor seleccionado del select #Autores
                $.ajax({
                    url: 'filtrar_libros.php',
                    type: 'POST',
                    data: {
                        categoria: categoria,
                        buscar: buscar,
                        autor: autor // Incluir el autor seleccionado en los datos enviados por AJAX
                    },
                    success: function(data){
                        $('#Libros').html(data);
                    }
                });
            }

            $('#Categorias').change(filtrarDatos);
            $('#Search').keyup(filtrarDatos);
            $('#Autores').change(filtrarDatos); // Cambiar evento a 'change' para el select #Autores
        });
    </script>

    <script src="js/modal.js"></script>


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

    <style>
        .prestamo {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .badge-pill {
            padding: 10px;
            font-size: 14px;
        }
        .img-fluid {
            max-width: 100px; /* Ajusta según sea necesario */
            height: 150px;
        }
    </style>

</body>

</html>