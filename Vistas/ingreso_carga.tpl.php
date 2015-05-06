<h2><?= $titulo?></h2>

<div class="datos_ingreso" id="data_ingreso">
	<input type="hidden" value="12" id="grado_base">
	<p>Corr <input type="text" size="6" id="corr"></p>
	<p>
		Guia <input type="text" size="4" id="guia_ingreso"> 
		Productor 
		<select name="productor" id="productor">
			<option value=""></option>
			<?php
				foreach ($partners as $key => $value) {
					# code...
					?><option value="<?= $value['id']?>"><?= utf8_encode($value['name'])."(".$value['cod_prod'].")"?></option><?php
				}
			?>
		</select> 
		<input type='hidden' name='formato_fecha' id="formato_fecha" value='yyyy/mm/dd'/>
		Fecha <input type="text" id="fecha" name="fecha" readonly size="7"/><input type='button' value='...' onclick='displayCalendar(document.getElementById("fecha"),document.getElementById("formato_fecha").value,this)' />
				Valle 
		<select name="valle" id="valle">
			<option value=""></option>
			<?php
				foreach ($valleys as $key => $value) {
					?><option value="<?= $value['id']?>"><?= $value['name']?></option><?php
				}
			?>
		</select>
	</p>
	<p>
		Variedad 
		<select name="variedad" id="variedad">
			<option value=""></option>
			<?php
				foreach ($varieties as $key => $value) {
					?><option value="<?= $value['id']?>"><?= $value['name']?></option><?php
				}
			?>
		</select> 

		K.Neto <input type="text" size="6" id="kneto">
		Grado <input type="text" size="4" id="grado">
		K.Grado <input type="text" size="6" readonly id="kgrado">
		<button id="btn_add_temporal" class="css_btn_guarda">Agrega</button>
	
	</p>
</div>
<div id="tabla_temporal" class="muestra_tabla">
	<h3>Tabla Temporal</h3>
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
	</table>
</div>

<div id="tabla_detalle" class="muestra_tabla">
	<h3>Detalle Mes</h3>
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

	foreach ($registers as $key => $value) {
		# code...
		$productor->carga_id($value['partner_id']);
		$valle->carga_id($value['valley_id']);
		$variedad->carga_id($value['variety_id']);

		$acumulado_grado+=$value['kgrado'];
		$acumulado_neto+=$value['kneto'];

		$arreglo_fecha = explode("-", $value['fecha']);

		$mes = $arreglo_fecha[1];

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
		<td><input type="button" onclick="borrar_registro('<?= $value['id']?>')" id="btn_borra_reg"></td>
	</tr>
		<?php
	}

	?>		
	</table>
</div>