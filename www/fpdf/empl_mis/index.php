<?php 
    session_start();
    if(isset($_SESSION['usuario'])){
        header("Location: menu.php");
    }
?>
<!DOCTYPE html>
<html class="login-bg" lang="es">
<head>
    <title>Intranet Foundation - Iniciar Sesión</title>
    <meta http-equiv="Content-Type" content="text/html; charset=uft-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />    
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/compiled/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/compiled/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/compiled/icons.css" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="css/lib/font-awesome.css" />
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/signup.css" type="text/css" media="screen" />

    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=OpenSans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />
</head>
<body>
    <div class="header">
        <a href="index.php"> 
            <img src="/imagenes/logohor.png" class="logo" alt="logo" width="20%" />
        </a>
    </div>
    <br>
    <div class="login-wrapper">
        <form id="miFormulario" action="login.php" method="POST">
            <div class="box">
                <div class="content-wrap">
                    <h6>Iniciar Sesión</h6>
                    <input name="usuario" id="usuario" class="form-control" type="text" placeholder="Usuario" required autofocus>
                    <input name="contra" id="contra" class="form-control" type="password" placeholder="Contraseña" required>                
                    <div class="action">
                        <button class="btn-flat" id="submit">Iniciar Sesión</button>
                    </div>                
                </div>
                <div id="msg">                            
                </div>
            </div>
        </form>
    </div>

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>
