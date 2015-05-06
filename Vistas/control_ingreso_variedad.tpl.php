<h2><?= $titulo?></h2>

<div class="datos_ingreso" id="data_busqueda">
	
	<p>
		Determine el Rango de tiempo a consultar
		<input type='hidden' name='formato_fecha' id="formato_fecha" value='yyyy/mm/dd'/>
		Fecha Inicio<input type="text" id="fecha_inicio" name="fecha" readonly size="7"/><input type='button' value='...' onclick='displayCalendar(document.getElementById("fecha_inicio"),document.getElementById("formato_fecha").value,this)' /> 
		Fecha Termino<input type="text" id="fecha_termino" name="fecha" readonly size="7"/><input type='button' value='...' onclick='displayCalendar(document.getElementById("fecha_termino"),document.getElementById("formato_fecha").value,this)' />
	</p>
	
	<p>
		<button id="btn_busca_variedad_mes" class="css_btn_busca">Buscar</button>
	</p>
</div>

<div id="tabla_detalle" class="muestra_tabla">

</div>