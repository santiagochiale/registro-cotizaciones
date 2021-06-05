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

<script>
    var id_producto;
    var filtros = {};

    var json = {
        modelo: "ProductosModel",
        filtros: filtros,
    };

    var jsonString = JSON.stringify(json);
    var urlAjax = "<?php echo base_url() ?>crud/encontrar_registro";
    console.log(urlAjax);


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
                console.log(json.data);
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
                    html += '<button class= "borrarCliente btn" id= "borrar' + id_producto + '">';
                    html += '<i class= "far fa-trash-alt"></i>';
                    html += '</button>';
                    html += '</div>';
                    html += '</div>';
                    return html;
                }
            }
        ]
    });


    //cargarDatatableProductos();

    function cargarDatatableProductos() {
        var filtros = {};

        var json = {
            modelo: "ProductosModel",
            filtros: filtros,
        };

        var jsonString = JSON.stringify(json);
        var urlAjax = "<?php echo base_url() ?>crud/encontrar_registro";
        console.log(urlAjax);

        $('#tablaProductos').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],

            ajax: {
                type: 'POST',
                url: urlAjax,
                data: {
                    json: jsonString
                },
                dataType: "json",
                dataSrc: function(json) {
                    console.log(json.data);
                    return json.data;
                }
            },
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
                        html += '<button class= "borrarCliente btn" id= "borrar' + id_producto + '">';
                        html += '<i class= "far fa-trash-alt"></i>';
                        html += '</button>';
                        html += '</div>';
                        html += '</div>';
                        return html;
                    }
                }
            ]
        }).buttons().container().appendTo('#tablaProductos .col-md-6:eq(0)');

        //TODO: agregar botones de exportacion y sel de columnas
    }
</script>