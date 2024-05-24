<?php 
include('header.php');
include('config.php');
include('../conexion.php')
?>
<?php 
mysqli_select_db($conexion,"productosbd");
                          $suma= "SELECT SUM(precio) FROM carrito";
                          $sumatotal= mysqli_query($conexion, $suma);                                       
                          while($registro=mysqli_fetch_row($sumatotal)){
?>
<?php include('contenedor.php');?>
<div class="container">
	<h2>Carrito</h2>	
	<br>
	<table class="table">
	    <tr>
          <td style="width:150px"><img src="cestacompra.png" style="width:50px" />Total productos:</td>
          <td style="width:150px">€<?php echo $registro[0]; ?></td>
          <td style="width:150px">
          <?php include 'paypalCheckout.php'; ?>
          </td>
        </tr>
        
    </table>
	<div style="margin:50px 0px 0px 0px;">
		<a class="btn btn-default read-more" style="background:#3399ff;color:white" href="../productos/carrito.php">Volver a la cesta</a>		
	</div>
    
</div>
<?php
 }
?>

<?php 
include('footer.php');
?>
