<?php
if(isset($reg_error)){
	echo $reg_error;
}
?>
<table border="1">
	<tr>
		<td>Codigo</td>
		<td>Descripcion</td>
		<td>Cantidad</td>
		
		<td>Precio Venta</td>
		<td>Subtotal</td>
	</tr>
	<?php
	foreach ($arreglo as $key => $value) {
		$articulo->cargar_por_id($value['id_articulo']);
		?>
	<tr class="fila_venta" id='<?= $value['id']?>'>
		<td><?= $articulo->mostrar('codigo')?></td>
		<td><?= $articulo->show_descripcion()?></td>
		<td><?= $value['cantidad']?></td>
		<td><?= $value['precio_venta']?></td>
		
		<td><?= $value['subtotal']?></td>
	</tr>
		<?php
	}
	?>
</table>
<p>Total Venta <?= $total?></p>
<button id="btn_vender">Confirmar Venta</button>