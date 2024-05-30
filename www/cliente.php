<?php  
    session_start();
    $usuario = $_SESSION['usuario'];
    if(!isset($usuario)){
        header("Location: index.php");
        exit;
    }

    include_once('conexion.php');

    // Inicializar variables
    $id = '';
    $nombre = '';
    $contra = '';
    $estado = '';
    $NombreCompleto = '';
    $dni = '';
    $correo_electronico = '';
    $fecha_nacimiento = '';
    $pais = '';
    $genero = '';
    $telefono = '';
    $rol = '';
    $biografia = '';
    $avatar = '';

    // Verificar si se está editando un usuario
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "SELECT * FROM usuario WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res) {
            $usuario = $res->fetch_assoc();
            $nombre = $usuario['usuario'];
            $estado = $usuario['estado'];
            $NombreCompleto = $usuario['nombre_completo'];
            $dni = $usuario['dni'];
            $correo_electronico = $usuario['correo_electronico'];
            $fecha_nacimiento = $usuario['fecha_nacimiento'];
            $pais = $usuario['pais'];
            $genero = $usuario['genero'];
            $telefono = $usuario['telefono'];
            $rol = $usuario['rol'];
            $biografia = $usuario['biografia'];
            $avatar = $usuario['avatar'];
            // Asegúrate de que el campo de la contraseña esté vacío
            $contra = '';
        }
    }
    
?>

<! DOCTYPE html>
<html lang="es">
<head>
    <title>Administracion Clientes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=uft-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/uniform.default.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/select2.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/bootstrap.datepicker.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/compiled/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/compiled/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/compiled/icons.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/index.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/compiled/form-showcase.css" type="text/css" media="screen" />

    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=OpenSans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!-- lato font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <!-- navbar -->
    <header class="navbar navbar-inverse" role="banner">
        <div class="navbar-header">            
            <a class="navbar-brand" href="principal.php">
            <img src="../imagenes/heatrunner.jpg" class="logo" alt="logo" width="65" height="65" />Panel del administrador > Administración de usuarios
            </a>
        </div>
        <ul class="nav navbar-nav pull-right ">                       
            <li class="notification-dropdown  ">
                <a href="#" class="trigger">
                <?php
                    if (isset($_SESSION['avatar'])) {
                        echo '<img src="data:image/jpeg;base64,' . $_SESSION['avatar'] . '" alt="User Avatar" width="30" height="30"/>';
                    } else {
                        echo '<i class="icon-user"></i>';
                    }
                    ?>
                </a>
                <div class="pop-dialog">                    
                </div>
            </li>
            <li class="dropdown open">
                <a href="#" class="dropdown-toggle  " data-toggle="dropdown">
                    Bienvenido<?php echo ": ".$_SESSION['usuario'] ?>
                </a>                
            </li>             
            <li class="settings  ">
                <a href="cerrarSesion.php" role="button">
                    <i class="icon-share-alt"></i>
                </a>
            </li>
        </ul>
    </header>
    <!-- end navbar -->

    <!-- sidebar -->
    <div id="sidebar-nav">
        <ul id="dashboard-menu">
            <li class="active">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <a href="principal.php">
                    <i class="icon-home"></i>
                    <span>Home</span>
                </a>
            </li>            
            
            
            <li><a href="cliente.php" >Administración de usuarios</a></li> 
                

        </ul>
    </div>
    <!-- end sidebar -->

    <!-- main container -->
    <div class="content">

        <!-- end upper main stats -->

        <div id="pad-wrapper" class="form-page">

            <!-- statistics chart built with jQuery Flot -->
            <div class="row form-wrapper">
                <!-- left column -->
                <div id="miPagina" class="col-md-12">
                    
                
                <form method="POST" action="registrarCliente.php" enctype="multipart/form-data" class="container" style="padding:5px">
                    <input type="hidden" name="is_edit" id="is_edit" value="1">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre">Nombre:</label>
                            <input name="nombre" id="nombre" class="form-control" required type="text">
                        </div>
                        <div class="col-md-6">
                            <label for="contra">Contraseña:</label>
                            <input name="contra" id="contra" class="form-control" type="password" placeholder="Dejar en blanco para mantener la contraseña actual">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="estado">Estado: (1 o 0)</label>
                            <input name="estado" id="estado" class="form-control" required type="number" min="0" max="1">
                        </div>
                        <div class="col-md-6">
                            <label for="NombreCompleto">Nombre Completo:</label>
                            <input name="NombreCompleto" id="NombreCompleto" class="form-control" required type="text">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="dni">DNI:</label>
                            <input name="dni" id="dni" class="form-control" required type="text">
                        </div>
                        <div class="col-md-6">
                            <label for="correo_electronico">Correo Electrónico:</label>
                            <input name="correo_electronico" id="correo_electronico" class="form-control" required type="email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fecha_nacimiento">Fecha Nacimiento:</label>
                            <input name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required type="date">
                        </div>
                        <div class="col-md-6">
                            <label for="pais">País:</label>
                            <input name="pais" id="pais" class="form-control" required type="text">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="genero">Género:</label>
                            <input name="genero" id="genero" class="form-control" required type="text">
                        </div>
                        <div class="col-md-6">
                            <label for="telefono">Teléfono:</label>
                            <input name="telefono" id="telefono" class="form-control" required type="text">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rol">Rol:</label>
                            <input name="rol" id="rol" class="form-control" required type="text">
                        </div>
                        <div class="col-md-6">
                            <label for="biografia">Biografía:</label>
                            <textarea name="biografia" id="biografia" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="avatar">Avatar:</label>
                            <input name="avatar" id="avatar" class="form-control" type="file">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary" value="Registrar">
                            <input type="button" onclick="listarClientes();" class="btn btn-secondary" value="Mostrar">
                        </div>
                    </div>
                </form>




                <div id="mensaje" class="col-md-6">
                        
                    </div>

        </div>

                <!-- right column -->
                
            </div>
        </div>
                <div id="miTabla" class="col-md-12">
                    <div id="cargando"></div>
                </div>
    </div>
    
    <!-- scripts -->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="js/wysihtml5-0.3.0.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.datepicker.js"></script>
    <script src="js/jquery.uniform.min.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>  
    <script src="js/theme.js"></script>
    <script src="js/jquery.dataTables.js"></script>
   <!-- <script src="js/personal.js"></script>  -->
    <script type="text/javascript">
   function listarClientes() {
    $.ajax({
        url: 'listarCliente.php',
        type: 'GET',
        success: function(data) {
            $('#miTabla').html(data);
            if ($.fn.DataTable.isDataTable('#example')) {
                $('#example').DataTable().destroy();
            }
            $('#example').DataTable({
                'pagingType': 'full_numbers',
                'language': {
                    'processing': 'Cargando...',
                    'lengthMenu': 'Mostrar _MENU_ registros',
                    'zeroRecords': 'No se encontraron resultados',
                    'emptyTable': 'Ningún dato disponible en esta tabla',
                    'info': 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                    'infoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
                    'infoFiltered': '(filtrado de un total de _MAX_ registros)',
                    'search': 'Buscar:',
                    'paginate': {
                        'first': 'Primero',
                        'last': 'Último',
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    },
                    'aria': {
                        'sortAscending': ': Activar para ordenar la columna de manera ascendente',
                        'sortDescending': ': Activar para ordenar la columna de manera descendente'
                    }
                },
                'order': [[ 0, 'desc' ]],
                'pageLength': 5,
                'lengthMenu': [[5, 10, 20, -1], [5, 10, 20, 'All']]
            });
        }
    });
}


    </script>
</body>
</html>
