<h3><?= $titulo?></h3>

<div class="caja_texto" id="datos_camion">
	<p>
		<b>Peso Inical:</b> <input type="text" id="peso_inicial">
		<b>Peso Final:</b> <input type="text" id="peso_final">
	</p>
	<p>
		<b>Fecha</b> <input type="text" size="7" name="fecha" id="fecha"><input type="button" id="bnt_calendario" onclick="displayCalendar(fecha,'yyyy/mm/dd',this)" value="...">
	</p>
	<p>
		<b>Camion</b>
		<select name="camion" id="camion">
			<option value=""></option>
			<?php
			foreach ($camiones as $clave_camion => $d_camion) {
				?><option value="<?= $d_camion['id']?>"><?= $d_camion['id']?></option><?php
			}
			?>
		</select>

		<b>Chofer</b>
		<select name="chofer" id="chofer">
			<option value=""></option>
			<?php
			foreach ($choferes as $clave_chofer => $d_chofer) {
				# code...				
				?><option value="<?= $d_chofer['id']?>"><?= $d_camion['nombre']?></option><?php
			
			}

			?>
		</select>
	</p>
	<p>
		<button id="btn_guarda_camion">Guardar</button>
	</p>
</div>

<div class="informacion_adicional" id="lista_choferes">
	<table>
		<tr>
			<td>ID</td>
			<td>Fecha</td>
			<td>ID Camion</td>
			<td>Chofer</td>
			<td>Peso Inicial</td>
			<td>Peso Final</td>
			<td>Borrar</td>
		</tr>
		<?php
		foreach ($ultimas as $key => $value) {
			# code...
			?>
		<tr>
			<td><?= $value['id']?></td>
			<td><?= $value['fecha']?></td>
			<td><?= $value['truck_id']?></td>
			<td><?= $value['diver_id']?></td>
			<td><?= $value['peso_inicial']?></td>
			<td><?= $value['peso_final']?></td>

			<td><input type="button" onclick="borrar_chofer('<?= $value['id']?>')"></td>
		</tr>
			<?php
		}

		?>
	</table>
</div>