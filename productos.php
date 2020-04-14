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
$validar = 0;
error_reporting(0);
//var_dump($_POST);
//var_dump($sqlproductos);

	$con=mysqli_connect("localhost","","","") or die("Problemas con la conexión");

	//Agregar Registro
	if (isset($_POST["agregar"])){
				$codigo 	= $_POST['codigo'];
				$nombre 	= $_POST['nombre'];
				$categoria 	= $_POST['categoria'];
				$descripcion= $_POST['descripcion'];
				$cantidad 	= $_POST['cantidad'];
				$precio1 	= $_POST['precio1'];
				$precio2 	= $_POST['precio2'];
				$precio3 	= $_POST['precio3'];
				$fecha1 	= $_POST['fecha1'];
				$fecha2 	= $_POST['fecha2'];
				$fecha3 	= $_POST['fecha3'];
				$observaciones = $_POST['observaciones'];
				$marca		=	$_POST['marca'];

				$msgCodigo			="";
				$claseCodigo		="";
				$msgNombre			="";
				$claseNombre		="";
				$msgCategoria		="";
				$claseCategoria		="";
				$msgDescripcion		="";
				$claseDescripcion	="";
				$msgCantidad		="";
				$claseCantidad		="";
						
							if($codigo==""){
								$msgCodigo		= 	"Falta el código del Producto";
								$claseCodigo 	= 	"error";
							}

							if($nombre==""){
								$msgNombre		= 	"Falta Nombre del Producto";
								$claseNombre 	= 	"error";
							}

							if($marca=="" OR $categoria==""){
								$msgMarca	= 	"Falta Marca o Categoria del Producto";
								$claseMarca = 	"error";
							}

//							if($categoria=="" ){
//								$msgCategoria	= 	"Falta la Categoria";
//								$claseCategoria = 	"error";
//							}
							
							if($descripcion==""){
								$msgDescripcion		= 	"Falta la Descripción del Producto";
								$claseDescripcion 	= 	"error";
							}

							if($cantidad==""){
								$msgCantidad	= 	"Falta la Cantidad";
								$claseCantidad 	= 	"error";
							}

							
			
			if ($_POST["codigo"]=="" OR $_POST["nombre"]=="" OR $_POST["categoria"]=="" OR $_POST["descripcion"]=="" OR $_POST["cantidad"]=="" OR $_POST["marca"]==""){
				echo "<script>alert('Faltan Datos del Producto.....')</script>";
			}else{
				$validar = 1;
			} 
		
		if ($validar == 1){
			$sql2="select * from productos where codigo='$_REQUEST[codigo]'";
			$busqueda2=mysqli_query($con,$sql2);
				if ($registro2=mysqli_fetch_array($busqueda2)){
					echo "<script>alert('Datos del Producto Ya Existe')</script>";
				}else{
					mysqli_query($con,"insert into productos(codigo,nombre,categoria,descripcion,cantidad,precio1,precio2,precio3,fecha1,fecha2,fecha3,observaciones,marca) values ('$_REQUEST[codigo]','$_REQUEST[nombre]','$_REQUEST[categoria]','$_REQUEST[descripcion]','$_REQUEST[cantidad]','$_REQUEST[precio1]','$_REQUEST[precio2]','$_REQUEST[precio3]','$_REQUEST[fecha1]','$_REQUEST[fecha2]','$_REQUEST[fecha3]','$_REQUEST[observaciones]','$_REQUEST[marca]')") or die("Problemas en el select".mysqli_error($con));
					mysqli_close($con);
					echo "<script>alert('Datos del Producto fueron Agregados Correctamente')</script>";
				}
		}	
		
	}

	if (isset($_POST["buscar"])){	
		$sql="select * from productos where codigo='$_REQUEST[codigo]'";
		$busqueda=mysqli_query($con,$sql);
			if($registro=mysqli_fetch_array($busqueda)){
				$codigo 		= $registro['codigo'];
				$nombre 		= $registro['nombre'];
				$categoria 		= $registro['categoria'];
				$descripcion 	= $registro['descripcion'];
				$cantidad 		= $registro['cantidad'];
				$precio1 		= $registro['precio1'];
				$precio2 		= $registro['precio2'];
				$precio3 		= $registro['precio3'];
				$fecha1 		= $registro['fecha1'];
				$fecha2 		= $registro['fecha2'];
				$fecha3 		= $registro['fecha3'];
				$observaciones 	= $registro['observaciones'];
				$marca 			= $registro['marca'];
				

			}	else{
					echo "<script>alert('NO EXISTE el Producto Registrado')</script>";
				}

	}

	if (isset($_POST["modificar"]))
	{
			if ($_POST["codigo"]=="" OR $_POST["nombre"]=="" OR $_POST["categoria"]=="" OR $_POST["descripcion"]=="" OR $_POST["cantidad"]=="" OR $_POST["marca"]==""){
				echo "<script>alert('Para Poder Modificar debe primero Buscar el Producto.....')</script>";
			}else{
				$registros=mysqli_query($con,"update productos set codigo='$_REQUEST[codigo]',nombre='$_REQUEST[nombre]',categoria='$_REQUEST[categoria]',descripcion='$_REQUEST[descripcion]',cantidad='$_REQUEST[cantidad]',precio1='$_REQUEST[precio1]',precio2='$_REQUEST[precio2]',precio3='$_REQUEST[precio3]',fecha1='$_REQUEST[fecha1]',fecha2='$_REQUEST[fecha2]',fecha3='$_REQUEST[fecha3]',observaciones='$_REQUEST[observaciones]',marca='$_REQUEST[marca]' WHERE codigo='$_REQUEST[codigo]' ") or die("Problemas en el select:".mysqli_error($con));
				echo "<script>alert('Datos del Producto fueron Modificados Correctamente')</script>";
				mysqli_close($con);
			} 


		
	}

