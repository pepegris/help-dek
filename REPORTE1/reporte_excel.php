<?php
header('Content-Type: text/html; charset=UTF-8');
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=Reporte_Clientes.xls");

		require_once("dompdf/dompdf_config.inc.php");
		$conexion=mysql_connect("localhost","root","");
		mysql_select_db("sistema",$conexion);
	
?>

<!DOCTYPE html>
<html leng="esp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Reporte de Clientes</title>
</head>
<body>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" bgcolor="skyblue"><CENTER><strong>REPORTE DE LOS CLIENTES</strong></CENTER></td>
  </tr>
  <tr bgcolor="skyblue">
    <td><center><strong>Cedula o RIF</strong></center></td>
    <td><center><strong>Nombres</strong></center></td>
    <td><center><strong>Apellidos</strong></center></td>
    <td><center><strong>Direcci&oacute;n</strong></center></td>
    <td><center><strong>Tel&eacute;fonos</strong></center></td>
    <td><center><strong>Email</strong></center></td>
  </tr>

 
<?PHP
$sql=mysql_query("select * from cliente");
while($res=mysql_fetch_array($sql)){
	$nac=$res["nac"];
	$cedula=$res["cedula"];
	$nombre=$res["nombre"];
	$apellido=$res["apellido"];
	$direccion=$res["direccion"];
	$cod1=$res["cod1"];
	$telf1=$res["telf1"];
	$cod2=$res["cod2"];
	$telf2=$res["telf2"];
	$cod3=$res["cod3"];
	$telf3=$res["telf3"];
	$email=$res["email"];

?>  
 <tr>
	<td><?php echo $nac."-".$cedula; ?></td>
	<td><?php echo $nombre; ?></td>
	<td><?php echo $apellido; ?></td>
	<td><?php echo $direccion; ?></td>
	<td><?php echo "(".$cod1.") ".$telf1."(".$cod2.") ".$telf2."(".$cod3.") ".$telf3; ?></td>
	<td><?php echo $email; ?></td>                     
 </tr> 
  <?php
}
  ?>
</table>
</body>
</html>