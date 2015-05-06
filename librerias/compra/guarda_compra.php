<?php
require "../Entidades/Articulo.php";
if(isset($_POST['rut_prov']) && !empty($_POST['rut_prov']) && isset($_POST['documento']) && !empty($_POST['documento']) && isset($_POST['numero']) && !empty($_POST['numero']))
{
	//

	$busca_id_prov = new Consulta("SELECT id from proveedores where rut = '{$_POST['rut_prov']}'");	

	$res_id_prov = $busca_id_prov->retorna_resultado();
	$id_prov = 0;
	if($row_id_proc = $res_id_prov->fetch_array())
	{
		$id_prov = $row_id_proc['id'];
	}
	
	$busca_compra = new Consulta("SELECT * from compras where id_proveedor='$id_prov' and numero='{$_POST['numero']}' and documento = '{$_POST['documento']}'");
	if($busca_compra->filas_resultado()==0){
		$saca_suma = new Consulta("SELECT sum(subtotal) as sumatoria from aux_detalle");
		$res_sumatoria = $saca_suma->retorna_resultado();
		$total = 0;
		if($row_sum = $res_sumatoria->fetch_array()){
			$total += $row_sum['sumatoria'];
		}	

		$totaconiva= ceil($total*1.19);

		$iva = $totaconiva-$total;

		$hoy = date("Y-m-d");

		$id_usuario = 1;

		$qguardado = "INSERT INTO compras(numero,documento,fecha,neto,iva,total,id_proveedor,id_usuario,fecha_guardado) values('{$_POST['numero']}','{$_POST['documento']}','$hoy','$total','$iva','$totaconiva','$id_prov','$id_usuario','$hoy')";
		$ejecutor = new EjecutarSql();
		if($ejecutor->ejecutar($qguardado))
		{
			$id_compra = $ejecutor->retorna_ultimo_id();
			$recorre = new Consulta("SELECT * from aux_detalle");
			$resultado_recorre = $recorre->retorna_resultado();
			$articulo = new Articulo();
			while($row_rec = $resultado_recorre->fetch_array()){
				$articulo->cargar_por_id($row_rec['id_articulo']);
				$qguarda_detalle = "INSERT INTO detalle_compras(cantidad,precio,subtotal,id_articulo,id_compra) values('{$row_rec['cantidad']}','{$row_rec['precio_compra']}','{$row_rec['subtotal']}','{$row_rec['id_articulo']}','$id_compra')";
				//die($qguarda_detalle);
				if($ejecutor->ejecutar($qguarda_detalle))
				{
					$articulo->suma_stock($row_rec['cantidad']);
					$articulo->revisa_precio($row_rec['precio_venta']);
				}else{
					die("Error: Se produjo un error guardando el detalle");
				}
			}
			echo "Guardada";
		}

	}else{
		echo "Error: La compra ya ha sido registrada";
	}


}else{
	echo "Error: Falta Informacion";
}