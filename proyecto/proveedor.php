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
	$con=mysqli_connect("localhost","yaja","1234","cardoza") or die("Problemas con la conexión");

	//Agregar Registro
	if (isset($_POST["agregar"])){
				$rif1 = $_POST['rif1'];
				$rif = $_POST['rif'];
				$razon = $_POST['razon'];
				$direccion = $_POST['direccion'];
				$cod1 = $_POST['cod1'];
				$telf1 = $_POST['telf1'];
				$cod2 = $_POST['cod2'];
				$telf2 = $_POST['telf2'];
				$cod3 = $_POST['cod3'];
				$telf3 = $_POST['telf3'];
				$personacontacto = $_POST['personacontacto'];
				$email = $_POST['email'];
				$observaciones = $_POST['observaciones'];

						$msgRif="";
						$claseRif="";
						$msgRazon="";
						$claseRazon="";
						$msgDireccion="";
						$claseDireccion="";
						$msgPersona="";
						$clasePersona="";
						$msgEmail="";
						$claseEmail="";
						$msgTelefonos="";
						$claseTelefonos="";
							
						
							if($rif1=="" OR $rif==""){
								$msgRif= "Falta el Rif del Proveedor";
								$claseRif = "error";
							}

							if($razon==""){
								$msgRazon= "Falta Razón Social del Proveedor";
								$claseRazon = "error";
							}

							if($direccion=="" ){
								$msgDireccion= "Falta la Dirección del Proveedor";
								$claseDireccion = "error";
							}
							
							if($cod1=="" OR $telf1==""){
								$msgTelefonos= "Falta Teléfonos";
								$claseTelefonos = "error";
							}

							if($personacontacto=="" ){
								$msgPersona= "Falta la Persona Contacto del Proveedor";
								$clasePersona = "error";
							}
							
							if($_POST){
						
								if (filter_var($email, FILTER_VALIDATE_EMAIL)){
				
								}else{				
									$msgEmail = "Correo no cumple con el formato";
									$claseEmail = "error";
									$email = "";
								}
							}	
							
		if ($_POST["rif1"]=="" OR $_POST["rif"]=="" OR $_POST["razon"]=="" OR $_POST["direccion"]=="" OR $_POST["cod1"]=="" OR $_POST["telf1"]=="" OR $_POST["personacontacto"]=="" OR $_POST["email"]==""){
				echo "<script>alert('Faltan Datos del Proveedor.....')</script>";
		}else{
			//echo "<script>alert('Datos.....')</script>";
			
			$validar = 1;
		} 
		
		if ($validar == 1){
			$sql2="select * from proveedor where rif='$_REQUEST[rif]'";
			$busqueda2=mysqli_query($con,$sql2);
				if ($registro2=mysqli_fetch_array($busqueda2)){
					echo "<script>alert('Datos del Cliente Ya Existe')</script>";
				}else{
					mysqli_query($con,"insert into proveedor(rif1,rif,razon,direccion,cod1,telf1,cod2,telf2,cod3,telf3,personacontacto,email,observaciones) values ('$_REQUEST[rif1]','$_REQUEST[rif]','$_REQUEST[razon]','$_REQUEST[direccion]','$_REQUEST[cod1]','$_REQUEST[telf1]','$_REQUEST[cod2]','$_REQUEST[telf2]','$_REQUEST[cod3]','$_REQUEST[telf3]','$_REQUEST[personacontacto]','$_REQUEST[email]','$_REQUEST[observaciones]')") or die("Problemas en el select".mysqli_error($con));
					mysqli_close($con);
					echo "<script>alert('Datos del Proveedor fueron Agregados Correctamente')</script>";

				}
		}	
		
	}
	
	
	
	if (isset($_POST["buscar"])){	
		$sql="select * from proveedor where rif='$_REQUEST[rif]' or razon='$_REQUEST[razon]'";
		$busqueda=mysqli_query($con,$sql);
			if($registro=mysqli_fetch_array($busqueda)){
				$rif1 = $registro['rif1'];
				$rif = $registro['rif'];
				$razon = $registro['razon'];
				$direccion = $registro['direccion'];
				$cod1 = $registro['cod1'];
				$telf1 = $registro['telf1'];
				$cod2 = $registro['cod2'];
				$telf2 = $registro['telf2'];
				$cod3 = $registro['cod3'];
				$telf3 = $registro['telf3'];
				$personacontacto = $registro['personacontacto'];
				$email = $registro['email'];
				$observaciones = $registro['observaciones'];

			}	else{
					echo "<script>alert('NO EXISTE el Provvedor Registrado')</script>";
				}
	}

	if (isset($_POST["modificar"]))
	{
		$registros=mysqli_query($con,"update proveedor set rif1='$_REQUEST[rif1]',razon='$_REQUEST[razon]',direccion='$_REQUEST[direccion]',cod1='$_REQUEST[cod1]',cod2='$_REQUEST[cod2]',cod3='$_REQUEST[cod3]',telf1='$_REQUEST[telf1]',telf2='$_REQUEST[telf2]',telf3='$_REQUEST[telf3]',personacontacto='$_REQUEST[personacontacto]',email='$_REQUEST[email]',observaciones='$_REQUEST[observaciones]' WHERE rif='$_REQUEST[rif]' ") or die("Problemas en el select:".mysqli_error($con));
		echo "<script>alert('Datos del Proveedor fueron Modificados Correctamente')</script>";
		mysqli_close($con);
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
<br/>
 
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

<center><h3> Registro de Proveedores </h3> </center>
<hr>
<form method="POST" name="frm" action="" >
		
		<div class="<?PHP echo $claseRif; ?>"> 
		&nbsp&nbsp Rif:
			<SELECT name="rif1" value="<?php echo $rif1;?>">
				<OPTION value=""> <?php echo $rif1;?>
				<OPTION value="V"> V
				<OPTION value="J"> J
				<OPTION value="G"> G				
			</SELECT>		
		&nbsp&nbsp <input type="number" name="rif" value="<?php echo $rif; ?>" placeholder="Introduzca el Rif del Provvedor"/>  
		<span class="msg"><?PHP echo $msgRif;?></span>
		</div>
		<br>
		<div class="<?PHP echo $claseRazon; ?>"> 
		&nbsp&nbsp&nbspRazon Social: <input type="text" size= "60" name="razon" value="<?php echo $razon; ?>" /><br/><br/>
		<span class="msg"><?PHP echo $msgRazon;?></span>
		</div>
		
		<div class="<?PHP echo $claseDireccion; ?>"> 
		&nbsp&nbspDirección:<textarea name="direccion" rows="3" cols="80"><?php echo $direccion;?></textarea><br/><br/>
		<span class="msg"><?PHP echo $msgDireccion;?></span>
		</div>
		
		<div class="<?PHP echo $claseTelefonos; ?>"> 
		&nbsp&nbspTeléfonos:
			<SELECT name="cod1" value="<?php echo $cod1;?>">
				<OPTION value=""> <?php echo $cod1;?>
				<OPTION value="0212"> 0212
				<OPTION value="0412"> 0412
				<OPTION value="0414"> 0414				
				<OPTION value="0416"> 0416
			</SELECT>
		&nbsp&nbsp&nbsp <input type="number" name="telf1" value="<?php echo $telf1; ?>" />
		
		&nbsp&nbsp<SELECT name="cod2" value="<?php echo $cod2;?>">
				<OPTION value=""> <?php echo $cod2;?>
				<OPTION value="0212"> 0212
				<OPTION value="0412"> 0412
				<OPTION value="0414"> 0414				
				<OPTION value="0416"> 0416
			</SELECT>
		&nbsp&nbsp&nbsp <input type="number" name="telf2" value="<?php echo $telf2; ?>" />
		
		&nbsp&nbsp<SELECT name="cod3" value="<?php echo $cod3;?>">
				<OPTION value=""> <?php echo $cod3;?>
				<OPTION value="0212"> 0212
				<OPTION value="0412"> 0412
				<OPTION value="0414"> 0414				
				<OPTION value="0416"> 0416
			</SELECT>
		&nbsp&nbsp&nbsp <input type="number" name="telf3" value="<?php echo $telf3; ?>" /><br/><br/>
		<span class="msg"><?PHP echo $msgTelefonos;?></span>
		</div>
		
		<div class="<?PHP echo $clasePersona; ?>"> 
		&nbsp&nbsp Persona de Contacto: <input type="text" name="personacontacto" value="<?php echo $personacontacto; ?>" /><br/><br/>
		<span class="msg"><?PHP echo $msgPersona;?></span>
		</div>
		
		<div class="<?PHP echo $claseEmail; ?>"> 
		&nbsp&nbsp Correo Electrónico: <input type="email" name="email" value="<?php echo $email; ?>" /><br/><br/>
		<span class="msg"><?PHP echo $msgEmail;?></span>
		</div>
		
		&nbsp&nbsp Observaciones:<textarea name="observaciones" rows="3" cols="80"><?php echo $observaciones;?></textarea><br/><br/>
		
		<hr><center><input type="submit" name="agregar" value="Agregar" />
		<input type="submit" name="modificar" value="Modificar"/>
		<input type="submit" name="buscar" value="Buscar"/></center>

</form>
<br><br><br>

<footer>
<div class='define'>

</div>
</footer>
@Copyright 2017. Todos los derechos reservados

</body>
</html>