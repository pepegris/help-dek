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
	$con=mysqli_connect("","","","") or die("Problemas con la conexión");

	//Agregar Registro




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

<center><h3> Registro de Clientes </h3> </center>
<hr>
<form method="POST" name="frm" action="" >
		&nbsp&nbsp Cédula de Identidad o Razón social:
		<div class="<?PHP echo $claseNac; ?>"> 
			<SELECT name="nac" value="<?php echo $nac;?>">
				<OPTION value=""> <?php echo $nac;?>
				<OPTION value="V"> V
				<OPTION value="J"> E
				<OPTION value="J"> P
				<OPTION value="J"> J
				<OPTION value="G"> G				
			</SELECT>
			&nbsp&nbsp <input type="number" name="cedula" value="<?php echo $cedula; ?>" /> <br/><br/> 
			<span class="msg"><?PHP echo $msgNac;?></span>
		</div>
		
		<div class="<?PHP echo $claseNombre; ?>"> 	
			&nbsp&nbsp&nbspNombres: <input type="text" size= "60" name="nombre" value="<?php echo $nombre; ?>" />
			&nbsp&nbsp&nbspApellidos: <input type="text" size= "60" name="apellido" value="<?php echo $apellido; ?>" /> <br/><br/>
			<span class="msg"><?PHP echo $msgNombre;?></span>
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
		
			<div class="<?PHP echo $claseEmail; ?>"> 
				Correo Electrónico: <input type="email" name="email" value="<?php echo $email; ?>" />
				<span class="msg"><?PHP echo $msgEmail;?></span>
			</div>
			<br/><br/>
		
		&nbsp&nbsp 
		
		&nbsp&nbsp Observaciones:<textarea name="observaciones" rows="3" cols="80"><?php echo $observaciones;?></textarea><br/><br/>
		
		<hr><center><input type="submit" name="agregar" value="Agregar" />
		<input type="submit" name="modificar" value="Modificar"/>
		<input type="submit" name="buscar" value="Buscar"/></center>

</form>
<br><br><br>

<footer>
<div class='define'>
@Copyright 2018. Todos los derechos reservados
</div>
</footer>


</body>
</html>