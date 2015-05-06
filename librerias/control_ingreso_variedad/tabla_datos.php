<table>
	<tr>
		<td>Variedad</td>
		<td>Kneto</td>
		<td>Kgrado</td>
	</tr>

	<?php

	foreach ($respuesta as $key => $value) {
		# code...
		$variedad->carga_id($value['variety_id']);

		?>
	<tr>
		<td><?= $variedad->retorna("nombre")?></td>
		<td><?= $value['sumneto']?></td>
		<td><?= $value['sumgrado']?></td>
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