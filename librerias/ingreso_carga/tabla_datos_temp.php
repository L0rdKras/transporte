<table>
	<tr>
		<td>CORR</td>
		<td>FECHA</td>
		<td>GUIA</td>
		<td>COD.PROD</td>
		<td>NOMBRE</td>
		<td>VAR</td>
		<td>VALLE</td>
		<td>KNETO</td>
		<td>GRADO</td>
		<td>KGRADO</td>
		
		<td>MES</td>
		<td>SOCIO</td>
		<td>Borrar</td>
	</tr>
	<?php
	$acumulado_neto = 0;
	$acumulado_grado = 0;

	foreach ($resultado_datos as $key => $value) {
		# code...
		$productor->carga_id($value['partner_id']);
		$valle->carga_id($value['valley_id']);
		$variedad->carga_id($value['variety_id']);

		$arreglo_fecha = explode("-", $value['fecha']);

		$mes = $arreglo_fecha[1];

		$id_reg = $value['id'];

		?>
	<tr>
		<td><?= $value['correlativo']?></td>
		<td><?= $value['fecha']?></td>
		<td><?= $value['guia']?></td>
		<td><?= $productor->retorna("codigo")?></td>
		<td><?= $productor->retorna("nombre")?></td>
		<td><?= $variedad->retorna("nombre")?></td>
		<td><?= $valle->retorna("nombre")?></td>
		<td><?= $value['kneto']?></td>
		<td><?= $value['grado']?></td>
		<td><?= $value['kgrado']?></td>
		
		<td><?= $mes?></td>
		<td><?= $productor->retorna("group_id")?></td>
		<td><input type="button" onclick="borrar_registro_temp('<?= $id_reg?>')" id="btn_borra_reg"></td>
	</tr>
		<?php
	}

	?>
</table>

<?php
if($cantidad_registros>0)
{
	?>
	<p><button id="btn_guarda_principal" class="css_btn_guarda">Guarda</button></p>
	<?php
}

?>