<table>
	<tr>
		<td>CORR</td>
		<td>FECHA</td>
		<td>GUIA</td>
		
		
		<td>VAR</td>
		<td>VALLE</td>
		<td>KNETO</td>
		<td>GRADO</td>
		<td>KGRADO</td>
		
	</tr>
	<?php
	

	foreach ($respuesta as $key => $value) {
		# code...
		$valle->carga_id($value['valley_id']);
	
		$variedad->carga_id($value['variety_id']);

		?>
	<tr>
		<td><?= $value['correlativo']?></td>
		<td><?= $value['fecha']?></td>
		<td><?= $value['guia']?></td>
		
		<td><?= $variedad->retorna("nombre")?></td>
		<td><?= $valle->retorna("nombre")?></td>
		
		<td><?= $value['kneto']?></td>
		<td><?= $value['grado']?></td>
		<td><?= $value['kgrado']?></td>

	</tr>
		<?php
	}

	?>
</table>

<table>
	<tr>
		<td class="nombre_dato">Total KNETO</td>
		<td class="valor_dato"><?= $suma_kneto?></td>
		<td class="nombre_dato">Total KGRADO</td>
		<td class="valor_dato"><?= $suma_kgrado?></td>
	</tr>
</table>