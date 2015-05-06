$(document).ready(function() {
    
    funciones_ingreso();
    funciones_busca_inf_diaria();
    funciones_busca_variedades_mes();
    funciones_control_productor_diario();
    funciones_control_ingreso_sociedad();
    funciones_control_ingreso_valle();
});

function funciones_ingreso(){
	//guardar_ingreso();
	agrega_temporal();
	salto_enter("corr","guia_ingreso");
	salto_enter("guia_ingreso","productor");
	calcular_kgrado("kneto","grado");
	calcular_kgrado("grado","btn_registra");
	$('#corr').validCampoFranz('0123456789');
	$('#guia_ingreso').validCampoFranz('0123456789');
	$('#kneto').validCampoFranz('0123456789');
	$('#grado').validCampoFranz('0123456789.');
}

function guardar_ingreso(){
	$("#btn_registra").on("click",function(){
		var arreglo = ['corr','guia_ingreso','productor','fecha','variedad','valle','kneto','grado','kgrado'];

		if(!vacios(arreglo)){
			//sigue guardarndo
			modal_espera();
			//registra();
		}else{
			alert("Revise los datos, hay campos sin completar");
		}
	});
}

function agrega_temporal(){
	//
	$("#btn_add_temporal").on("click",function(){
		var arreglo = ['corr','guia_ingreso','productor','fecha','variedad','valle','kneto','grado','kgrado'];

		if(!vacios(arreglo)){
			//sigue guardarndo
			modal_espera();
			al_temporal();
		}else{
			alert("Revise los datos, hay campos sin completar");
		}
	});
}

function calcular_kgrado(id,destino){
	$("#"+id).on("keypress",function(event){
		if(event.which == 13){
			if(vacio($("#kneto").val()))
			{
				$("#kneto").val("0");
			}
			if(vacio($("#grado").val()))
			{
				$("#grado").val("0");
			}

			var valor = Math.round(ejecuta_formula());

			$("#kgrado").val(valor);

			$("#"+destino).focus();
		}
	});
}

function ejecuta_formula(){
	var v1 = parseInt($("#kneto").val());
	var v2 = parseFloat($("#grado").val());
	var v3 = parseInt($("#grado_base").val());

	return (v1*v2)/v3;
}

function registra(){
	$.ajax({
		type : "POST",
		url: "invocador.php?app=ingreso_carga&funcion=guarda_registro",
		data: {corr: $("#corr").val(),guia: $("#guia_ingreso").val(),productor: $("#productor").val(),fecha: $("#fecha").val(),variedad: $("#variedad").val(),valle: $("#valle").val(),kneto: $("#kneto").val(),grado: $("#grado").val(),kgrado: $("#kgrado").val()},
		success : function(datos){
			//console.log(datos);
			try{
				var info = JSON.parse(datos);
				alert(info.mensaje);
				if(info.respuesta = "guardo"){
					//
					location.reload();
					/*$("#tabla_detalle").html(info.contenido).promise().done(function(){
					
						cierra_modal();
						limpia_campos();			
					});*/
				}else{
					cierra_modal();
				}
			}catch(e){
				alert(datos);
			}
		}
	});
}

function al_temporal(){
	$.ajax({
		type : "POST",
		url: "invocador.php?app=ingreso_carga&funcion=guarda_temporal",
		data: {corr: $("#corr").val(),guia: $("#guia_ingreso").val(),productor: $("#productor").val(),fecha: $("#fecha").val(),variedad: $("#variedad").val(),valle: $("#valle").val(),kneto: $("#kneto").val(),grado: $("#grado").val(),kgrado: $("#kgrado").val()},
		success : function(datos){
			//console.log(datos);
			try{
				var info = JSON.parse(datos);
				alert(info.mensaje);
				cierra_modal();
				
			}catch(e){
				$("#tabla_temporal").html(datos).promise().done(function(){
					cierra_modal();
					limpia_campos_temp();
					guarda_todo();
				});
			}
		}
	});
}

function guarda_todo(){
	//
	$("#btn_guarda_principal").on("click",function(){
		modal_espera();
		$.ajax({
			type : "POST",
			url: "invocador.php?app=ingreso_carga&funcion=guarda_todo",
			
			success : function(datos){
				//console.log(datos);
				try{
					var info = JSON.parse(datos);
					alert(info.mensaje);
					cierra_modal();
					
				}catch(e){
					$("#tabla_detalle").html(datos).promise().done(function(){
						$("#tabla_temporal").html("");
						cierra_modal();
						limpia_campos();
						
					});
				}
			}
		});
	});
}

