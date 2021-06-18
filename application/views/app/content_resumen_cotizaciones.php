<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Resumen Cotizaciones</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content prueba commit-->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                  <!--
                    <div class="card-header">
                        <div class="row align-items-center">
                            <span class="card-title">Agregar Producto</span>
                            <button data-toggle="modal" data-target="#modal-edicion" class="btn" id="nuevoProducto"><i class="far fa-plus-square btn"></button></i>
                        </div>
                    </div>--->
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tablaCotizaciones" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Costo</th>
                                    <th>Precio</th>
                                    <th>Margen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->



<script>
    var id_cotizacion = "";
    var modelo = 'RegistroCotizacionesModel';
    var filtros = {};
    var valores = {};
    var valoresSerArray;
    //------------------------------------------funciones propias---------------------------------------
    function toJson(modelo, filtros, valores) {

        if (filtros != null && valores != null) {
            var obj = {
                modelo: modelo,
                filtros: filtros,
                valores: valores
            };
        } else {
            if (filtros != null && valores == null) {
                var obj = {
                    modelo: modelo,
                    filtros: filtros
                };
            } else {
                if (valores != null && filtros == null) {
                    var obj = {
                        modelo: modelo,
                        valores: valores
                    };
                } else {
                    var obj = {
                        modelo: modelo
                    };
                }
            }
        }


        return obj;
    }

    function cargarDataTable() {

        var filtros = {};

        var json = {
            modelo: modelo,
            filtros: filtros
        };

        var jsonString = JSON.stringify(json);
        var urlAjax = "<?php echo base_url() ?>crud/encontrar_registro";
        console.log(jsonString);
        // se carga el datatable con los datos de los productos
        $("#tablaCotizaciones").DataTable({
            "responsive": true,
            "autoWidth": false,
            "lengthChange": true,
            "deferRender": true,
            "retrieve": true,
            "processing": true,
            "paging": true,
            "dom": '<"row"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4"<"dt-buttons btn-group flex-wrap"B>><"col-sm-12 col-md-4"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            "buttons": ["excel", "pdf", "print", "colvis"],
            ajax: ({
                type: 'POST',
                url: urlAjax,
                data: {
                    json: jsonString
                },
                dataType: "json",
                dataSrc: function(json) {
                    //console.log(json.data);
                    return json.data;
                }
            }),
            columns: [{ //aqui se levanta el id de cada fila que se muestra en la tabla para armar los id de los elementos editar y borrar del campo aciones
                    data: function(data) {
                        id_cotizacion = data['id_cotizacion'];
                        return data['id_cotizacion'];
                    }
                },
                {
                    data: 'nombre_cliente'
                },
                {
                    data: 'fecha_cotizacion'
                },
                {
                    data: 'descripcion_producto'
                },
                {
                    data: 'cantidad'
                },
                {
                    data: 'costo'
                },
                {
                    data: 'precio_unitario'
                },
                {
                    data: 'margen'
                },
                {
                    data: null,
                    render: function() {
                        var html = '<div class="btn-group">';
                        html += '<div class = "container">';
                        html += '<button data-toggle=modal data-target=#modal-edicion class="editarProducto btn" id = "editar' + id_cotizacion + '">';
                        html += '<i class= "fas fa-pencil-alt"></i>';
                        html += '</button>';
                        html += '</div>';
                        html += '<div class = "container">';
                        html += '<button data-toggle=modal data-target=#modal-edicion class="editarProducto btn" id = "editar' + id_cotizacion + '">';
                        html += '<i class= "fas fa-pencil-alt"></i>';
                        html += '</button>';
                        html += '</div>';
                        html += '<div class = "container" style = "margin: 0">';
                        html += '<button class= "borrarProducto btn" id= "borrar' + id_cotizacion + '">';
                        html += '<i class= "far fa-trash-alt"></i>';
                        html += '</button>';
                        html += '</div>';
                        html += '</div>';
                        return html;
                    }//TODO: agregar botonos de ver mas. Estos botonos llevaran a otra pagina
                }
            ]
        });
    }

    cargarDataTable();
    //-------------------------------------------configuración sweet alert-------------------------------------------
    //--------------------------------------------------------------------------------------------------------
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        width: '40rem'
    });
    //----------------------------------------- manejo de eventos------------------------------
    
    //evento que se desata al momento de hacer click en el boton de edición de cada item del datatables
    $('#tablaCotizaciones').on('click', '.editarProducto', function() {
        //console.log('click en edición de producto');
        id = this.id;
        id_cotizacion = id.substring(6); //el id de este elemento es editarxx (xx es el id del proceso) con esta linea se extrae solo el numero
        //con estas lineas se levanta el id a editar
        filtros['id'] = id_cotizacion;
    });
    //evento que se desata al momento de hacer click en el icono de borrar registro
    $('#tablaCotizaciones').on('click', '.borrarProducto', function() {
        //console.log('click en borrar');
        id = this.id;
        id_cotizacion = id.substring(6); //el id de este elemento es borrarxx (xx es el id del proceso) con esta linea se extrae solo el numero

        filtros['id'] = id_cotizacion;
        var peticionJson = new toJson(modelo, filtros, null);
        var peticionJsonString = JSON.stringify(peticionJson);
        //console.log(peticionJsonString);
        var urlAjax = "<?php echo base_url() ?>crud/encontrar_registro";

        $.ajax({
            type: 'POST',
            url: urlAjax,
            data: {
                json: peticionJsonString
            }
        }).done(function(response) {
            var responseJP = JSON.parse(response);
            var data = responseJP['data'][0];
            //console.log(data.nombre_maquina);
            Swal.fire({
                title: 'Desea eliminar el siguiente registro?' + data.descripcion_producto,
                text: "Luego de aceptar no podra revertir la acción.",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, borrar'
            }).then((result) => {
                if (result.value) {
                    var urlAjax = "<?php echo base_url() ?>crud/borrar_registro";
                    console.log(peticionJsonString);
                    $.ajax({
                            type: 'POST',
                            url: urlAjax,
                            data: {
                                json: peticionJsonString
                            }
                        })
                        .done(function(response) {
                            var responseJP = JSON.parse(response);
                            //var data = responseJP['data'][0];
                            console.log(responseJP);
                            if (responseJP.code == 200) {
                                $('#tablaCotizaciones').DataTable().ajax.reload();
                                Toast.fire({
                                    type: 'success',
                                    title: 'Registro borrado'
                                });
                                cargarDataTable();
                            }
                        })
                        .fail(function(response) { //)
                            Swal.fire({
                                type: 'error',
                                title: 'Ups..',
                                text: 'Algo salio mal! Error: ' + responseJP.message_error
                            });
                        });
                }
            });

        });

    });
    
</script>