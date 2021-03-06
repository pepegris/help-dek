<?php

//Inicializar una sesion de PHP
session_start();
 
//Validar que el usuario este logueado y exista un UID
if ( ! ($_SESSION['autenticado'] == 'SI' && isset($_SESSION['uid'])) )
{
    //En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la
    //pantalla de login, enviando un codigo de error
?>
        <form name="formulario" method="post" action="index.php">
            <input type="hidden" name="msg_error" value="2">
        </form>
        <script type="text/javascript">
            document.formulario.submit();
        </script>
<?php
}
 
    //Conectar BD
    include("conectar_bd.php"); 
    conectar_bd();
 
    //Sacar datos del usuario que ha iniciado sesion
    $sql = "SELECT  tx_nombre,tx_apellidoPaterno,tx_TipoUsuario,id_usuario
            FROM tbl_users
            LEFT JOIN ctg_tiposusuario
            ON tbl_users.id_TipoUsuario = ctg_tiposusuario.id_TipoUsuario
            WHERE id_usuario = '".$_SESSION['uid']."'";        
    $result     =mysql_query($sql);
 
    $nombreUsuario = "";
 
    //Formar el nombre completo del usuario
    if( $fila = mysql_fetch_array($result) )
        $nombreUsuario = $fila['tx_nombre']." ".$fila['tx_apellidoPaterno'];
     
//Cerrrar conexion a la BD
mysql_close($conexio);

//Botones
error_reporting(0);
	$con=mysqli_connect("localhost","","","") or die("Problemas con la conexión");
	$registros=mysqli_query($con,"select * from productos order by codigo ") or die("Problemas en el select:".mysqli_error($con));
	mysqli_close($con);
	$contador= 0;

?>


<html>
<head>
    <title>Sistema Servitems</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<!--Importar hojas de estilo -->	
		<link href="css/estilos.css" rel="stylesheet" type="text/css">
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="icon" type="image/png" href="logo2.png" />
</head>
<body topmargin="0" >
<table align="right" width="350px" border="0">
<tr>                                              <!-- Dar Bienvenida al usuario -->
    <td  width="100px" align="right">Bienvenido <b><?php echo $nombreUsuario ?></b></td>
    <td  width="15px" align="center">
        <!-- Proporcionar Link para cerrar sesion -->
        <a href="cerrarSesion.php">Cerrar sesi&oacute;n</a>
    </td>
</tr>
</table>
<br><br>
<IMG SRC="logo.png">
<br />
 
        <!-- Contenido inicial del sitio web -->

<nav>
		<ul>
			<li><a href="principal.php">Inicio</a></li>
			<li><a href="#">Registro</a>
			
			<div>
				<ul>
					<li class="titulo azul"><a href="">Proveedores</a></li>
					<li><a href="proveedor.php">Proveedores</a></li>
					<li><a href="proveedor2.php">Lista de Proveedores</a></li>
				</ul>
				
				<ul>
					<li class="titulo verde"><a href="">Clientes </a></li>
					<li><a href="cliente.php">Clientes</a></li>
					<li><a href="cliente2.php">Lista de Clientes</a></li>
				</ul>
				
				<ul>
					<li class="titulo rojo"><a href="">Productos</a></li>
					<li><a href="productos.php">Productos</a></li>
					<li><a href="productos2.php">Listas de Productos</a></li>
				</ul>
				
			</div>
			
			</li>
			
			<li><a href="#">Productos</a>

			<div>
				<ul>
					<li class="titulo azul"><a href="">Compra</a></li>
					<li><a href="">Compras</a></li>
					<li><a href="">Factura de Compras</a></li>
				</ul>
				
				<ul>
					<li class="titulo verde"><a href="">Venta </a></li>
					<li><a href="">Ventas</a></li>
					<li><a href="">Factura de la Venta</a></li>
				</ul>
				
				<ul>
					<li class="titulo rojo"><a href="">Alquiler</a></li>
					<li><a href="">Alquiler</a></li>
					<li><a href="">Lista de Alquiler</a></li>
				</ul>

			</div>				
			</li>
			
			<li><a href="#">Estadísticas</a>
<div>
				<ul>
					<li class="titulo azul"><a href="">Compra</a></li>
					<li><a href="">Estadísticas de Compras</a></li>
				</ul>
				
				<ul>
					<li class="titulo verde"><a href="">Venta </a></li>
					<li><a href="">Estadísticas de Ventas</a></li>
				</ul>
				
				<ul>
					<li class="titulo rojo"><a href="">Alquiler</a></li>
					<li><a href="">Estadísticas de Alquiler</a></li>
				</ul>

			</div>				
			</li>			
			
			
			
			
			</li>
			
			
</nav>	

<table align="center">
<tr><td> <a href="reporte2/reporte_pdf.php"><img src="images/pdf.png" width=80></a></td><td><a href="reporte2/reporte_word.php"><img src="images/word.png" width=80></a></td><td><a href="reporte2/reporte_excel.php"> <img src="images/excel.png" width=80></a></td></tr>

</table>


<br>
<center><h1> Listado de Productos </h1> </center>
<hr>
	<br/><br/>

	<table width="90%" border="1px" align="center">

    <tr align="center">
        
        <td>Códigos</td>
        <td>Nombre</td>
        <td>Marca</td>
        <td>Categoria</td>
        <td>Descripción</td>
        <td>Cantidad</td>
        <td>Precio No.1</td>

	</tr>
    <?php 
		
        while($datos=$registros->fetch_array()){
				///$contador += 1; 
        ?>
            <tr align="center">
					
                <td><?php echo $datos["codigo"];?></td>
                <td><?php echo $datos["nombre"];?></td>
                <td><?php echo $datos["marca"];?></td>
                <td><?php echo $datos["categoria"];?></td>
                <td><?php echo $datos["descripcion"];?></td>
                <td><?php echo $datos["cantidad"];?></td>
                <td><?php echo $datos["precio1"];?></td>
			</tr>
            <?php   
        }

     ?>
    </table>



		<br/><br/><br/><br/>
	<hr>
</form>
<br><br><br>

<footer>
<div class='define'>
@Copyright 2017. Todos los derechos reservados
</div>
</footer>


</body>
</html>