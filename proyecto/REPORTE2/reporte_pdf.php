<?php

		require_once("dompdf/dompdf_config.inc.php");
		$conexion=mysql_connect("localhost","yaja","1234");
		mysql_select_db("cardoza",$conexion);

header('Content-Type: text/html; charset=UTF-8');

$codigoHTML='
<!DOCTYPE html>
<html leng="esp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Reporte de Provvedores</title>
</head>
<body>
<center> <img src="logo.png" width="500"> </center>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" bgcolor="skyblue"><CENTER><strong>REPORTE DE LOS PROVVEDORES</strong></CENTER></td>
  </tr>
  <tr bgcolor="skyblue">
    <td><center><strong>RIF</strong></center></td>
    <td><center><strong>Raz&oacute;n Social</strong></center></td>
    <td><center><strong>Direcci&oacute;n</strong></center></td>
    <td><center><strong>Tel&eacute;fonos</strong></center></td>
    <td><center><strong>Persona de Contacto</strong></center></td>
    <td><center><strong>Email</strong></center></td>
  </tr>';
  


$sql=mysql_query("select * from proveedor");
while($res=mysql_fetch_array($sql)){
$codigoHTML.='	
	<tr>
		<td>'.$res['rif1']."-".$res['rif'].'</td>
		<td>'.$res['razon'].'</td>
		<td>'.$res['direccion'].'</td>
		<td>'."(".$res['cod1'].")".$res['telf1']."(".$res['cod2'].")".$res['telf2']."(".$res['cod3'].")".$res['telf3'].'</td>
		<td>'.$res['personacontacto'].'</td>
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
$dompdf->stream("Reporte_Provvedores.pdf");
?>
