<h3><?= $titulo?></h3>

<div class="caja_texto" id="datos_camion">
	<p>
		<b>Marca:</b> <input type="text" id="truck_mark">
		<b>Modelo:</b> <input type="text" id="truck_model">
	</p>
	<p>
		<b>Año:</b> <input type="text" id="truck_year">
	</p>
	<p>
		<button id="btn_guarda_camion">Guardar</button>
	</p>
</div>

<div class="informacion_adicional" id="lista_camiones">
	<table>
		<tr>
			<td>ID</td>
			<td>Marca</td>
			<td>Modelo</td>
			<td>Año</td>

		</tr>
		<?php
		foreach ($camiones as $key => $value) {
			# code...
			?>
		<tr>
			<td><?= $value['id']?></td>
			<td><?= $value['marca']?></td>
			<td><?= $value['modelo']?></td>
			<td><?= $value['year']?></td>
			
			
		</tr>
			<?php
		}

		?>
	</table>
</div>