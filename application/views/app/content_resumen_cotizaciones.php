<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Filtros</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <span class="card-title">Buscador de operaciones-Si desea ver todas las operaciones solo oprima "Buscar" en la parte inferior</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="formDatosCotizacion" method="post" action="<?php echo site_url('/DevelAdmin/resumen_cotizaciones') ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <select class="form-control select2" id="id_cliente" name="id_cliente" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($clientes)) : ?>
                                                    <?php foreach ($clientes as $cliente) : ?>
                                                        <option value="<?php echo $cliente['id_cliente'] ?>" <?php if (!empty($filtros['id_cliente']) && $filtros['id_cliente'] == $cliente['id_cliente']) : ?>selected<?php endif; ?>><?php echo $cliente['nombre_cliente'] ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Estado Cotización</label>
                                            <select class="form-control select2" id="id_estado_coti" name="id_estado_coti" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($estados_cotizacion)) : ?>
                                                    <?php foreach ($estados_cotizacion as $EC) : ?>
                                                        <option value="<?php echo $EC['id_estado_coti'] ?>" <?php if (!empty($filtros['id_estado_coti']) && $filtros['id_estado_coti'] == $EC['id_estado_coti']) : ?>selected<?php endif; ?>><?php echo $EC['estado_cotizacion'] ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="numero_cotizacion">Numero cotización</label>
                                            <input type="text" name="numero_cotizacion" class="form-control" id="numero_cotizacion" placeholder="Numero cotización" <?php if (!empty($filtros['numero_cotizacion'])) : ?>value="<?php echo $filtros['numero_cotizacion'] ?>" <?php endif ?> />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Fecha cotización</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="fecha_cotizacion" data-target="#fecha_cotizacion" name="fecha_cotizacion" value="<?php if (!empty($filtros['fecha_cotizacion'])) : ?><?php echo $filtros['fecha_cotizacion'] ?><?php endif ?>" />
                                                <div class="input-group-append" data-target="#fecha_cotizacion">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Producto</label>
                                            <select class="form-control select2" id="id_producto" name="id_producto" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($productos)) : ?>
                                                    <?php foreach ($productos as $producto) : ?>
                                                        <option value="<?php echo $producto['id_producto'] ?>" <?php if (!empty($filtros['id_producto']) && $filtros['id_producto'] == $producto['id_producto']) : ?>selected<?php endif; ?>><?php echo $producto['descripcion_producto'] ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <!--TODO: al seleccionar el producto se debe guardar en la base de datos el grupo y el cod sap-->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Moneda de cotización</label>
                                            <select class="form-control select2" id="id_moneda_coti" name="id_moneda_coti" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($monedas)) : ?>
                                                    <?php foreach ($monedas as $moneda) : ?>
                                                        <option value="<?php echo $moneda['id_moneda'] ?>" <?php if (!empty($filtros['id_moneda_coti']) && $filtros['id_moneda_coti'] == $moneda['id_moneda']) : ?>selected<?php endif; ?>><?php echo $moneda['moneda'] ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Moneda de presentación</label>
                                            <select class="form-control select2" id="id_moneda_pres" name="id_moneda_pres" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($monedas)) : ?>
                                                    <?php foreach ($monedas as $moneda) : ?>
                                                        <option value="<?php echo $moneda['id_moneda'] ?>" <?php if (!empty($filtros['id_moneda_pres']) && $filtros['id_moneda_pres'] == $moneda['id_moneda']) : ?>selected<?php endif; ?>><?php echo $moneda['moneda'] ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!--                                    <div class="col-4">-->
                                    <!--                                        <div class="form-group">-->
                                    <!--                                            <label for="cantidad">Cantidad</label>-->
                                    <!--                                            <input type="text" name="cantidad" class="form-control" id="cantidad" placeholder="Cantidad">-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->

                                    <!--                                    <div class="col-4">-->
                                    <!--                                        <div class="form-group">-->
                                    <!--                                            <label for="valor_dolar">Valor dolar</label>-->
                                    <!--                                            <input type="text" name="valor_dolar" class="form-control" id="valor_dolar" placeholder="Costo">-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                    <!--                                    <div class="col-4">-->
                                    <!--                                        <div class="form-group">-->
                                    <!--                                            <label for="costo">Costo</label>-->
                                    <!--                                            <input type="text" name="costo" class="form-control" id="costo" placeholder="Costo">-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                    <!--                                    <div class="col-4">-->
                                    <!--                                        <div class="form-group">-->
                                    <!--                                            <label for="precio_unitario">Precio unitario</label>-->
                                    <!--                                            <input type="text" name="precio_unitario" class="form-control" id="precio_unitario" placeholder="Precio unitario">-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Estado OC</label>
                                            <select class="form-control select2" id="id_estado_oc" name="id_estado_oc" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($estados_oc)) : ?>
                                                    <?php foreach ($estados_oc as $estado_oc) : ?>
                                                        <option value="<?php echo $estado_oc['id_estado_oc'] ?>" <?php if (!empty($filtros['id_estado_oc']) && $filtros['id_estado_oc'] == $estado_oc['id_estado_oc']) : ?>selected<?php endif; ?>><?php echo $estado_oc['estado_oc'] ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Ganador</label>
                                            <select class="form-control select2" id="id_empresas" name="id_empresas" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($empresas)) : ?>
                                                    <?php foreach ($empresas as $empresa) : ?>
                                                        <option value="<?php echo $empresa['id_empresa'] ?>" <?php if (!empty($filtros['id_empresas']) && $filtros['id_empresas'] == $empresa['id_empresa']) : ?>selected<?php endif; ?>><?php echo $empresa['empresa'] ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!--                                    <div class="col-4">-->
                                    <!--                                        <div class="form-group">-->
                                    <!--                                            <label for="precio_ganador">Precio ganador</label>-->
                                    <!--                                            <input type="text" name="precio_ganador" class="form-control" id="precio_ganador" placeholder="Precio ganador">-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Fecha OC</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="fecha_oc" data-target="#fecha_oc" name="fecha_oc" value="<?php if (!empty($filtros['fecha_oc'])) : ?><?php echo $filtros['fecha_oc'] ?><?php endif ?>" />
                                                <div class="input-group-append" data-target="#fecha_oc">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Estado Producción</label>
                                            <select class="form-control select2" id="id_estado_produccion" name="id_estado_produccion" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($estados_produccion)) : ?>
                                                    <?php foreach ($estados_produccion as $EP) : ?>
                                                        <option value="<?php echo $EP['id_estado-produccion'] ?>" <?php if (!empty($filtros['id_estado_produccion']) && $filtros['id_estado_produccion'] == $EP['id_estado-produccion']) : ?>selected<?php endif; ?>><?php echo $EP['estado_produccion'] ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!--                                    <div class="col-4">-->
                                    <!--                                        <div class="form-group">-->
                                    <!--                                            <label for="cantidad_entregada">Cantidad entregada</label>-->
                                    <!--                                            <input type="text" name="cantidad_entregada" class="form-control" id="cantidad_entregada" placeholder="Cantidad entregada">-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Buscar</button>
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

    <?php if (!empty($filtros)) : ?>
        <?php foreach ($filtros as $key => $value) : ?>
            filtros.<?php echo $key ?> = '<?php echo $value ?>'
        <?php endforeach; ?>
    <?php endif; ?>

    function cargarDataTable() {

        // var filtros = {};

        var json = {
            modelo: modelo,
            filtros: filtros
        };

        var jsonString = JSON.stringify(json);
        var urlAjax = "<?php echo base_url() ?>index.php/Crud/encontrar_registro";
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
                        // html += '<div class = "container">';
                        // html += '<button data-toggle=modal data-target=#modal-edicion class="editarProducto btn" id = "editar' + id_cotizacion + '">';
                        // html += '<i class= "fas fa-pencil-alt"></i>';
                        // html += '</button>';
                        // html += '</div>';
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
                    } //TODO: agregar botonos de ver mas. Estos botonos llevaran a otra pagina
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
        console.log(id)
        window.location = '<?php echo site_url() ?>/DevelAdmin/form_cotizaciones/' + id_cotizacion;
    });
    //evento que se desata al momento de hacer click en el icono de borrar registro
    $('#tablaCotizaciones').on('click', '.borrarProducto', function() {
        //console.log('click en borrar');
        id = this.id;
        id_cotizacion = id.substring(6); //el id de este elemento es borrarxx (xx es el id del proceso) con esta linea se extrae solo el numero

        filtros['id'] = id_cotizacion;
        // var peticionJson = new toJson(modelo, filtros, null);
        // var peticionJsonString = JSON.stringify(peticionJson);
        //console.log(peticionJsonString);
        Swal.fire({
            title: 'Desea eliminar la cotización id ' + id_cotizacion + '?',
            text: "Luego de aceptar no podra revertir la acción.",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, borrar'
        }).then((result) => {

            if (result.value) {

                $.ajax({
                        type: 'POST',
                        url: '<?php echo site_url() ?>/DevelAdmin/delete_cotizaciones/' + id_cotizacion,
                        dataType: 'json'
                    })
                    .done(function(response) {
                        console.log(response)

                        if (response.success) {
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
                            text: 'Algo salio mal! Error: ' + response.message
                        });
                    });


            }
        });

    });

    $('#fecha_cotizacion').daterangepicker({
        opens: 'left',
        locale: {
            format: 'DD/MM/YYYY'
        },
        autoUpdateInput: false,
    }, function(start, end, label) {
        $('#fecha_cotizacion').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'))
    });

    $('#fecha_oc').daterangepicker({
        opens: 'left',
        locale: {
            format: 'DD/MM/YYYY'
        },
        autoUpdateInput: false,
    }, function(start, end, label) {
        $('#fecha_oc').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'))
    });
</script>