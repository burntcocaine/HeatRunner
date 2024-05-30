<?php
include_once('conexion.php');
?>
<! DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables Example</title>
    <!-- Incluye jQuery desde CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluye DataTables CSS desde CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- Incluye DataTables JS desde CDN -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div id='pad-wrapper' class='datatables-page' style='margin-top:0px; overflow: auto;'>
        <div class='row'>
            <div class='col-md-12'>
                <table id='example' class='table table-hover'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Estado</th>
                            <th>Nombre Completo</th>
                            <th>DNI</th>
                            <th>Correo Electrónico</th>
                            <th>Fecha Nacimiento</th>
                            <th>País</th>
                            <th>Género</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                            <th>Biografía</th>
                            <th>Avatar</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                       $sql = "SELECT * FROM usuario WHERE estado = 1;";
                       $res = mysqli_query($conexion, $sql);
                       while ($clientes = mysqli_fetch_array($res)) {
                           echo "<tr>";
                           echo "<td>".$clientes['id']."</td>";
                           echo "<td>".$clientes['usuario']."</td>";
                           echo "<td>".$clientes['estado']."</td>";
                           echo "<td>".$clientes['nombre_completo']."</td>";
                           echo "<td>".$clientes['dni']."</td>";
                           echo "<td>".$clientes['correo_electronico']."</td>";
                           echo "<td>".$clientes['fecha_nacimiento']."</td>";
                           echo "<td>".$clientes['pais']."</td>";
                           echo "<td>".$clientes['genero']."</td>";
                           echo "<td>".$clientes['telefono']."</td>";
                           echo "<td>".$clientes['rol']."</td>";
                           echo "<td>".$clientes['biografia']."</td>";
                       
                           // Mostrar el avatar como una imagen pequeña
                           if (!empty($clientes['avatar'])) {
                               $avatar = base64_encode($clientes['avatar']);
                               echo "<td><img src='data:image/jpeg;base64,$avatar' alt='avatar' style='width:50px;height:50px;'/></td>";
                           } else {
                               echo "<td>No Avatar</td>";
                           }
                       
                           echo "<td class='center'>
                                   <a onclick='llenarCamposEditarCliente(".$clientes['id'].");' data-toggle='modal' data-target='#myModal-Edit' style='cursor:pointer;'><i class='icon-edit'></i></a>
                                   <a onclick='eliminarCliente(".$clientes['id'].");' data-toggle='modal' data-target='#myModal-Delete' style='cursor:pointer;'><i class='icon-remove'></i></a>
                               </td>";
                           echo "</tr>";
                       }
                       ?>
                        

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type='text/javascript'>
        $(document).ready(function() {
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
        });	
        
        function llenarCamposEditarCliente(id) {
    $.ajax({
        url: 'llenarCamposEditarCliente.php',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            console.log(response); // Añadir aquí para ver la respuesta del servidor
            if (response.success) {
                var cliente = response.data;
                $('#id').val(cliente.id);
                $('#is_edit').val(1); // Indicar que estamos en modo edición
                $('#nombre').val(cliente.usuario);
                $('#estado').val(cliente.estado);
                $('#NombreCompleto').val(cliente.nombre_completo);
                $('#dni').val(cliente.dni);
                $('#correo_electronico').val(cliente.correo_electronico);
                $('#fecha_nacimiento').val(cliente.fecha_nacimiento);
                $('#pais').val(cliente.pais);
                $('#genero').val(cliente.genero);
                $('#telefono').val(cliente.telefono);
                $('#rol').val(cliente.rol);
                $('#biografia').val(cliente.biografia);
                // Dejar el campo de la contraseña vacío
                $('#contra').val('');

                // Manejo del avatar
                if (cliente.avatar) {
                    $('#avatar').attr('src', 'data:image/jpeg;base64,' + cliente.avatar);
                } else {
                    $('#avatar').attr('src', ''); // O una imagen por defecto
                }
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert("Error al obtener los datos del cliente.");
        }
    });
}




function eliminarCliente(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
        $.ajax({
            url: 'eliminarCliente.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                alert("Usuario eliminado correctamente.");
                location.reload(); // Recargar la página para reflejar los cambios
            },
            error: function() {
                alert("Hubo un error al eliminar el usuario.");
            }
        });
    }
}




    </script>
</body>
</html>
