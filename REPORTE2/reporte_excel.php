<?php
header('Content-Type: text/html; charset=UTF-8');
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=Reporte_Proveedores.xls");

		require_once("dompdf/dompdf_config.inc.php");
		$conexion=mysql_connect("localhost","root","");
		mysql_select_db("sistema",$conexion);
	
?>
<!DOCTYPE html>
<html leng="esp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Reporte de los proveedores</title>
</head>
<body>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" bgcolor="skyblue"><CENTER><strong>REPORTE DE LOS PROVEDORES</strong></CENTER></td>
  </tr>
  <tr bgcolor="skyblue">
    <td><center><strong>RIF</strong></center></td>
    <td><center><strong>Raz&oacute;n Social</strong></center></td>
    <td><center><strong>Direcci&oacute;n</strong></center></td>
    <td><center><strong>Tel&eacute;fonos</strong></center></td>
    <td><center><strong>Persona de Contacto</strong></center></td>
    <td><center><strong>Email</strong></center></td>
  </tr>

 
<?PHP
$sql=mysql_query("select * from proveedor");
while($res=mysql_fetch_array($sql)){
	$rif1=$res["rif1"];
	$rif=$res["rif"];
	$razon=$res["razon"];
	$direccion=$res["direccion"];
	$cod1=$res["cod1"];
	$telf1=$res["telf1"];
	$cod2=$res["cod2"];
	$telf2=$res["telf2"];
	$cod3=$res["cod3"];
	$telf3=$res["telf3"];
	$personacontacto = $res["personacontacto"];
	$email=$res["email"];

?>  
 <tr>
	<td><?php echo $rif1."-".$rif; ?></td>
	<td><?php echo $razon; ?></td>
	<td><?php echo $direccion; ?></td>
	<td><?php echo "(".$cod1.") ".$telf1."(".$cod2.") ".$telf2."(".$cod3.") ".$telf3; ?></td>
	<td><?php echo $personacontacto; ?></td>
	<td><?php echo $email; ?></td>                     
 </tr> 
  <?php
}
  ?>
</table>
</body>
</html>