<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Impuestos</h1>
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
                            <span class="card-title">Agregar Impuesto</span>
                            <button data-toggle="modal" data-target="#modal-edicion" class="btn" id="nuevoImpuesto"><i class="far fa-plus-square btn"></button></i>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tablaImpuesto" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Impuesto</th>
                                    <th>Valor</th>
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
                <h4 class="modal-title">Impuesto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <!-- jquery validation -->

                    <!-- form start -->
                    <form id="formImpuesto">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="impuesto">Impuesto</label>
                                <input type="text" name="impuesto" class="form-control" id="impuesto" placeholder="Descripción Impuesto">
                            </div>
                            <div class="form-group">
                                <label for="valor_impuesto">Impuesto</label>
                                <input type="text" name="valor_impuesto" class="form-control" id="valor_impuesto" placeholder="Valor">
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
    var id_impuesto = "";
    var modelo = 'ImpuestosModel';
    var filtros = {};
    var valores = {};
   // var validationBk;
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
        var urlAjax = "<?php echo base_url() ?>index.php/Crud/encontrar_registro";
       // console.log(jsonString);
        // se carga el datatable con los datos de los 
        $("#tablaImpuesto").DataTable({
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
                        id_impuesto = data['id_impuesto'];
                        return data['id_impuesto'];
                    }
                },
                {
                    data: 'impuesto'
                },
                {
                    data: 'valor_impuesto'
                },
                {
                    data: null,
                    render: function() {
                        var html = '<div class="btn-group">';
                        html += '<div class = "container">';
                        html += '<button data-toggle=modal data-target=#modal-edicion class="editarGrupo btn" id = "editar' + id_impuesto + '">';
                        html += '<i class= "fas fa-pencil-alt"></i>';
                        html += '</button>';
                        html += '</div>';
                        html += '<div class = "container" style = "margin: 0">';
                        html += '<button class= "borrarGrupo btn" id= "borrar' + id_impuesto + '">';
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
    //evento que se desata al momento de hacer click en "agregar registro"
    $('#nuevoImpuesto').on('click', function(e) {
        
        id_impuesto = "";
        delete filtros['id'];
        delete valores['id'];

        //TODO: no mostrar valores de la ultima edición cuando se agrega un nuevo registro
        
    });
    //evento que se desata al momento de hacer click en el boton de edición de cada item del datatables
    $('#tablaImpuesto').on('click', '.editarGrupo', function() {
        //console.log('click en edición de registro');
        id = this.id;
        id_impuesto = id.substring(6); //el id de este elemento es editarxx (xx es el id del proceso) con esta linea se extrae solo el numero
        //con estas lineas se levanta el id a editar
        filtros['id'] = id_impuesto;
    });
    //evento que se desata al momento de hacer click en el icono de borrar registro
    $('#tablaImpuesto').on('click', '.borrarGrupo', function() {
        //console.log('click en borrar');
        id = this.id;
        id_impuesto = id.substring(6); //el id de este elemento es borrarxx (xx es el id del proceso) con esta linea se extrae solo el numero

        filtros['id'] = id_impuesto;
        var peticionJson = new toJson(modelo, filtros, null);
        var peticionJsonString = JSON.stringify(peticionJson);
        //console.log(peticionJsonString);
        var urlAjax = "<?php echo base_url() ?>index.php/Crud/encontrar_registro";

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
                title: 'Desea eliminar el siguiente registro?' + data.impuesto,
                text: "Luego de aceptar no podra revertir la acción.",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, borrar'
            }).then((result) => {
                if (result.value) {
                    var urlAjax = "<?php echo base_url() ?>index.php/Crud/borrar_registro";
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
                                $('#tablaImpuesto').DataTable().ajax.reload();
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
        //{"modelo":"EstadoModel","valores":{"id":"26","estado_cotizacion":"tarjetas nuevas","id_grupo":"2","cod_sap":"0000"}}
        //console.log(id_estado_coti);
        var urlAjax = "<?php echo base_url() ?>index.php/Crud/encontrar_registro";
        
        console.log(id_impuesto);
        if (id_impuesto != "") { //si el id no es vacio, quiere decir que es una edición del registro y no una inserción
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

                $('#impuesto').val(responseJP['data'][0].impuesto);
                $('#valor_impuesto').val(responseJP['data'][0].valor_impuesto);
                /*$.each(responseJP['data'], function(key, valor) {
                    $("#id_grupo").append(`<option id=${valor.id_estado_coti} value=${valor.id_grupo}>${valor.descripcion_grupo}</option>`);
                });*/
                //TODO: mostrar el select que corresponda
            });
        }

    });

    //evento de submit de los datos del formulario de edición
    $('#formImpuesto').on('submit', function(e) {
        //e.preventDefault();
        //{"modelo":"EstadoModel","valores":[{"id":"26","estado_cotizacion":"tarjetas nuevas","id_grupo":"2","cod_sap":"0000"}]}
        //si el id va vacio va al metodo de inserción de registro nuevo, si no al de edicion
        //id_estado_coti = ""; // aqui se selecciona el registro que se quiere modificar. Si esta vacio es una insersión de registro nvo
        //var valores = {};

        valoresSerArray = $(this).serializeArray(); //esto devuelve un array donde cada imdice es un objeto con la forma {name: value}. Name es el nombre del label y value el valor del campo
        //console.log(valoresSerArray);



    });

    //------------------------------------------validación del formulario------------------------------------------
    $.validator.setDefaults({
        submitHandler: function() {
            if (id_impuesto != "") {
                valores['id'] = id_impuesto;
            }

            $.each(valoresSerArray, function(key, valor) {
                //console.log(valor.name + ' ' + valor.value);
                valores[valor.name] = valor.value;
            });
            // console.log(valores);
            var jsonObj = new toJson(modelo, null, valores);

            console.log(JSON.stringify(jsonObj)); //en este punto esta listo el json para enviarse al controlador

            var urlAjax = "<?php echo base_url() ?>index.php/Crud/guardar_registro";
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
                    $('#tablaImpuesto').DataTable().ajax.reload();
                    Toast.fire({
                        type: 'success',
                        title: 'Registro insertado'
                    });
                }
                if (responseJP.code == 200 && responseJP.validation_errors == "Registro Modificado") {
                    $('#modal-edicion').modal('hide');
                    $('#tablaImpuesto').DataTable().ajax.reload();
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
    $('#formImpuesto').validate({
        rules: {
            impuesto: {
                required: true
            },
            valor_impuesto: {
                required: true
            }
        },
        messages: {
            impuesto: {
                required: "Por favor complete el campo"
            },
            valor_impuesto: {
                required: "Por favor complete el campo"
            }
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