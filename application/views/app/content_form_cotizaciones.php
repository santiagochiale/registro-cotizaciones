<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?php echo $prueba ?></h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content prueba commit-->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <!--columna de ingreso de datos-->
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="formDatosCotizacion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <select class="form-control select2" id="id_cliente" name="id_cliente" style="width: 100%;">
                                                <option class="selected"></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="numero_cotizacion">Numero cotización</label>
                                            <input type="text" name="numero_cotizacion" class="form-control" id="numero_cotizacion" placeholder="Numero cotización">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Estado Cotización</label>
                                            <select class="form-control select2" id="id_estado_coti" name="id_estado_coti" style="width: 100%;">
                                                <option class="selected"></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Fecha cotización</label>
                                            <div class="input-group date" id="fecha_cotizacion" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#fecha_cotizacion">
                                                <div class="input-group-append" data-target="#fecha_cotizacion" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Producto</label>
                                    <select class="form-control select2" id="id_producto" name="id_producto" style="width: 100%;">
                                        <option class="selected"></option>
                                        <!--TODO: al seleccionar el producto se debe guardar en la base de datos el grupo y el cod sap-->
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="text" name="cantidad" class="form-control" id="cantidad" placeholder="Cantidad">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Moneda de cotización</label>
                                            <select class="form-control select2" id="id_moneda_coti" name="id_moneda_coti" style="width: 100%;">
                                                <option class="selected"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Moneda de presentación</label>
                                            <select class="form-control select2" id="id_moneda_pres" name="id_moneda_pres" style="width: 100%;">
                                                <option class="selected"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="valor_dolar">Valor dolar</label>
                                            <input type="text" name="valor_dolar" class="form-control" id="valor_dolar" placeholder="Costo">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="costo">Costo</label>
                                            <input type="text" name="costo" class="form-control" id="costo" placeholder="Costo">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="precio_unitario">Precio unitario</label>
                                            <input type="text" name="precio_unitario" class="form-control" id="precio_unitario" placeholder="Precio unitario">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Estado OC</label>
                                            <select class="form-control select2" id="id_estado_oc" name="id_estado_oc" style="width: 100%;">
                                                <option class="selected"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Ganador</label>
                                            <select class="form-control select2" id="id_empresas" name="id_empresas" style="width: 100%;">
                                                <option class="selected"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="precio_ganador">Precio ganador</label>
                                            <input type="text" name="precio_ganador" class="form-control" id="precio_ganador" placeholder="Precio ganador">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Fecha OC</label>
                                            <div class="input-group date" id="fecha_oc" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#fecha_oc">
                                                <div class="input-group-append" data-target="#fecha_oc" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Estado Producción</label>
                                            <select class="form-control select2" id="id_estado_produccion" name="id_estado_produccion" style="width: 100%;">
                                                <option class="selected"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="cantidad_entregada">Cantidad entregada</label>
                                            <input type="text" name="cantidad_entregada" class="form-control" id="cantidad_entregada" placeholder="Cantidad entregada">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-6">
                <!--columna de muestra de resultados-->
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="formResultadoCotizacion">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            $ 5.857.528
                                        </span>
                                        <span class="text-muted">FACTURACIÓN</span>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            $ 2.580.698
                                        </span>
                                        <span class="text-muted">COSTO TOTAL</span>
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold">
                                                    25%
                                                </span>
                                                <span class="text-muted">MARGEN</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold">
                                                    $ 589.254
                                                </span>
                                                <span class="text-muted">IMPUESTOS</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold">
                                                    $ 2.687.576
                                                </span>
                                                <span class="text-muted">CMG $</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold">
                                                   20 %
                                                </span>
                                                <span class="text-muted">CMG %</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold">
                                                   Unitec Blue S.A
                                                </span>
                                                <span class="text-muted">GANADOR</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold">
                                                   $50.48
                                                </span>
                                                <span class="text-muted">Precio Ganador</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold">
                                                   1
                                                </span>
                                                <span class="text-muted">Margen/UB</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold">
                                                   500.000
                                                </span>
                                                <span class="text-muted">Cantidad pendiente</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                        </form>
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
    //Date picker
    $('#fecha_cotizacion').datetimepicker({
        format: 'L'
    });

    $('#fecha_oc').datetimepicker({
        format: 'L'
    });



    var id_producto = "";
    var modelo = 'ProductosModel';
    var filtros = {};
    var valores = {};
    var validationBk;
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
            modelo: "ProductosModel",
            filtros: filtros
        };

        var jsonString = JSON.stringify(json);
        var urlAjax = "<?php echo base_url() ?>crud/encontrar_registro";

        // se carga el datatable con los datos de los productos
        $("#tablaProductos").DataTable({
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
                        id_producto = data['id_producto'];
                        return data['id_producto'];
                    }
                },
                {
                    data: 'descripcion_producto'
                },
                {
                    data: 'descripcion_grupo'
                },
                {
                    data: 'cod_sap'
                },
                {
                    data: null,
                    render: function() {
                        var html = '<div class="btn-group">';
                        html += '<div class = "container">';
                        html += '<button data-toggle=modal data-target=#modal-edicion class="editarProducto btn" id = "editar' + id_producto + '">';
                        html += '<i class= "fas fa-pencil-alt"></i>';
                        html += '</button>';
                        html += '</div>';
                        html += '<div class = "container" style = "margin: 0">';
                        html += '<button class= "borrarProducto btn" id= "borrar' + id_producto + '">';
                        html += '<i class= "far fa-trash-alt"></i>';
                        html += '</button>';
                        html += '</div>';
                        html += '</div>';
                        return html;
                    }
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
    //evento que se desata al momento de hacer click en "agregar producto"
    $('#nuevoProducto').on('click', function(e) {
        //console.log('click en agregar prodcuto');
        id_producto = "";
        delete filtros['id'];
        delete valores['id'];

        //TODO: no mostrar valores de la ultima edición cuando se agrega un nuevo registro
    });
    //evento que se desata al momento de hacer click en el boton de edición de cada item del datatables
    $('#tablaProductos').on('click', '.editarProducto', function() {
        //console.log('click en edición de producto');
        id = this.id;
        id_producto = id.substring(6); //el id de este elemento es editarxx (xx es el id del proceso) con esta linea se extrae solo el numero
        //con estas lineas se levanta el id a editar
        filtros['id'] = id_producto;
    });
    //evento que se desata al momento de hacer click en el icono de borrar registro
    $('#tablaProductos').on('click', '.borrarProducto', function() {
        //console.log('click en borrar');
        id = this.id;
        id_producto = id.substring(6); //el id de este elemento es borrarxx (xx es el id del proceso) con esta linea se extrae solo el numero

        filtros['id'] = id_producto;
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
                                $('#tablaProductos').DataTable().ajax.reload();
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
    //--------------evento luego de mostrar el modal de edición-----------------------------------------
    $('#modal-edicion').on('show.bs.modal', function(e) {
        //{"modelo":"ProductosModel","valores":{"id":"26","descripcion_producto":"tarjetas nuevas","id_grupo":"2","cod_sap":"0000"}}
        //console.log(id_producto);
        var filtrosNull = {};
        var valoresSelect = new toJson(modelo, filtrosNull, null);
        var jsonString = JSON.stringify(valoresSelect);
        //console.log(jsonString);
        var urlAjax = "<?php echo base_url() ?>crud/encontrar_registro";

        $.ajax({
            type: 'POST',
            url: urlAjax,
            data: {
                json: jsonString
            }
        }).done(function(response) {
            var responseJP = JSON.parse(response); //esto se recibe con formato Json pero en variable string
            //console.log(responseJP['data'][0].descripcion_producto);

            $.each(responseJP['data'], function(key, valor) {
                $("#id_grupo").append(`<option id=${valor.id_producto} value=${valor.id_grupo}>${valor.descripcion_grupo}</option>`);
            });
        });

        if (id_producto != "") { //si el id no es vacio, quiere decir que es una edición del registro y no una inserción

            var valoresSelect = new toJson(modelo, filtros, null)
            var jsonString = JSON.stringify(valoresSelect);
            $.ajax({
                type: 'POST',
                url: urlAjax,
                data: {
                    json: jsonString
                }
            }).done(function(response) {
                var responseJP = JSON.parse(response); //esto se recibe con formato Json pero en variable string
                //aqui debemos repoblar el modal

                $('#descripcion_producto').val(responseJP['data'][0].descripcion_producto);
                $('#cod_sap').val(responseJP['data'][0].cod_sap);
                /*$.each(responseJP['data'], function(key, valor) {
                    $("#id_grupo").append(`<option id=${valor.id_producto} value=${valor.id_grupo}>${valor.descripcion_grupo}</option>`);
                });*/
                //TODO: mostrar el select que corresponda
            });
        }

    });

    //evento de submit de los datos del formulario de edición
    $('#formProductos').on('submit', function(e) {
        //e.preventDefault();
        //{"modelo":"ProductosModel","valores":[{"id":"26","descripcion_producto":"tarjetas nuevas","id_grupo":"2","cod_sap":"0000"}]}
        //si el id va vacio va al metodo de inserción de registro nuevo, si no al de edicion
        //id_producto = ""; // aqui se selecciona el registro que se quiere modificar. Si esta vacio es una insersión de registro nvo
        //var valores = {};

        valoresSerArray = $(this).serializeArray(); //esto devuelve un array donde cada imdice es un objeto con la forma {name: value}. Name es el nombre del label y value el valor del campo
        //console.log(valoresSerArray);



    });

    //------------------------------------------validación del formulario------------------------------------------
    $.validator.setDefaults({
        submitHandler: function() {
            if (id_producto != "") {
                valores['id'] = id_producto;
            }

            $.each(valoresSerArray, function(key, valor) {
                //console.log(valor.name + ' ' + valor.value);
                valores[valor.name] = valor.value;
            });
            // console.log(valores);
            var jsonObj = new toJson('ProductosModel', null, valores);

            //console.log(JSON.stringify(jsonObj)); //en este punto esta listo el json para enviarse al controlador

            var urlAjax = "<?php echo base_url() ?>crud/guardar_registro";
            $.ajax({
                type: 'POST',
                url: urlAjax,
                data: {
                    json: JSON.stringify(jsonObj)
                }
            }).done(function(response) {
                //con esto repoblamos el modal para la edicion
                var responseJP = JSON.parse(response); //esto se recibe con formato Json pero en variable string
                console.log(responseJP.code);

                if (responseJP.code == 200 && responseJP.validation_errors == "Registro Insertado") {
                    $('#modal-edicion').modal('hide');
                    $('#tablaProductos').DataTable().ajax.reload();
                    Toast.fire({
                        type: 'success',
                        title: 'Registro insertado'
                    });
                }
                if (responseJP.code == 200 && responseJP.validation_errors == "Registro Modificado") {
                    $('#modal-edicion').modal('hide');
                    $('#tablaProductos').DataTable().ajax.reload();
                    Toast.fire({
                        type: 'success',
                        title: 'Registro modificado'
                    });
                }
                if (responseJP.code == 500) {
                    Toast.fire({
                        type: 'error',
                        title: 'Error en la validación de los datos',
                        html: '<div class="alert alert-danger">' + responseJP.validation_errors + '</div>'
                    });
                }

            });

        }
    });
    $('#formProductos').validate({
        rules: {
            descripcion_producto: {
                required: true
            },
            id_grupo: {
                required: true
            },
            cod_sap: {
                required: true
            },
        },
        messages: {
            descripcion_producto: {
                required: "Por favor complete el campo"
            },
            id_grupo: {
                required: "Por favor complete el campo"
            },
            cod_sap: "Por favor complete el campo"
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
</script>