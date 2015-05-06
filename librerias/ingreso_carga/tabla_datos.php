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
		<td>K.N.ACOM</td>
		<td>K.G.ACOM</td>
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

		$acumulado_grado+=$value['kgrado'];
		$acumulado_neto+=$value['kneto'];

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
		<td><?= $acumulado_neto?></td>
		<td><?= $acumulado_grado?></td>
		<td><?= $mes?></td>
		<td><?= $productor->retorna("group_id")?></td>
		<td><input type="button" onclick="borrar_registro('<?= $id_reg?>')" id="btn_borra_reg"></td>
	</tr>
		<?php
	}

	?>
</table>