function modal_espera(){
	$("<div id='cuadro_espera' class='waiting'><h2>Espera mientras el sistema trabaja...</h2></div>").modal({
		opacity:80,
		escClose: false,
		overlayCss: {backgroundColor:"#fff"}
	});
}

function cierra_modal(){
	$.modal.close();
}

function borrar_registro(id){
	if(confirm("Presione Aceptar para eliminar este registro")){
		modal_espera();
		$.ajax({
			type: "POST",
			url: "invocador.php?app=ingreso_carga&funcion=borra_registro",
			data: {id:id},
			success : function(datos){
				try{
					var info = JSON.parse(datos);
					alert(info.mensaje);
					if(info.respuesta = "borro"){
						//
						/*$("#tabla_detalle").html(info.contenido).promise().done(function(){
						
							cierra_modal();					
						});*/
						location.reload();
					}else{
						cierra_modal();
					}
				}catch(e){
					alert(datos);
				}
			}
		});
	}
}

function borrar_registro_temp(id){
	//
	if(confirm("Presione Aceptar para eliminar este registro")){
		modal_espera();
		$.ajax({
			type: "POST",
			url: "invocador.php?app=ingreso_carga&funcion=borra_registro_temporal",
			data: {id:id},
			success : function(datos){
				try{
					var info = JSON.parse(datos);
					alert(info.mensaje);
					
					cierra_modal();
					
				}catch(e){
					$("#tabla_temporal").html(datos).promise().done(function(){
						cierra_modal();
					
						guarda_todo();
					});
				}
			}
		});
	}
}

function limpia_campos(){
	$("#corr").val("");
	$("#guia_ingreso").val("");
	$("#productor").val("");
	$("#fecha").val("");
	$("#variedad").val("");
	$("#valle").val("");
	$("#kneto").val("");
	$("#grado").val("");
	$("#kgrado").val("");
}

function limpia_campos_temp(){
	//$("#corr").val("");
	//$("#guia_ingreso").val("");
	//$("#productor").val("");
	//$("#fecha").val("");
	$("#variedad").val("");
	//$("#valle").val("");
	$("#kneto").val("");
	$("#grado").val("");
	$("#kgrado").val("");
}

function funciones_busca_inf_diaria(){
	busca_datos();
}

function busca_datos(){
	$("#btn_busca_diario").on("click",function(){
		var arreglo = ['fecha_inicio','fecha_termino'];

		if(!vacios(arreglo)){
			//sigue guardarndo
			modal_espera();
			busca_inf_diaria($("#fecha_inicio").val(),$("#fecha_termino").val());
		}else{
			alert("Debe indicar ambas fechas para hacer la busqueda");
		}
	});
}

function busca_inf_diaria(inicio,termino){
	$.ajax({
		type: "GET",
		url: "invocador.php?app=inf_diaria&funcion=busca",
		data: {inicio:inicio,termino:termino},
		success: function(datos){
			try{
				var info = JSON.parse(datos);
				alert(info.mensaje);
				if(info.respuesta = "encontro"){
					//
					$("#tabla_detalle").html(info.contenido).promise().done(function(){
					
						cierra_modal();					
					});
					//location.reload();
				}else{
					cierra_modal();
				}
			}catch(e){
				
				$("#tabla_detalle").html(datos).promise().done(function(){
					
						cierra_modal();					
				});
			}
		}
	});
}

function funciones_busca_variedades_mes(){
	busca_var_por_mes();
}

function busca_var_por_mes(){
	$("#btn_busca_variedad_mes").on("click",function(){
		//
		var arreglo = ['fecha_inicio','fecha_termino'];

		if(!vacios(arreglo)){
			//sigue guardarndo
			modal_espera();
			busca_varxmes($("#fecha_inicio").val(),$("#fecha_termino").val());
		}else{
			alert("Debe indicar fecha de inicio y fin para hacer la busqueda");
		}
	});
}

function busca_varxmes(inicio,fin){
	$.ajax({
		type: "GET",
		url: "invocador.php?app=control_ingreso_variedad&funcion=busca",
		data: {inicio:inicio,termino:fin},
		success: function(datos){
			try{
				var info = JSON.parse(datos);
				alert(info.mensaje);
				if(info.respuesta = "encontro"){
					//
					$("#tabla_detalle").html(info.contenido).promise().done(function(){
					
						cierra_modal();					
					});
					//location.reload();
				}else{
					cierra_modal();
				}
			}catch(e){
				
				$("#tabla_detalle").html(datos).promise().done(function(){
					
						cierra_modal();					
				});
			}
		}
	});
}

