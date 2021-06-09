<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listado Productos</h1>
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
                    <div class="card-header">
                        <div class="row align-items-center">
                            <span class="card-title">Agregar Producto</span>
                            <button data-toggle="modal" data-target="#modal-edicion" class="btn" id="nuevoProducto"><i class="far fa-plus-square btn"></button></i>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tablaProductos" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Producto</th>
                                    <th>Grupo</th>
                                    <th>Material SAP</th>
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

<!------------------------------------MODALES DE EDICIÓN-------------------------------->
<div class="modal fade" id="modal-edicion" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Productos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <!-- jquery validation -->

                    <!-- form start -->
                    <form id="formProductos">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="descripcion_producto">Producto</label>
                                <input type="text" name="descripcion_producto" class="form-control" id="descripcion_producto" placeholder="Descripción">
                            </div>
                            <div class="form-group">
                                <label>Grupo</label>
                                <select class="form-control select2" id="id_grupo" name="id_grupo" style="width: 100%;">
                                    <option class="selected"></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cod_sap">Material</label>
                                <input type="text" name="cod_sap" class="form-control" id="cod_sap" placeholder="Codigo SAP">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    var id_producto = "";
    var modelo = 'ProductosModel';
    var filtros = {};
    var valores = {};
    var validationBk;
    var valoresSerArray;
    
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
                type: 'warning',
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
                    Toast.fire({
                        type: 'success',
                        title: 'Registro insertado'
                    });
                }
                if (responseJP.code == 200 && responseJP.validation_errors == "Registro Modificado") {
                    $('#modal-edicion').modal('hide');
                    cargarDataTable();
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