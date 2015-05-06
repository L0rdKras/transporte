<table border="1">
	<tr>
		<td>Agrega</td>
		<td>Codigo</td>
		<td>Descripcion</td>
		<td>Tipo</td>
		<td>Marca</td>
		<td>Precio</td>
		<td>Stock Actual</td>
	</tr>
	<?php
	foreach ($resultado as $key => $value) {
		$articulo->cargar_por_id($value['id']);
		?>
	<tr>
		<td><button id="<?= $articulo->mostrar('id')?>" class="btn_agregar_detalle_compra" >...</button></td>
		<td><?= $articulo->mostrar('codigo')?></td>
		<td><?= $articulo->show_descripcion()?></td>
		<td><?= $articulo->show_tipo()?></td>
		<td><?= $articulo->show_marca()?></td>
		<td><?= $articulo->mostrar('precio')?></td>
		<td><?= $articulo->mostrar('stock')?></td>
	</tr>
		<?php
	}
	?>
</table>