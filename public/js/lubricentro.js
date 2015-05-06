$(document).ready(function() {
    funciones_tipo();
    funciones_marca();
    funciones_descripcion();
    funciones_articulo();
    funciones_compra();
    funciones_venta();
    funciones_ingreso_cliente();
    funciones_ingreso_proveedor();
});

//Seccion Ingreso Tipo Articulo

function funciones_tipo(){
	agregar_tipo();
}

function agregar_tipo(){
	$("#btn_add_tipo").on("click", function(event){
		event.preventDefault();
		var valor = $("#nombre").val();
		$.ajax({
			type: "POST",
			url: "invocador.php?app=ingreso_tipo&funcion=agrega",
			data: {nombre:valor},
			success: function(datos){
				alert(datos);
			}
		});
	});
}

function funciones_marca(){
	agregar_marca();
}

function agregar_marca(){
	$("#btn_add_marca").on("click", function(event){
		event.preventDefault();
		var valor = $("#nombre").val();
		$.ajax({
			type: "POST",
			url: "invocador.php?app=ingreso_marca&funcion=agrega",
			data: {nombre:valor},
			success: function(datos){
				alert(datos);
			}
		});
	});
}

function funciones_descripcion(){
	agregar_descripcion();
}

function agregar_descripcion(){
	$("#btn_add_descripcion").on("click", function(event){
		event.preventDefault();
		var valor = $("#nombre").val();
		var valor2 = $("#tipo_descripcion").val();
		$.ajax({
			type: "POST",
			url: "invocador.php?app=ingreso_descripcion&funcion=agrega",
			data: {nombre:valor,tipo:valor2},
			success: function(datos){
				alert(datos);
			}
		});
	});
}

function funciones_articulo(){
	$("#btn_add_articulo").on("click", function(event){
		event.preventDefault();
		var valor1 = $("#tipo").val();
		var valor2 = $("#descripcion").val();
		var valor3 = $("#marca").val();
		var valor4 = $("#precio").val();
		$.ajax({
			type: "POST",
			url: "invocador.php?app=ingreso_articulo&funcion=agrega",
			data: {tipo: valor1, descripcion: valor2, marca: valor3, precio: valor4},
			success: function(datos){
				alert(datos);
				location.href="/crear_articulo.php";
			}
		});
	});
}

function funciones_compra(){
	//
	buscar_articulo_compra();
	cargar_nombre_prov();
}

function cargar_nombre_prov(){
	$("#rut_prov_compra").on("keypress",function(event){
		var el_rut = daformator($(this).val());		
		if(event.which == 13){
			$.ajax({
				type: "GET",
				url: "invocador.php?app=comun&funcion=carga_nombre",
				data:{dato:el_rut, tabla: "proveedores", campo:"rut", respuesta:"nombre"},
				success: function(datos){
					//
					if(datos.search("Error") ==0 ){
						alert(datos);
						$("#rut_prov_compra").val(el_rut);
					}else{
						$("#rut_prov_compra").val(el_rut);
						$("#nombre_prov_compra").val(datos);
					}
				}
			});
		}
	});	
}

function buscar_articulo_compra(){
	$("#btn_busca_articulo_compra").on("click", function(event){
		event.preventDefault();
		var valor1 = $("#tipo_articulo_compra").val();
		var valor2 = $("#descripcion_articulo_compra").val();
		var valor3 = $("#marca_articulo_compra").val();
		$.ajax({
			type: "GET",
			url: "invocador.php?app=compra&funcion=busca_articulo",
			data: {tipo: valor1, descripcion: valor2, marca: valor3},
			success: function(datos){
				$("#resultado_busqueda_compra").html(datos);
				 setTimeout(function(){ 
				 	display_cantidad_comprar(); 
				 }, 1000);
			}
		});
	});
}

function display_cantidad_comprar(){
	$(".btn_agregar_detalle_compra").on("click", function(event){
		event.preventDefault();
		var id_art = $(this).attr("id");
		$.ajax({
			type: "GET",
			url: "invocador.php?app=compra&funcion=display_cantidad",
			data: {id: id_art},
			success: function (datos){
				$("#ingresar_cantidad").html(datos);
				setTimeout(function(){ 
					modifica_datos_compra();
				 	add_detalle(); 
				 }, 1000);
			}
		});
	});
}

