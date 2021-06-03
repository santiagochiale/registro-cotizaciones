$(document).ready(function () {
	"use strict";
	//console.log('prueba carga');
	//$("#username").val();
	var filtros = {
		
	};

	var json = {
			modelo: "ProductosModel",
			filtros: filtros,
	};
	//var json = '{"modelo":"ClientesModel","filtros":[{"id":"2"}]}';

	var jsonString = JSON.stringify(json);

	console.log(json);
	console.log(jsonString);

	$.ajax({
		url: base_url + "crud/encontrar_registro",
		type: "POST",
		data: {'json' : jsonString} ,
		dataType: "json",
	}).done(function (response) {
		console.log("exito");
		//con esto repoblamos el modal para la edicion
		//var responseJP = JSON.parse(response); //esto se recibe con formato Json pero en variable string
		console.log(response);
		/*if(response.length!=11){ //si la longitud del string recibido es 11 quiere decir que vino vacio. Estructura: {"data":[]}
         console.log(responseJP);
        }*/
	});
});
