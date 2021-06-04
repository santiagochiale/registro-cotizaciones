$(document).ready(function () {
	
	("use strict");
	//console.log('prueba carga');
	//$("#username").val();
	var filtros = {
		id: 2,
	};

	var json = {
		modelo: "ProductosModel",
		filtros: filtros,
	};
	//var json = '{"modelo":"ClientesModel","filtros":[{"id":"2"}]}';

	var jsonString = JSON.stringify(json);

	/*console.log(json);
	console.log(jsonString);
	*/

	$.ajax({
		url: base_url + "crud/encontrar_registro",
		type: "POST",
		data: { json: jsonString },
		dataType: "json",
	}).done(function (response) {
		//console.log("exito");
		var responseData = response.data[0]; //se crea un array con todos los datos de la respuesta
		//$('#nombre_turno').val(data.nombre_turno);
		//$('#horario_turno').val(data.horario_turno);
		//con esto repoblamos el modal para la edicion
		//var responseJP = JSON.parse(response.data); //esto se recibe con formato Json pero en variable string
		//console.log(responseData["descripcion_producto"]);
		/*if(response.length!=11){ //si la longitud del string recibido es 11 quiere decir que vino vacio. Estructura: {"data":[]}
         console.log(responseJP);
        }*/
	});
});
