<p>
	Codigo <?= $articulo->mostrar("codigo")?> 
	Descripcion <?= $articulo->show_descripcion()?>
	Tipo <?= $articulo->show_tipo()?>
	Marca <?= $articulo->show_marca()?>
	Precio <?= $articulo->mostrar("precio")?> 
	Stock Actual <?= $articulo->mostrar("stock")?> 
	<input type="hidden" name="stock_actual" id="stock_actual" value="<?= $articulo->mostrar("stock")?>">
</p>

<p>
	Cantidad Agregar <input class="campos_venta" type="text" id="cantidad_venta" size="3"> 
	Precio Venta <input class="campos_venta" type="text" id="precio_venta" size="3" value="<?= $articulo->mostrar("precio")?>"> 
	Subtotal <input type="text" id="subtotal_agregar" size="3"> 
	<button id="<?= $articulo->mostrar('id')?>" class="agrega_al_carro">Agregar Venta</button>
</p>