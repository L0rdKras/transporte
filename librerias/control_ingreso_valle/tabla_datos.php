<table>
	<tr>
		<td>Valle</td>
		<td>Variedad</td>
		
		<td>KNETO</td>
		<td>KGRADO</td>
	</tr>
	<?php
	//var_dump($arreglo_data_grupos);
	$neto_total = 0;
	$grado_total = 0;
	$cont = 1;
	while ( $cont<= 5) {
		$value = $arreglo_data_valles[$cont];
		$neto = 0;
		$grado = 0;
		$valle->carga_id($cont);
		foreach ($value as $clave => $valor) {
			$neto += $valor['kneto'];
			$grado += $valor['kgrado'];
			$variedad->carga_id($clave);
		?>
	<tr>
		
		<td><?= $valle->retorna("nombre")?></td>
		<td><?= $variedad->retorna("nombre")?></td>
		<td><?= $valor['kneto']?></td>
		<td><?= $valor['kgrado']?></td>
	</tr>
		<?php
		}
		?>
	<tr>
		<td class="nombre_dato">Resultado Valle <?= $valle->retorna("nombre")?></td>
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