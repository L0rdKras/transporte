<p>
	Codigo <?= $articulo->mostrar("codigo")?> 
	Descripcion <?= $articulo->show_descripcion()?>
	Tipo <?= $articulo->show_tipo()?>
	Marca <?= $articulo->show_marca()?>
	Precio <?= $articulo->mostrar("precio")?> 
	Stock Actual <?= $articulo->mostrar("stock")?> 
</p>

<p>
	Cantidad Agregar <input class="campos_compra" type="text" id="cantidad_agregar" size="3"> 
	Precio Compra <input class="campos_compra" type="text" id="precio_agregar" size="3"> 
	Subtotal <input type="text" id="subtotal_agregar" size="3"> 
	<button id="<?= $articulo->mostrar('id')?>" class="agrega_cantidad">Agregar Compra</button>
</p>