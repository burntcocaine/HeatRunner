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
        $sql = "SELECT * FROM usuario WHERE id = $id";
        $res = mysqli_query($conexion, $sql);
        if ($res) {
            $usuario = mysqli_fetch_assoc($res);
            $nombre = $usuario['usuario'];
            $contra = $usuario['contra'];
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
        }
    }
?>

<!DOCTYPE html>
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
            <img src="/imagenes/logotr.png" class="logo" alt="logo" width="65" height="65" />Panel del administrador > Administración de usuarios
            </a>
        </div>
        <ul class="nav navbar-nav pull-right hidden-xs">                       
            <li class="notification-dropdown hidden-xs hidden-sm">
                <a href="#" class="trigger">
                    <i class="icon-user"></i>
                </a>
                <div class="pop-dialog">                    
                </div>
            </li>
            <li class="dropdown open">
                <a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-toggle="dropdown">
                    Bienvenido<?php echo ": ".$_SESSION['usuario'] ?>
                </a>                
            </li>             
            <li class="settings hidden-xs hidden-sm">
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
                <div id="miPagina" class="col-md-5 column">

                    <form method="POST" action="registrarCliente.php">
    
                        <div class="field-box">
                            <label>Id:</label>
                            <div class="col-md-7">
                                <input name="id" id="id" class="form-control" required autofocus type="text" value="<?php echo $id; ?>">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Nombre:</label>
                            <div class="col-md-7">
                                <input name="nombre" id="nombre" class="form-control" required type="text" value="<?php echo $nombre; ?>">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Contraseña:</label>
                            <div class="col-md-7">
                                <input name="contra" id="contra" class="form-control" type="text">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Estado: (1 o 0)</label>
                            <div class="col-md-7">
                                <input name="estado" id="estado" class="form-control" required type="number" value="<?php echo $estado; ?>">
                            </div>                            
                        </div>
                        
                        <div class="field-box">
                            <label>Nombre Completo:</label>
                            <div class="col-md-7">
                                <input name="NombreCompleto" id="NombreCompleto" class="form-control" required type="text" value="<?php echo $NombreCompleto; ?>">
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>DNI:</label>
                            <div class="col-md-7">
                                <input name="dni" id="dni" class="form-control" required type="text" value="<?php echo $dni; ?>">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Correo Electrónico:</label>
                            <div class="col-md-7">
                                <input name="correo_electronico" id="correo_electronico" class="form-control" required type="email" value="<?php echo $correo_electronico; ?>">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Fecha Nacimiento:</label>
                            <div class="col-md-7">
                                <input name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required type="date" value="<?php echo $fecha_nacimiento; ?>">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>País:</label>
                            <div class="col-md-7">
                                <input name="pais" id="pais" class="form-control" required type="text" value="<?php echo $pais; ?>">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Género:</label>
                            <div class="col-md-7">
                                <input name="genero" id="genero" class="form-control" required type="text" value="<?php echo $genero; ?>">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Teléfono:</label>
                            <div class="col-md-7">
                                <input name="telefono" id="telefono" class="form-control" required type="text" value="<?php echo $telefono; ?>">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Rol:</label>
                            <div class="col-md-7">
                                <input name="rol" id="rol" class="form-control" required type="text" value="<?php echo $rol; ?>">
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Biografía:</label>
                            <div class="col-md-7">
                                <textarea name="biografia" id="biografia" class="form-control"><?php echo $biografia; ?></textarea>
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Avatar:</label>
                            <div class="col-md-7">
                                <input name="avatar" id="avatar" class="form-control" type="file">
                            </div>                            
                        </div>
                        <div class="action">
                            <input type="submit" class="btn-flat" value="Registrar">
                            <input type="button" onclick="listarClientes();" class="btn-flat" value="Mostrar">
                        </div> 
                        
                    </form>

                    <div id="mensaje" class="col-md-6">
                        
                    </div>

                </div>

                <!-- right column -->
                
            </div>
        </div>
                <div id="miTabla" class="col-md-7 column">
                    <div id="cargando"></div>
                </div>
    </div>
    <div id="miTabla" class="col-md-7 column ">
                    <div id="cargando">dfsgd</div>
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
    <script src="js/personal.js"></script>
    <script type="text/javascript">
        function listarClientes() {
            window.location.href = 'listarCliente.php';
        }
    </script>
</body>
</html>
