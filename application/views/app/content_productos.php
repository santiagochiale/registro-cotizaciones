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
                            <button data-toggle="modal" data-target="#modal-edicion" class="btn" id="nuevoProducto"><i class="far fa-plus-square"></button></i>
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
                                    <option class="selected">--</option>
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
    var id_producto;
    var filtros = {};

    var json = {
        modelo: "ProductosModel",
        filtros: filtros,
    };

    var jsonString = JSON.stringify(json);
    var urlAjax = "<?php echo base_url() ?>crud/encontrar_registro";
    //console.log(urlAjax);
    console.log(jsonString);
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
                    html += '<button data-toggle="modal" data-target="#modal-edicion" class = "editarProducto btn" id = "editar' + id_producto + '">';
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

    //--------------evento luego de mostrar el modal de edición-----------------------------------------
    $('#modal-edicion').on('show.bs.modal', function(e) {
        id_producto = ""; // aqui se selecciona el registro que se quiere modificar. Si esta vacio es una insersión de registro nvo
        var filtros = {

        };
        /*
        var json = {
            modelo: "ProductosModel",
            filtros: filtros,
        };*/

        var modelo = 'ProductosModel';

        var valoresSelect = new toJson(modelo, filtros)

        var jsonString = JSON.stringify(valoresSelect);

        //console.log(jsonString);
        var urlAjax = "<?php echo base_url() ?>crud/encontrar_registro";
        if (id_producto == "") { //si el id no es vacio, quiere decir que es una edición del registro y no una inserción
            //ajax para traer el registro seleccionado y repoblar el formulario
            $.ajax({
                type: 'POST',
                url: urlAjax,
                data: {
                    json: jsonString
                }
            }).done(function(response) {
                //con esto repoblamos el modal para la edicion
                var responseJP = JSON.parse(response); //esto se recibe con formato Json pero en variable string
                //console.log(responseJP['data'][0].descripcion_producto);

                $.each(responseJP['data'], function(key, valor) {
                    $("#id_grupo").append(`<option id=${valor.id_producto} value=${valor.id_grupo}>${valor.descripcion_producto}</option>`);
                    //console.log(valor.descripcion_producto);
                    //console.log(valor.id_producto);

                });
            });
        }

    });

    //evento de submit de los datos del formulario de edición
    $('#formProductos').on('submit', function(e) {
        e.preventDefault();
        //{"modelo":"ProductosModel","valores":[{"id":"26","descripcion_producto":"tarjetas nuevas","id_grupo":"2","cod_sap":"0000"}]}
        //si el id va vacio va al metodo de inserción de registro nuevo, si no al de edicion
        id_producto = ""; // aqui se selecciona el registro que se quiere modificar. Si esta vacio es una insersión de registro nvo
        var valores = {};

        var valoresSerArray = $(this).serializeArray(); //esto devuelve un array donde cada imdice es un objeto con la forma {name: value}. Name es el nombre del label y value el valor del campo
        //console.log(valoresSerArray);

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
           // var responseJP = JSON.parse(response); //esto se recibe con formato Json pero en variable string
            console.log(response);

        });

    });

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
</script>