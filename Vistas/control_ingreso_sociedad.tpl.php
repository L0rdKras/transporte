<h2><?= $titulo?></h2>
<div class="datos_ingreso" id="data_busqueda">
	
	<p>
		Determine el Rango de tiempo a consultar
		<input type='hidden' name='formato_fecha' id="formato_fecha" value='yyyy/mm/dd'/>
		Fecha Inicio<input type="text" id="fecha_inicio" name="fecha" readonly size="7"/><input type='button' value='...' onclick='displayCalendar(document.getElementById("fecha_inicio"),document.getElementById("formato_fecha").value,this)' /> 
		Fecha Termino<input type="text" id="fecha_termino" name="fecha" readonly size="7"/><input type='button' value='...' onclick='displayCalendar(document.getElementById("fecha_termino"),document.getElementById("formato_fecha").value,this)' />
	</p>
	
	<p>
		<button id="btn_busca_rango_sociedad" class="css_btn_busca">Buscar</button>
	</p>
</div>
<div id="tabla_detalle" class="muestra_tabla">
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
</div>