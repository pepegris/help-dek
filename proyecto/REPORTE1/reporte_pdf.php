<?php

		require_once("dompdf/dompdf_config.inc.php");
		$conexion=mysql_connect("localhost","root","");
		mysql_select_db("sistema",$conexion);

header('Content-Type: text/html; charset=UTF-8');

$codigoHTML='
<!DOCTYPE html>
<html leng="esp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Reporte de Clientes</title>
</head>
<body>
<center> <img src="logo.png" width="500"> </center>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" bgcolor="skyblue"><CENTER><strong>REPORTE DE LA TABLA USUARIOS</strong></CENTER></td>
  </tr>
  <tr bgcolor="skyblue">
    <td><center><strong>Cedula o RIF</strong></center></td>
    <td><center><strong>Nombres</strong></center></td>
    <td><center><strong>Apellidos</strong></center></td>
    <td><center><strong>Direcci&oacute;n</strong></center></td>
    <td><center><strong>Tel&eacute;fonos</strong></center></td>
    <td><center><strong>Email</strong></center></td>
  </tr>';
  


$sql=mysql_query("select * from cliente");
while($res=mysql_fetch_array($sql)){
$codigoHTML.='	
	<tr>
		<td>'.$res['nac']."-".$res['cedula'].'</td>
		<td>'.$res['nombre'].'</td>
		<td>'.$res['apellido'].'</td>
		<td>'.$res['direccion'].'</td>
		<td>'."(".$res['cod1'].")".$res['telf1']."(".$res['cod2'].")".$res['telf2']."(".$res['cod3'].")".$res['telf3'].'</td>
		<td>'.$res['email'].'</td>										
	</tr>';
	
}
$codigoHTML.='
</table>
</body>
</html>';
$codigoHTML=utf8_encode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Reporte_Clientes.pdf");
?>