function add_detalle(){
	$(".agrega_cantidad").on("click", function(event){
		event.preventDefault();
		var id_art= $(this).attr("id");
		var cant = $("#cantidad_agregar").val();
		var prec = $("#precio_agregar").val();
		var subt = multiplica_total();
		$.ajax({
			type: "GET",
			url: "invocador.php?app=compra&funcion=agrega_detalle",
			data: {articulo: id_art, cantidad: cant, precio: prec, subtotal: subt},
			success: function (datos){
				$("#detalle_compra").html(datos);
				setTimeout(function(){ 
					borra_detalle();
					guardar_compra();
				 }, 1000);
			}
		});
	});
}

function modifica_datos_compra(){
	$(".campos_compra").on("keypress", function(event){
		if(event.which == 13){
			event.preventDefault();
			multiplica_total();
		}
	});
}

function multiplica_total(){
	var total=$("#cantidad_agregar").val()*$("#precio_agregar").val();
	$("#subtotal_agregar").val(total);
	return total;
}

function guardar_compra(){
	$("#btn_guarda_compra").on("click", function(event){
		//
		event.preventDefault();
		$.ajax({
			type: "GET",
			url: "invocador.php?app=compra&funcion=tiene_detalle_compra",
			success: function(datos){
				if(datos=="true"){
					graba_compra();
				}else{
					alert("No tiene items agregados en la compra");
				}
			}
		});
	});
}

function graba_compra(){
	var rutprov = $("#rut_prov_compra").val();
	var doc = $("#documento_compra").val();
	var num = $("#numero_doc_compra").val();
	if(rutprov.length>0 && doc.length>0 && num.length>0){
		$.ajax({
			type: "POST",
			url: "invocador.php?app=compra&funcion=guarda_compra",
			data: {rut_prov: rutprov, documento: doc, numero: num},
			success: function(datos){
				alert(datos);
				if(datos=="Guardada"){
					location.href="index.php";
				}
			}
		});
		
	}else{
		alert("Debe Completar los datos de la Factura");
	}
}

function borra_detalle(){
	$(".fila_compra").on("dblclick",function(){
		var id_detalle = $(this).attr("id");
		$.ajax({
			type: "GET",
			url: "invocador.php?app=compra&funcion=borra_detalle",
			data: {id: id_detalle},
			success: function (datos){
				$("#detalle_compra").html(datos);
				setTimeout(function(){ 
					borra_detalle();
					guardar_compra();
				 }, 1000);
			}
		});		
	});
}

function funciones_venta(){
	//
	buscar_articulo_venta();
}

function buscar_articulo_venta(){
	$("#btn_busca_articulo_venta").on('click',function(event){
		//
		event.preventDefault();
		var valor1 = $("#tipo_articulo_venta").val();
		var valor2 = $("#descripcion_articulo_venta").val();
		var valor3 = $("#marca_articulo_venta").val();
		$.ajax({
			type: "GET",
			url: "invocador.php?app=venta&funcion=busca_articulo",
			data: {tipo: valor1, descripcion: valor2, marca: valor3},
			success: function(datos){
				$("#resultado_busqueda_venta").html(datos);
				 setTimeout(function(){ 
				 	display_cantidad_vender(); 
				 }, 1000);
			}
		});		
	});
}

function display_cantidad_vender(){
	//
	$(".btn_agregar_carro_venta").on("click", function(event){
		event.preventDefault();
		var id_art = $(this).attr("id");
		$.ajax({
			type: "GET",
			url: "invocador.php?app=venta&funcion=display_cantidad",
			data: {id: id_art},
			success: function (datos){
				$("#ingresar_cantidad_venta").html(datos);
				setTimeout(function(){ 
					modifica_datos("campos_venta","cantidad_venta","precio_venta","subtotal_agregar");
				 	add_detalle_venta(); 
				 }, 1000);
			}
		});
	});
}

function modifica_datos(campo_reaccion,mult1,mult2,respuesta){
	$("."+campo_reaccion).on("keypress", function(event){
		if(event.which == 13){
			//revisar stock
			event.preventDefault();
			if($("#"+mult1).val()<= $("#stock_actual").val()){
				//
				multiplica_campos(mult1,mult2,respuesta);
			}else{
				alert("La cantidad es mayor a la que se tiene en stock");
				$("#"+mult1).val("0");
			}
		}
	});
}

function multiplica_campos(mult1,mult2,respuesta){
	var total=$("#"+mult1).val()*$("#"+mult2).val();
	$("#"+respuesta).val(total);
	return total;
}

