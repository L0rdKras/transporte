<table>
	<tr>
		<td>Sociedad</td>
		<td>Codigo Prod.</td>
		<td>Nombre</td>
		<td>KNETO</td>
		<td>KGRADO</td>
	</tr>
	<?php
	//var_dump($arreglo_data_grupos);
	$neto_total = 0;
	$grado_total = 0;
	$cont = 1;
	while ( $cont<= 3) {
		$value = $arreglo_data_grupos[$cont];
		$neto = 0;
		$grado = 0;
		foreach ($value as $clave => $valor) {
			$neto += $valor['kneto'];
			$grado += $valor['kgrado'];
			$productor->carga_id($clave);
		?>
	<tr>
		<td><?= $cont?></td>
		<td><?= $productor->retorna("codigo")?></td>
		<td><?= $productor->retorna("nombre")?></td>
		<td><?= $valor['kneto']?></td>
		<td><?= $valor['kgrado']?></td>
	</tr>
		<?php
		}
		?>
	<tr>
		<td class="nombre_dato">Resultado Grupo <?= $cont?></td>
		<td></td>
		<td></td>
		<td class="valor_dato"><?= $neto?></td>
		<td class="valor_dato"><?= $grado?></td>
	</tr>
		<?php
		$neto_total+=$neto;
		$grado_total+=$grado;
		$cont++;
	}

	?>
</table>

<table>
	<tr>
		<td class="nombre_dato">Total KNETO</td>
		<td class="valor_dato"><?= $neto_total?></td>
		<td class="nombre_dato">Total KGRADO</td>
		<td class="valor_dato"><?= $grado_total?></td>
	</tr>
</table>