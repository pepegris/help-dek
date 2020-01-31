<!doctype html>
<html>
	<?php
	error_reporting();
		//validación del formulario
		$msgNombre="";
		$msgEdad="";
		$msgEmail="";
		$claseNombre="";
		$claseEdad="";
		$claseEmail="";
			
				$nombre=" ";
				$edad=" ";
				$email=" ";
			
			
		if($_POST){
			//var_dump($_POST);
			$nombre=$_POST["nombre"];
			$edad=$_POST["edad"];
			$email=$_POST["email"];
			//var_dump($nombre);
			//var_dump($edad);
			//$claseNombre="";
			//$claseEdad="";
			
			if($nombre==""){
				$msgNombre= "Falta ingresar el nombre";
				$claseNombre = "error";
			}
			if($edad=="") {
				$msgEdad = "Falta ingresar la edad";
				$claseEdad = "error";
			}
			
			if (filter_var($email, FILTER_VALIDATE_EMAIL)){
				
			}else{
				$msgEmail = "Correo no cumple con el formato";
				$claseEmail = "error";
			}
		}	
		
	?>
<head>
	<title>Formularios</title>
<style>
	div{
		margin: 10px;
	}

	div label{
		padding: 10px;
		float: left;
		width: 20%
	}

	input{
		padding: 10px;
		border: solid 4px black;
	}

	.error{
		background: orange;
		boder: solid 4px red;
	}

	.msg{
		color: white;
		font-size: 10px;
	}
</style>	
</head>

<body>

	<h1>Formulario de Ingreso</h1>
	<form name="form1" method="POST" action="">
	<fieldset>
	<legend>Datos de Ingreso</legend>
	<div class="<?PHP echo $claseNombre; ?>"> 
	<label>Nombre</label>
	<input type="text" name="nombre" value="<?PHP echo $nombre;?>">
	<span class="msg"><?PHP echo $msgNombre;?></span>
	</div>
	<div class="<?PHP echo $claseEdad; ?>"> 
	<label>Edad</label>
	<input type="number" name="edad" value="<?PHP echo $edad; ?>">
	<span class="msg"><?PHP echo $msgEdad;?></span>
	</div>	
	<div class="<?PHP echo $claseEmail; ?>"> 
	<label>Email</label>
	<input type="email" name="email" value="<?PHP echo $email; ?>">
	<span class="msg"><?PHP echo $msgEmail;?></span>
	</div>	

	<div> 
	<input type="submit" value= "validar" >
	</div>	
	</fieldset>
	
	
	</form>

</body>
</html>