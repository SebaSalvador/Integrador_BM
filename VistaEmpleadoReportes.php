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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.2/css/all.css" crossorigin="anonymous">

    <!-- Incluir los scripts JavaScript -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- DataTables CSS for Bulma -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bulma.css">

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bulma.js"></script>

    <!-- PDFMake and DataTables for exporting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.js"></script>

    <!-- Incluir los scripts y estilos de DataTables Editor -->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-2.0.7/b-3.0.2/sl-2.0.2/datatables.min.css">
    <link rel="stylesheet" href="js/Editor-2.3.2/css/editor.dataTables.css">

    <script src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-2.0.7/b-3.0.2/sl-2.0.2/datatables.min.js"></script>
    <script src="js/Editor-2.3.2/js/dataTables.editor.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">



    <style>
        .button-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f8f9fc;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-decoration: none;
            color: black;
            transition: box-shadow 0.3s ease-in-out;
        }

        .button-card:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .button-text {
            font-size: 16px;
            font-weight: bold;
        }

        .button-subtext {
            font-size: 14px;
            color: #6c757d;
        }

        .button-icon {
            font-size: 36px;
            color: #d1d3e2;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="VistaEmpleadoMain.php">
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
                <a class="nav-link" href="VistaEmpleadoMain.php">
                    <i class="fa-solid fa-book-open"></i>
                    <span>Libros</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="VistaEmpleadoPrestamos.php">
                    <i class="fa-solid fa-bookmark"></i>
                    <span>Prestamos</span></a>
            </li>
            
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="VistaEmpleadoConLib.html">
                    <i class="fa-solid fa-table"></i>
                    <span>Control de Libros</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="VistaEmpleadoPenalizacion.php">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>Penalizaciones</span></a>
            </li>
            
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="VistaEmpleadoReportes.php">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Reportes</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                About us
            </div>

            
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fa-brands fa-facebook"></i>
                    <span>Facebook</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fa-brands fa-instagram"></i>
                    <span>Instagram</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
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
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
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
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
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
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
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
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
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
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
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


                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Categorias</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="#Prestamos" class="button-card">
                                <div>
                                    <div class="button-text">PRESTAMOS TOTALES</div>
                                    <div class="button-subtext"></div>
                                </div>
                                <div class="button-icon">
                                    &#128218;
                                </div>
                            </a>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="#Clientes" class="button-card">
                                <div>
                                    <div class="button-text">CLIENTES</div>
                                    <div class="button-subtext"></div>
                                </div>
                                <div class="button-icon">
                                    &#128100;
                                </div>
                            </a>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="#Empleados" class="button-card">
                                <div>
                                    <div class="button-text">EMPLEADOS</div>
                                    <div class="button-subtext"></div>
                                </div>
                                <div class="button-icon">
                                    &#128101;
                                </div>
                            </a>
                        </div>


                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="#Sanciones" class="button-card">
                                <div>
                                    <div class="button-text">SANCIONES</div>
                                    <div class="button-subtext"></div>
                                </div>
                                <div class="button-icon">
                                    ⚖
                                </div>
                            </a>
                        </div>

                        <!-- Pending Requests Card Example -->                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="#Observaciones" class="button-card">
                                <div>
                                    <div class="button-text">OBSERVACIONES</div>
                                    <div class="button-subtext"></div>
                                </div>
                                <div class="button-icon">
                                    🔍
                                </div>
                            </a>
                    </div>

                </div>

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <section id="Prestamos">
                        <h1 class="h3 mb-0 text-gray-800">Reportes de Prestamos</h1>

                    </section>
                </div>
                
                <div>
                    <select id="estado">
                        <option value="">Todos</option>
                        <option value="Finalizado">Finalizado</option>
                        <option value="En curso">En curso</option>
                        <option value="Pendiente de entrega">Pendiente de entrega</option>
                        <option value="Pendiente de devolución">Pendiente de devolución</option>
                    </select>
                </div>
                <!-- End of Content Wrapper -->
                <table id="Tabla_Reportes" class="table is-striped" style="width:100%">
                    <thead>
                        <th> ID PRESTAMO
                        <th> TÍTULO DE LIBRO
                        <th> NOMBRE DEL CLIENTE
                        <th> FECHA DE PRESTAMO
                        <th> FECHA DE DEVOLUCIÓN
                        <th> ESTADO
                    </thead>
                    <tbody></tbody>
                </table>

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <section id="Clientes">
                        <h1 class="h3 mb-0 text-gray-800">Reportes de Clientes</h1>

                    </section>
                </div>

                <table id="Tabla_Reportes_Cliente" class="table is-striped" style="width:100%">
                    <thead>
                        <th> DNI
                        <th> NOMBRE
                        <th> CORREO
                        <th> TELEFONO
                        <th> ESTADO
                    </thead>
                    <tbody></tbody>
                </table>

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <section id="Empleados">
                        <h1 class="h3 mb-0 text-gray-800">Reportes de Empleados</h1>

                    </section>
                </div>

                <table id="Tabla_Reportes_Empleado" class="table is-striped" style="width:100%">
                <thead>
                        <th> DNI
                        <th> NOMBRE
                        <th> CORREO
                        <th> TELEFONO
                        <th> ESTADO
                    </thead>
                    <tbody></tbody>
                </table>

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <section id="Sanciones">
                        <h1 class="h3 mb-0 text-gray-800">Reportes de Sanciones</h1>

                    </section>
                </div>

                <table id="Tabla_Reportes_Sanciones" class="table is-striped" style="width:100%">
                <thead>
                        <th> ID
                        <th> NOMBRE
                        <th> DIAS DE SANCION
                        <th> FECHA DE INICIO
                        <th> FECHA DE FIN
                        <th> MOTIVO
                        <th> ESTADO
                    </thead>
                    <tbody></tbody>
                </table>

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <section id="Observaciones">
                        <h1 class="h3 mb-0 text-gray-800">Reportes de Observaciones</h1>

                    </section>
                </div>

                <table id="Tabla_Reportes_Observaciones" class="table is-striped" style="width:100%">
                <thead>
                        <th> ID_Obs
                        <th> Titulo
                        <th> Descripcion
                        <th> Estado
                        <th> Fec_Obs
                        <th> Fec_Sol
                    </thead>
                    <tbody></tbody>
                </table>

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <section id="Observaciones">
                        <h1 class="h3 mb-0 text-gray-800">Reportes de Prestamos por Cliente</h1>

                    </section>
                </div>

                <table id="Tabla_Reportes_Cantidad" class="table is-striped" style="width:100%">
                <thead>
                        <th> ID
                        <th> Nombre
                        <th> CANTIDAD
                    </thead>
                    <tbody></tbody>
                </table>


            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- DataTables -->
            <script src="js/DataTablesFunctions.js"></script>

            <!-- Bootstrap core JavaScript-->

            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>



            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>