function add_detalle_venta(){
	$(".agrega_al_carro").on("click", function(event){
		event.preventDefault();
		var id_art= $(this).attr("id");
		var cant = $("#cantidad_venta").val();
		var prec = $("#precio_venta").val();
		var subt = multiplica_campos("cantidad_venta","precio_venta","subtotal_agregar");
		$.ajax({
			type: "GET",
			url: "invocador.php?app=venta&funcion=agrega_detalle",
			data: {articulo: id_art, cantidad: cant, precio: prec, subtotal: subt},
			success: function (datos){
				$("#carro_venta").html(datos);
				setTimeout(function(){ 
					borra_detalle_venta();
					guardar_venta();
				}, 1000);
			}
		});
	});
}

function borra_detalle_venta(){
	$(".fila_venta").on('dblclick',function(){
		var id_detalle = $(this).attr("id");
		$.ajax({
			type: "GET",
			url: "invocador.php?app=venta&funcion=borra_detalle",
			data: {id: id_detalle},
			success: function (datos){
				$("#carro_venta").html(datos);
				setTimeout(function(){ 
					borra_detalle_venta();
					guardar_venta();
				 }, 1000);
			}
		});
	});
}

function guardar_venta(){
	//
	$("#btn_vender").on("click",function(event){
		event.preventDefault();
		//revisar que no este vacio
		//preguntar si esta seguro
		//desplegar para llenar datos cliente
		//ocultar busqueda articulo
		$.ajax({
			type: "GET",
			url: "invocador.php?app=comun&funcion=esta_vacia",
			data: {tabla: "carro_venta"},
			success: function (datos){
				if(datos == "NO"){
					//continua
					if(confirm("Quiere Guardar la venta?")){
						completar_datos_y_guardar();
					}
				}else{
					alert("No Hay articulos cargados para vender");
				}
			}
		});
	});
}

function completar_datos_y_guardar(){
	//
	$("#busca_art_venta").fadeOut();
	$("#resultado_busqueda_venta").fadeOut();
	$("#ingresar_cantidad_venta").fadeOut();
	$("#btn_vender").fadeOut("slow", mostrar_cliente_venta);

}

function mostrar_cliente_venta(){
	//
	var llenar ="<h3>Datos Cliente</h3><p>Rut : <input type='text' size='10' id='rut_venta'/> Nombre <input type='text' readonly id='nombre_venta'/> <input type='hidden' id='id_cliente'/> <button id='btn_final_venta'>Confirmar</button>";

	$("#carro_venta").append(llenar);
	setTimeout(function(){ 
		carga_cliente_venta();
		fin_venta();
	}, 1000);
}

function carga_cliente_venta(){
	//
	$("#rut_venta").on("keypress",function(event){
		var el_rut = daformator($(this).val());		
		if(event.which == 13){
			$.ajax({
				type: "GET",
				url: "invocador.php?app=comun&funcion=carga_nombre",
				data:{dato:el_rut, tabla: "clientes", campo:"rut", respuesta:"nombre"},
				success: function(datos){
					//
					if(datos.search("Error") ==0 ){
						alert(datos);
						$("#rut_venta").val(el_rut);
					}else{
						$("#rut_venta").val(el_rut);
						$("#nombre_venta").val(datos);
					}
				}
			});
		}
	});
}

function fin_venta(){
	//
	$("#btn_final_venta").on("click",function(event){
		event.preventDefault();
		//
		var nombre = $("#nombre_venta").val();
		var rut = $("#rut_venta").val();

		if(nombre.length>0 && rut.length>0){
			//
			venta_guardada(rut,nombre);
		}else{
			alert("Faltan datos del cliente");
		}
	});
}

function venta_guardada(rut,nombre){
	//
	$.ajax({
		type: "POST",
		url: "invocador.php?app=venta&funcion=guarda_venta",
		data: {rutclie: rut},
		success: function(datos){
			//
			if(datos == "Exito"){
				alert("Venta Guardada");
				location.href="ver_ultima_venta.php";
			}else{
				alert("Hubo un error al guardar");
			}
		}
	});
}

function funciones_ingreso_cliente(){
	carga_cliente_ingreso();
	guardar_cliente();
}
function carga_cliente_ingreso(){
	//
	$("#rut_ing_cliente").on("keypress",function(event){
		var el_rut = daformator($(this).val());
		if(event.which == 13){
			$.ajax({
				type: "GET",
				url: "invocador.php?app=comun&funcion=carga_datos",
				data:{dato:el_rut, tabla: "clientes", campo:"rut"},
				success: function(datos){
					//
					try {
						//
						var info = JSON.parse(datos);
						$("#rut_ing_cliente").val(el_rut);
						$("#nombre_ing_cliente").val(info.nombre);
						$("#direccion_ing_cliente").val(info.direccion);
						$("#fono_ing_cliente").val(info.telefono);
						$("#mail_ing_cliente").val(info.email);


					}catch(e){
						alert(datos);
						$("#rut_ing_cliente").val(el_rut);
					}
				}
			});
		}
	});
}