?>


<html>
<head>
    <title>Sistema Servitems</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<!--Importar hojas de estilo -->	
		<link href="css/estilos.css" rel="stylesheet" type="text/css">
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="icon" type="image/png" href="logo2.png" />
		
		
	<style>

		div label{
			padding: 10px;
			float: left;
			width: 20%
		}

		input {
			padding: 8px;
			border: solid 2px black;
		}

		textarea {
			padding: 10px;
			border: solid 2px black;
		}

		select {
			padding: 10px;
			border: solid 2px black;
		}

		.error{
			background: orange;
			boder: solid 4px red;
		}

		.msg{
			color: white;
			font-size: 16px;
		}
	</style>	
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

<center><h3> Registro de Productos </h3> </center>
<hr>
<form method="POST" name="frm" action="" >
		<div class="<?PHP echo $claseCodigo; ?>">
			&nbsp&nbsp Código: &nbsp&nbsp <input type="text" name="codigo" value="<?php echo $codigo; ?>" /> <br/><br/> 
			<span class="msg"><?PHP echo $msgCodigo;?></span>
		</div>
		
		<div class="<?PHP echo $claseNombre; ?>"> 	
			&nbsp&nbsp&nbspNombres: <input type="text" size= "60" name="nombre" value="<?php echo $nombre; ?>" /> <br/><br/> 
			<span class="msg"><?PHP echo $msgNombre;?></span>
		</div>
		
		<div class="<?PHP echo $claseMarca; ?>"> 	
			&nbsp&nbsp&nbspMarca:
			<SELECT name="marca" value="<?php echo $marca;?>">
				<OPTION value=""> <?php echo $marca;?>
				<OPTION value="CANON"> CANON 
				<OPTION value="XEROX"> XEROX
				<OPTION value="Hewlett-Packard"> Hewlett-Packard		
				<OPTION value="SAMSUNG"> SAMSUNG
			</SELECT>
			&nbsp&nbsp&nbspCategoria:
			<SELECT name="categoria" value="<?php echo $categoria;?>">
				<OPTION value=""> <?php echo $categoria;?>
				<OPTION value="Fotocopiadora de Escritorio"> Fotocopiadora de Escritorio
				<OPTION value="Fotocopiadora Medianas"> Fotocopiadora Medianas
				<OPTION value="Fotocopiadora de Alto Volumen"> Fotocopiadora de Alto Volumen				
				<OPTION value="Fotocopiadora de Color"> Fotocopiadora de Color
				<OPTION value="Fotocopiadora Remarketing"> Fotocopiadora Remarketing
				<OPTION value="Consumibles"> Consumibles
			</SELECT><br/><br/> 
			<!--<br/><br/> --> 
			<span class="msg"><?PHP echo $msgMarca;?></span>
		</div>
		

		<div class="<?PHP echo $claseDescripcion; ?>"> 	
			&nbsp&nbspDescripción:<textarea name="descripcion" rows="3" cols="80"><?php echo $descripcion;?></textarea><br/><br/>
			<span class="msg"><?PHP echo $msgDescripcion;?></span>
		</div>	
		
		<div class="<?PHP echo $claseCantidad; ?>">
			&nbsp&nbsp Cantidad: &nbsp&nbsp <input type="number" name="cantidad" value="<?php echo $cantidad; ?>" /> <br/><br/> 
			<span class="msg"><?PHP echo $msgCantidad;?></span>
		</div>
			<center>
			<table border="3" width="70%">
				<tr><td>Precio:</td><td><input type="number" name="precio1" value="<?php echo $precio1; ?>"</td><td>Fecha:</td><td><input type="date" name="fecha1" value="<?php echo $fecha1; ?>"</td></tr>
				<tr><td>Precio:</td><td><input type="number" name="precio2" value="<?php echo $precio2; ?>"</td><td>Fecha:</td><td><input type="date" name="fecha2" value="<?php echo $fecha2; ?>"</td></tr>
				<tr><td>Precio:</td><td><input type="number" name="precio3" value="<?php echo $precio3; ?>"</td><td>Fecha:</td><td><input type="date" name="fecha3" value="<?php echo $fecha3; ?>"</td></tr>
			</table>
			</center>
		 <br/><br/> 
		
		&nbsp&nbsp Observaciones:<br/><textarea name="observaciones" rows="3" cols="120"><?php echo $observaciones;?></textarea><br/><br/>
		
		<hr><center><input type="submit" name="agregar" value="Agregar" />
		<input type="submit" name="modificar" value="Modificar"/>
		<input type="submit" name="buscar" value="Buscar"/></center>

</form>
<br><br><br>

<footer>
<div class='define'>
@Copyright 2017. Todos los derechos reservados
</div>
</footer>


</body>
</html>