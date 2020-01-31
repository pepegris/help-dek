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
//var_dump($total1);
//var_dump($cantidad1);
//var_dump($precio1);
	$con=mysqli_connect("localhost","","","") or die("Problemas con la conexión");

	//Agregar Registro
	if (isset($_POST["agregar"])){
				$fecha 	= $_POST['fecha'];
				$rif1 	= $_POST['rif1'];
				$rif 	= $_POST['rif'];
				$tipopago= $_POST['tipopago'];

				//$msgCodigo			="";
				//$claseCodigo		="";
				//$msgNombre			="";
				//$claseNombre		="";
				//$msgCategoria		="";
				//$claseCategoria		="";
				//$msgDescripcion		="";
				//$claseDescripcion	="";
				//$msgCantidad		="";
				//$claseCantidad		="";
						
							//if($codigo==""){
							//	$msgCodigo		= 	"Falta el código del Producto";
							//	$claseCodigo 	= 	"error";
							//}

							
			
//			if ($_POST["codigo"]=="" OR $_POST["nombre"]=="" OR $_POST["categoria"]=="" OR $_POST["descripcion"]=="" OR $_POST["cantidad"]=="" OR $_POST["marca"]==""){
//				echo "<script>alert('Faltan Datos del Producto.....')</script>";
//			}else{
//				$validar = 1;
//			} 
		
//		if ($validar == 1){
//			$sql2="select * from productos where codigo='$_REQUEST[codigo]'";
//			$busqueda2=mysqli_query($con,$sql2);
//				if ($registro2=mysqli_fetch_array($busqueda2)){
//					echo "<script>alert('Datos del Producto Ya Existe')</script>";
//				}else{
//					mysqli_query($con,"insert into productos(codigo,nombre,categoria,descripcion,cantidad,precio1,precio2,precio3,fecha1,fecha2,fecha3,observaciones,marca) values ('$_REQUEST[codigo]','$_REQUEST[nombre]','$_REQUEST[categoria]','$_REQUEST[descripcion]','$_REQUEST[cantidad]','$_REQUEST[precio1]','$_REQUEST[precio2]','$_REQUEST[precio3]','$_REQUEST[fecha1]','$_REQUEST[fecha2]','$_REQUEST[fecha3]','$_REQUEST[observaciones]','$_REQUEST[marca]')") or die("Problemas en el select".mysqli_error($con));
//					mysqli_close($con);
//					echo "<script>alert('Datos del Producto fueron Agregados Correctamente')</script>";
//				}
//		}	
		
	}

	if (isset($_POST["buscar1"])){	
		if ($_POST["rif1"]=="" OR $_POST["rif"]==""){
			echo "<script>alert('Debe colocar el Rif del proveedor')</script>";
		} else{
			$sql="select * from proveedor where rif='$_REQUEST[rif]'";
			$busqueda=mysqli_query($con,$sql);
			if($registro=mysqli_fetch_array($busqueda)){
				$rif1 			= $registro['rif1'];
				$rif 			= $registro['rif'];
				$razon	 		= $registro['razon'];
				$direccion 		= $registro['direccion'];
				$cod1			= $registro['cod1'];
				$telf1			= $registro['telf1'];
				$cod2			= $registro['cod2'];
				$telf2			= $registro['telf2'];
				$cod3			= $registro['cod3'];
				$telf3			= $registro['telf3'];
				$personacontacto= $registro['personacontacto'];
				$email			= $registro['email'];
				
				$cantidad1 = $_POST['cantidad1'];
				$precio1 = $_POST['precio1'];
				$total1 = $cantidad1 * $precio1;
	
				$cantidad2 = $_POST['cantidad2'];
				$precio2 = $_POST['precio2'];
				$total2 = $cantidad2 * $precio2;
			
				$cantidad3 = $_POST['cantidad3'];
				$precio3 = $_POST['precio3'];
				$total3 = $cantidad3 * $precio3;
			
				$cantidad4 = $_POST['cantidad4'];
				$precio4 = $_POST['precio4'];
				$total4 = $cantidad4 * $precio4;
			
				$cantidad5 = $_POST['cantidad5'];
				$precio5 = $_POST['precio5'];
				$total5 = $cantidad5 * $precio5;
				
				$subtotalx 	= $total1+$total2+$total3+$total4+$total5;
				$subtotal	=	round($subtotalx,2);
				$ivax = $subtotal*  0.12;
				$iva	=	round($ivax,2);
				$totalx= $subtotal+$iva;
				$total = round($totalx,2);
				
				//$codigo1 = $_POST['codigo1'];
				$sql3="select * from productos where codigo='$_REQUEST[codigo1]'";
				$busqueda3=mysqli_query($con,$sql3);
				if($registro3=mysqli_fetch_array($busqueda3)){
					$codigo1 = $registro3['codigo'];
					$nombre1 = $registro3['nombre'];
				}
				$sql4="select * from productos where codigo='$_REQUEST[codigo2]'";
				$busqueda4=mysqli_query($con,$sql4);
				if($registro4=mysqli_fetch_array($busqueda4)){
					$codigo2 = $registro4['codigo'];
					$nombre2 = $registro4['nombre'];
				}
				$sql5="select * from productos where codigo='$_REQUEST[codigo3]'";
				$busqueda5=mysqli_query($con,$sql5);
				if($registro5=mysqli_fetch_array($busqueda5)){
					$codigo3 = $registro5['codigo'];
					$nombre3 = $registro5['nombre'];
				}
				$sql6="select * from productos where codigo='$_REQUEST[codigo4]'";
				$busqueda6=mysqli_query($con,$sql6);
				if($registro6=mysqli_fetch_array($busqueda6)){
					$codigo4 = $registro6['codigo'];
					$nombre4 = $registro6['nombre'];
				}
				$sql7="select * from productos where codigo='$_REQUEST[codigo5]'";
				$busqueda7=mysqli_query($con,$sql7);
				if($registro3=mysqli_fetch_array($busqueda3)){
					$codigo5 = $registro7['codigo'];
					$nombre5 = $registro7['nombre'];
				}
				
				
				
				
				
				
				///
			}	else{
					echo "<script>alert('NO Está Registrado el Proveedor')</script>";
			}
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
			
			<li><a href="#">Administrativo</a>

			<div>
				<ul>
					<li class="titulo azul"><a href="">Procesos Administrativos</a></li>
					<li><a href="">Compras</a></li>
					<li><a href="">Ventas</a></li>
					<li><a href="">Alquiler</a></li>
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

<center><h3> Registro de Compras </h3> </center>
<hr>
<form method="POST" name="frm1" action="" >
			
			<table border="2" align="center" width="80%">
				<caption>Información de Proveedores </caption>
				<tr><td>&nbsp&nbsp Rif: &nbsp&nbsp <input type="text" name="rif1" size="1" value="<?php echo $rif1; ?>"  />  <input type="text" name="rif" value="<?php echo $rif; ?>"  /> </td>
				<td>&nbsp&nbsp Razón Social: &nbsp&nbsp <input type="text" name="razon" size="70" value="<?php echo $razon; ?>" readonly="readonly"  /> </td></tr> 
				<tr><td colspan=2>&nbsp&nbsp Direccion: &nbsp&nbsp <input type="text" name="direccion" size="120" value="<?php echo $direccion; ?>" readonly="readonly" /></center> </td></tr>
				<tr><td colspan=2>
					&nbsp&nbsp Teléfonos: &nbsp&nbsp (<input type="text" name="cod1"  style="width : 45px; heigth : 45px" value="<?php echo $cod1; ?>" readonly="readonly" />) - &nbsp (<input type="text" name="telf1" size="4" value="<?php echo $telf1; ?>" readonly="readonly" />)
					&nbsp&nbsp&nbsp&nbsp (<input type="text" name="cod2"  style="width : 45px; heigth : 45px" value="<?php echo $cod2; ?>" readonly="readonly" />) - &nbsp (<input type="text" name="telf2" size="4" value="<?php echo $telf2; ?>" readonly="readonly" />)
					&nbsp&nbsp&nbsp&nbsp (<input type="text" name="cod3"  style="width : 45px; heigth : 45px" value="<?php echo $cod3; ?>" readonly="readonly" />) - &nbsp (<input type="text" name="telf3" size="4" value="<?php echo $telf3; ?>" readonly="readonly" />)
				</td></tr>
				<tr><td colspan=2>&nbsp&nbsp Persona de Contacto: &nbsp&nbsp <input type="text" name="personacontacto"  size="70" value="<?php echo $personacontacto; ?>" readonly="readonly" /> </td></tr>
				<tr><td colspan=2>&nbsp&nbsp Correo Electrónico: &nbsp&nbsp <input type="text" name="email"  size="70" value="<?php echo $email; ?>" readonly="readonly" /> </td></tr>
				<tr><td colspan=2></td></tr>
				<tr><td colspan=2><center><input type="submit" name="buscar1" value="Buscar"/></center></tr>	
			</table>
		
<!--</form>



<form method="POST" name="frm2" action="" > -->
		<?php $con2=mysqli_connect("localhost","root","","sistema") or die("Problemas con la conexión");?>
			
			<table border="2" align="center" width="60%">
			<caption>Información de la Compra </caption>
			<tr><td align="center">Código - Descripcion </td><td align="center">Cantidad</td><td align="center">Precio Unitario</td><td align="center">Total Bs.</td></tr>
			<!-- Uno -->
			<tr>
			<td align="center">
				<input type="text" name="codigo1" size="10"  value="<?php echo $codigo1; ?>" />
				<input type="text" name="nombre1"  size="50" value="<?php echo $nombre1; ?>" readonly="readonly" />
			</td>
			<td align="center">
				<input type="number" name="cantidad1" size="10"  value="<?php echo $cantidad1; ?>"  />
			</td>
			<td align="center">
				<input type="number" name="precio1" step="0.01" size="10"  value="<?php echo $english_format_number = number_format($precio1, 2, '.', ''); ?>" autofocus />
			</td>
			<td align="center">
				<input type="number" name="total1" size="10" step="0.01" value="<?php echo $english_format_number = number_format($total1, 2, '.', '');?>" readonly="readonly" />
			</td>
			</tr>
			
			<!-- Dos -->
			<tr>
			<td align="center">
				<input type="text" name="codigo2" size="10"  value="<?php echo $codigo2; ?>"  />
				<input type="text" name="nombre2"  size="50" value="<?php echo $nombre2; ?>" readonly="readonly" />
			</td>
			<td align="center">
				<input type="number" name="cantidad2" size="10" value="<?php echo $cantidad2; ?>"  />
			</td>
			<td align="center">
				<input type="number" name="precio2" size="10" step="0.01" value="<?php echo $precio2; ?>"  />
			</td>
			<td align="center">
				<input type="number" name="total2" step="0.01" size="10" value="<?php echo $total2; ?>" readonly="readonly" />
			</td>
			</tr>

			<!-- Tres -->
			<tr>
			<td align="center">
				<input type="text" name="codigo3" size="10"  value="<?php echo $codigo3; ?>"  />
				<input type="text" name="nombre3"  size="50" value="<?php echo $nombre3; ?>" readonly="readonly" />
			</td>
			<td align="center">
				<input type="number" name="cantidad3" size="10" value="<?php echo $cantidad3; ?>"  />
			</td>
			<td align="center">
				<input type="number" name="precio3" size="10" value="<?php echo $precio3; ?>"  />
			</td>
			<td align="center">
				<input type="number" name="total3" size="10" value="<?php echo $total3; ?>" readonly="readonly" />
			</td>
			</tr>

			<!-- Cuatro -->
			<tr>
			<td align="center">
				<input type="text" name="codigo4" size="10"  value="<?php echo $codigo4; ?>"  />
				<input type="text" name="nombre4"  size="50" value="<?php echo $nombre4; ?>" readonly="readonly" />
			</td>
			<td align="center">
				<input type="number" name="cantidad4" size="10" value="<?php echo $cantidad4; ?>"  />
			</td>
			<td align="center">
				<input type="number" name="precio4" size="10" value="<?php echo $precio4; ?>"  />
			</td>
			<td align="center">
				<input type="number" name="total4" size="10" value="<?php echo $total4; ?>" readonly="readonly" />
			</td>
			</tr>

			<!-- Cinco -->
			<tr>
			<td align="center">
				<input type="text" name="codigo5" size="10"  value="<?php echo $codigo5; ?>"  />
				<input type="text" name="nombre5"  size="50" value="<?php echo $nombre5; ?>" readonly="readonly" />
			</td>
			<td align="center">
				<input type="number" name="cantidad5" size="10" value="<?php echo $cantidad5; ?>"  />
			</td>
			<td align="center">
				<input type="number" name="precio5" size="10" value="<?php echo $precio5; ?>"  />
			</td>
			<td align="center">
				<input type="number" name="total5" size="10" value="<?php echo $total5; ?>" readonly="readonly" />
			</td>
			</tr>

			<tr>
				<td></td><td></td>
				<td align="right"><b>Subtotal:</b></td>
				<td><input type="number" name="subtotal" size="10" step="0.01" value="<?php echo $english_format_number = number_format($subtotal, 2, '.', ''); ?>" readonly="readonly" /></td>
			</tr>

			<tr>
				<td></td><td></td>
				<td align="right"><b>IVA:</b></td>
				
				<td><input type="number" name="iva" size="10" step="0.01" value="<?php echo $iva; ?>" readonly="readonly" /></td>
			</tr>

			<tr>
				<td></td><td></td>
				<td align="right"><b>Total:</b></td>
				<td><input type="number" name="total" step="0.01" size="10" value="<?php echo $total; ?>" readonly="readonly" /></td>
			</tr>
			<tr>
			<td colspan="4" align="center"><input type="submit" name="buscar1" value="Procesar"/> </td>
			</tr>	
			</table>
</form>

<br><br><br><br><br><br><br><br>

<footer>
<div class='define'>
@Copyright 2018. Todos los derechos reservados
</div>
</footer>


</body>
</html>