function guardar_cliente(){
	//
	$("#btn_guarda_cliente").on("click",function(){
		//
		var apta = true;
		if(vacio($("#rut_ing_cliente").val())){
			apta = false;
		}
		if(vacio($("#nombre_ing_cliente").val())){
			apta = false;
		}
		if(vacio($("#direccion_ing_cliente").val())){
			apta = false;
		}
		if(vacio($("#fono_ing_cliente").val())){
			apta = false;
		}
		if(vacio($("#mail_ing_cliente").val())){
			apta = false;
		}

		if(apta){
			//
			var el_rut = daformator($("#rut_ing_cliente").val());

			if(valida_cadena(el_rut)){
				g_cliente(el_rut,$("#nombre_ing_cliente").val(),$("#direccion_ing_cliente").val(),$("#fono_ing_cliente").val(),$("#mail_ing_cliente").val());
			}
		}else{
			alert("Hay Campos Vacios Por Completar");
		}
	});
}

function g_cliente(rut,nombre,direccion,fono,mail){
	$.ajax({
		type : "POST",
		url: "invocador.php?app=crear_cliente&funcion=guarda_cliente",
		data: {rut:rut,nombre:nombre,direccion:direccion,fono:fono,mail:mail},
		success: function(datos){
			if(datos=="Exito"){
				alert("Informacion Guardada");
				location.reload();
			}else{
				alert(datos);
			}
		}
	});
}

function funciones_ingreso_proveedor(){
	carga_proveedor_ingreso();
	guardar_proveedor();
}
function carga_proveedor_ingreso(){
	//
	$("#rut_ing_proveedor").on("keypress",function(event){
		var el_rut = daformator($(this).val());
		if(event.which == 13){
			$.ajax({
				type: "GET",
				url: "invocador.php?app=comun&funcion=carga_datos",
				data:{dato:el_rut, tabla: "proveedores", campo:"rut"},
				success: function(datos){
					//

					try {
						//
						var info = JSON.parse(datos);
						$("#rut_ing_proveedor").val(el_rut);
						$("#nombre_ing_proveedor").val(info.nombre);
						$("#direccion_ing_proveedor").val(info.direccion);
						$("#fono_ing_proveedor").val(info.telefono);
						$("#mail_ing_proveedor").val(info.email);


					}catch(e){
						alert(datos);
						$("#rut_ing_proveedor").val(el_rut);
					}

					/*if(datos.search("Error") ==0 ){
						alert(datos);
						$("#rut_ing_proveedor").val(el_rut);
					}else{
						$("#rut_ing_proveedor").val(el_rut);
						$("#nombre_ing_proveedor").val(datos);
					}*/
				}
			});
		}
	});
}

function guardar_proveedor(){
	//
	$("#btn_guarda_proveedor").on("click",function(){
		//
		var apta = true;
		if(vacio($("#rut_ing_proveedor").val())){
			apta = false;
		}
		if(vacio($("#nombre_ing_proveedor").val())){
			apta = false;
		}
		if(vacio($("#direccion_ing_proveedor").val())){
			apta = false;
		}
		if(vacio($("#fono_ing_proveedor").val())){
			apta = false;
		}
		if(vacio($("#mail_ing_proveedor").val())){
			apta = false;
		}

		if(apta){
			//
			var el_rut = daformator($("#rut_ing_proveedor").val());

			if(valida_cadena(el_rut)){
				g_proveedor(el_rut,$("#nombre_ing_proveedor").val(),$("#direccion_ing_proveedor").val(),$("#fono_ing_proveedor").val(),$("#mail_ing_proveedor").val());
			}
		}else{
			alert("Hay Campos Vacios Por Completar");
		}
	});
}

function g_proveedor(rut,nombre,direccion,fono,mail){
	$.ajax({
		type : "POST",
		url: "invocador.php?app=crear_proveedor&funcion=guarda_proveedor",
		data: {rut:rut,nombre:nombre,direccion:direccion,fono:fono,mail:mail},
		success: function(datos){
			if(datos=="Exito"){
				alert("Informacion Guardada");
				location.reload();
			}else{
				alert(datos);
			}
		}
	});
}