function funciones_control_productor_diario(){
	busca_productor_diario();
	imprime_productor_diario();
}

function busca_productor_diario(){
	$("#btn_busca_diario_productor").on("click",function(){
		var arreglo = ['productor_consultar','fecha_inicio','fecha_termino'];

		if(!vacios(arreglo)){
			//sigue guardarndo
			modal_espera();
			ejecuta_busqueda_productor_diario($("#productor_consultar").val(),$("#fecha_inicio").val(),$("#fecha_termino").val());
		}else{
			alert("Debe indicar productor,fecha inicio y fecha termino para hacer la busqueda");
		}
	});
}

function imprime_productor_diario(){
	$("#btn_imprime_diario_productor").on("click",function(){
		var arreglo = ['productor_consultar','fecha_inicio','fecha_termino'];

		if(!vacios(arreglo)){
			//sigue guardarndo
			//modal_espera();
			imprime_busqueda_productor_diario($("#productor_consultar").val(),$("#fecha_inicio").val(),$("#fecha_termino").val());
		}else{
			alert("Debe indicar productor,fecha inicio y fecha termino para hacer la impresion");
		}
	});
}

function ejecuta_busqueda_productor_diario(productor,inicio,fin){
	//
	$.ajax({
		type: "GET",
		url: "invocador.php?app=control_productor_diario&funcion=busca",
		data: {productor:productor,inicio:inicio,fin:fin},
		success: function(datos){
			try{
				var info = JSON.parse(datos);
				alert(info.mensaje);
				if(info.respuesta = "encontro"){
					//
					$("#tabla_detalle").html(info.contenido).promise().done(function(){
					
						cierra_modal();					
					});
					//location.reload();
				}else{
					cierra_modal();
				}
			}catch(e){
				
				$("#tabla_detalle").html(datos).promise().done(function(){
					
						cierra_modal();					
				});
			}
		}
	});
}

function imprime_busqueda_productor_diario(productor,inicio,fin){
	window.open("invocador.php?app=control_productor_diario&funcion=imprime&productor="+productor+"&inicio="+inicio+"&fin="+fin);
}

function funciones_control_ingreso_sociedad(){
	buscar_x_sociedad();
}

function buscar_x_sociedad(){
	$("#btn_busca_rango_sociedad").on("click",function(){
		var arreglo = ['fecha_inicio','fecha_termino'];

		if(!vacios(arreglo)){
			//sigue guardarndo
			modal_espera();
			ejecuta_busqueda_sociedad_diario($("#fecha_inicio").val(),$("#fecha_termino").val());
		}else{
			alert("Debe indicar fecha inicio y fecha termino para hacer la busqueda");
		}
	});
}

function ejecuta_busqueda_sociedad_diario(inicio,fin){
	//
	$.ajax({
		type: "GET",
		url: "invocador.php?app=control_ingreso_sociedad&funcion=busca",
		data: {inicio:inicio,termino:fin},
		success: function(datos){
			try{
				var info = JSON.parse(datos);
				alert(info.mensaje);
				if(info.respuesta = "encontro"){
					//
					$("#tabla_detalle").html(info.contenido).promise().done(function(){
					
						cierra_modal();					
					});
					//location.reload();
				}else{
					cierra_modal();
				}
			}catch(e){
				
				$("#tabla_detalle").html(datos).promise().done(function(){
					
						cierra_modal();					
				});
			}
		}
	});
}

function funciones_control_ingreso_valle(){
	busca_valle();
}

function busca_valle(){
	$("#btn_busca_rango_valle").on("click",function(){
		var arreglo = ['fecha_inicio','fecha_termino'];

		if(!vacios(arreglo)){
			//sigue guardarndo
			modal_espera();
			ejecuta_busqueda_valle_diario($("#fecha_inicio").val(),$("#fecha_termino").val());
		}else{
			alert("Debe indicar fecha inicio y fecha termino para hacer la busqueda");
		}
	});
}

function ejecuta_busqueda_valle_diario(inicio,fin){
	//
	$.ajax({
		type: "GET",
		url: "invocador.php?app=control_ingreso_valle&funcion=busca",
		data: {inicio:inicio,termino:fin},
		success: function(datos){
			try{
				var info = JSON.parse(datos);
				alert(info.mensaje);
				if(info.respuesta = "encontro"){
					//
					$("#tabla_detalle").html(info.contenido).promise().done(function(){
					
						cierra_modal();					
					});
					//location.reload();
				}else{
					cierra_modal();
				}
			}catch(e){
				
				$("#tabla_detalle").html(datos).promise().done(function(){
					
						cierra_modal();					
				});
			}
		}
	});
}