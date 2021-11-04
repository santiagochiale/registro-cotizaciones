<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1></h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content prueba commit-->

<section class="content">
    <div class="container-fluid">
        <?php if (!empty($incompleto)) : ?>
        <div class="row">
            <div class="col-md-12">
                <h4 style="color: red;"><strong>Faltan datos</strong>. No se ha guardado la cotización por estar incompleto el formulario</h4>
            </div>
        </div>
        <?php endif ?>
        <div class="row">
            <div class="col-6">
                <!--columna de ingreso de datos-->
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="formDatosCotizacion" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <select class="form-control select2" id="id_cliente" name="id_cliente" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($clientes)) : ?>
                                                <?php foreach ($clientes as $cliente): ?>
                                                    <option value="<?php echo $cliente['id_cliente']?>" <?php if (!empty($data_cotizacion['id_cliente']) && $data_cotizacion['id_cliente']==$cliente['id_cliente']): ?> selected <?php endif?>><?php echo $cliente['nombre_cliente']?></option>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="numero_cotizacion">Numero cotización</label>
                                            <input type="text" name="numero_cotizacion" class="form-control" id="numero_cotizacion" placeholder="Numero cotización" <?php if (!empty($data_cotizacion['numero_cotizacion'])): ?> value="<?php echo $data_cotizacion['numero_cotizacion'] ?>" <?php endif?>  />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Estado Cotización</label>
                                            <select class="form-control select2" id="id_estado_coti" name="id_estado_coti" style="width: 100%;" >
                                                <option class="selected"></option>
                                                <?php if (!empty($estados_cotizacion)) : ?>
                                                    <?php foreach ($estados_cotizacion as $EC): ?>
                                                        <option value="<?php echo $EC['id_estado_coti']?>" <?php if (!empty($data_cotizacion['id_estado_coti']) && $data_cotizacion['id_estado_coti']==$EC['id_estado_coti']): ?> selected <?php endif?>><?php echo $EC['estado_cotizacion']?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Fecha cotización</label>
                                            <div class="input-group date" id="fecha_cotizacion" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#fecha_cotizacion" name="fecha_cotizacion" <?php if (!empty($data_cotizacion['fecha_cotizacion'])): ?> value="<?php echo date('d/m/Y', strtotime(str_replace('-', '/', $data_cotizacion['fecha_cotizacion']))) ?>" <?php endif?>  />
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
                                        <?php if (!empty($productos)) : ?>
                                            <?php foreach ($productos as $producto): ?>
                                                <option value="<?php echo $producto['id_producto']?>" <?php if (!empty($data_cotizacion['id_producto']) && $data_cotizacion['id_producto']==$producto['id_producto']): ?> selected <?php endif?>><?php echo $producto['descripcion_producto']?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <!--TODO: al seleccionar el producto se debe guardar en la base de datos el grupo y el cod sap-->
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="text" name="cantidad" class="form-control" id="cantidad" placeholder="Cantidad" <?php if (!empty($data_cotizacion['cantidad'])): ?> value="<?php echo $data_cotizacion['cantidad'] ?>" <?php endif?>  />
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Moneda de cotización</label>
                                            <select class="form-control select2" id="id_moneda_coti" name="id_moneda_coti" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($monedas)) : ?>
                                                    <?php foreach ($monedas as $moneda): ?>
                                                        <option value="<?php echo $moneda['id_moneda']?>" <?php if (!empty($data_cotizacion['id_moneda_coti']) && $data_cotizacion['id_moneda_coti']==$moneda['id_moneda']): ?> selected <?php endif?>><?php echo $moneda['moneda']?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Moneda de presentación</label>
                                            <select class="form-control select2" id="id_moneda_pres" name="id_moneda_pres" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($monedas)) : ?>
                                                    <?php foreach ($monedas as $moneda): ?>
                                                        <option value="<?php echo $moneda['id_moneda']?>" <?php if (!empty($data_cotizacion['id_moneda_pres']) && $data_cotizacion['id_moneda_pres']==$moneda['id_moneda']): ?> selected <?php endif?>><?php echo $moneda['moneda']?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="valor_dolar">Valor dolar</label>
                                            <input type="text" name="valor_dolar" class="form-control" id="valor_dolar" placeholder="Valor dólar" <?php if (!empty($data_cotizacion['valor_dolar'])): ?> value="<?php echo $data_cotizacion['valor_dolar'] ?>" <?php endif?>  />
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="costo">Costo</label>
                                            <input type="text" name="costo" class="form-control" id="costo" placeholder="Costo" <?php if (!empty($data_cotizacion['costo'])): ?> value="<?php echo $data_cotizacion['costo'] ?>" <?php endif?>  />
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="precio_unitario">Precio unitario</label>
                                            <input type="text" name="precio_unitario" class="form-control" id="precio_unitario" placeholder="Precio unitario" <?php if (!empty($data_cotizacion['precio_unitario'])): ?> value="<?php echo $data_cotizacion['precio_unitario'] ?>" <?php endif?>  />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Estado OC</label>
                                            <select class="form-control select2" id="id_estado_oc" name="id_estado_oc" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($estados_oc)) : ?>
                                                    <?php foreach ($estados_oc as $estado_oc): ?>
                                                        <option value="<?php echo $estado_oc['id_estado_oc']?>" <?php if (!empty($data_cotizacion['id_estado_oc']) && $data_cotizacion['id_estado_oc']==$estado_oc['id_estado_oc']): ?> selected <?php endif?>><?php echo $estado_oc['estado_oc']?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Ganador</label>
                                            <select class="form-control select2" id="id_empresas" name="id_empresas" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($empresas)) : ?>
                                                    <?php foreach ($empresas as $empresa): ?>
                                                        <option value="<?php echo $empresa['id_empresa']?>" <?php if (!empty($data_cotizacion['id_empresas']) && $data_cotizacion['id_empresas']==$empresa['id_empresa']): ?> selected <?php endif?>><?php echo $empresa['empresa']?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="precio_ganador">Precio ganador</label>
                                            <input type="text" name="precio_ganador" class="form-control" id="precio_ganador" placeholder="Precio ganador" <?php if (!empty($data_cotizacion['precio_ganador'])): ?> value="<?php echo $data_cotizacion['precio_ganador'] ?>" <?php endif?>  />
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Fecha OC</label>
                                            <div class="input-group date" id="fecha_oc" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#fecha_oc" name="fecha_oc" <?php if (!empty($data_cotizacion['fecha_oc'])): ?> value="<?php echo date('d/m/Y', strtotime(str_replace('-', '/', $data_cotizacion['fecha_oc']))) ?>" <?php endif?> />
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
                                                <?php if (!empty($estados_produccion)) : ?>
                                                    <?php foreach ($estados_produccion as $EP): ?>
                                                        <option value="<?php echo $EP['id_estado-produccion']?>" <?php if (!empty($data_cotizacion['id_estado_produccion']) && $data_cotizacion['id_estado_produccion']==$EP['id_estado-produccion']): ?> selected <?php endif?>><?php echo $EP['estado_produccion']?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="cantidad_entregada">Cantidad entregada</label>
                                            <input type="text" name="cantidad_entregada" class="form-control" id="cantidad_entregada" placeholder="Cantidad entregada" <?php if (isset($data_cotizacion['cantidad_entregada'])): ?> value="<?php echo $data_cotizacion['cantidad_entregada'] ?>" <?php endif?>  />
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
                                        <span class="font-weight-bold" id="span_facturacion">
                                            -
                                        </span>
                                        <span class="text-muted">FACTURACIÓN</span>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold" id="span_costo_total">
                                            -
                                        </span>
                                        <span class="text-muted">COSTO TOTAL</span>
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold" id="span_margen">
                                                    -
                                                </span>
                                                <span class="text-muted">MARGEN</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold" id="span_impuestos">
                                                    -
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
                                                <span class="font-weight-bold" id="span_cmg_moneda">
                                                    -
                                                </span>
                                                <span class="text-muted">CMG $</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold" id="span_cmg_porcentaje">
                                                    -
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
                                                <span class="font-weight-bold" id="span_ganador">
                                                    -
                                                </span>
                                                <span class="text-muted">GANADOR</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold" id="span_precio_ganador">
                                                    -
                                                </span>
                                                <span class="text-muted">Precio Ganador</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold" id="span_margen_sobreUB">
                                                    -
                                                </span>
                                                <span class="text-muted">Margen/UB</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column text-right">
                                                <span class="font-weight-bold" id="span_cantidad_pendiente">
                                                    -
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
        format: 'DD/MM/YYYY'
    });

    $('#fecha_oc').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    var id_cotizacion = "";
    var modelo = 'RegistroCotizacionesModel';
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

    function actualizarpreview(){


        let data = {};
        data.cantidad = $('input#cantidad').val()
        data.precio_unitario = $('input#precio_unitario').val()
        data.costo = $('input#costo').val()
        data.precio_ganador = $('input#precio_ganador').val()
        data.cantidad_entregada = $('input#cantidad_entregada').val()
        data.moneda_cotizacion = $('select#id_moneda_coti option:selected').text()
        data.moneda_presentacion = $('select#id_moneda_pres option:selected').text()
        data.valor_dolar = $('#valor_dolar').val()

        let ganador = $('select#id_empresas option:selected').text();
        $('span#span_ganador').text($('select#id_empresas').val()!=''?ganador:'-')

        // console.log(data); return ;
        $.post("<?php echo base_url() ?>index.php/DevelAdmin/calcular_facturacion_costo", data, function(response){

            $('span#span_facturacion').text(response.facturacion?response.facturacion:'-')
            $('span#span_costo_total').text(response.costo_total?response.costo_total:'-')
            $('span#span_margen').text(typeof(response.margen)!='undefined'?response.margen:'-')
            $('span#span_impuestos').text(response.impuestos?response.impuestos:'-')
            $('span#span_cmg_moneda').text(response.cmg_moneda?response.cmg_moneda:'-')
            $('span#span_cmg_porcentaje').text(response.cmg_porcentaje?response.cmg_porcentaje:'-')
            $('span#span_margen_sobreUB').text(response.margen_sobreUB?response.margen_sobreUB:'-')
            $('span#span_cantidad_pendiente').text(response.cantidad_pendiente?response.cantidad_pendiente:'-')
            $('span#span_precio_ganador').text(response.precio_ganador?response.precio_ganador:'-');

        }, 'json')
    }
    //función al cargar la pagina
    $(document).ready(function() {
        actualizarpreview()
        console.log('cargado');

        //{"modelo":"ProductosModel","valores":{"id":"26","descripcion_producto":"tarjetas nuevas","id_grupo":"2","cod_sap":"0000"}}
        //console.log(id_producto);
        var filtrosNull = {};
        var valoresSelect = new toJson(modelo, filtrosNull, null);
        var jsonString = JSON.stringify(valoresSelect);
        var urlAjax = "<?php echo base_url() ?>index.php/Crud/encontrar_registro";
        
        // $.ajax({
        //     type: 'POST',
        //     url: urlAjax,
        //     data: {
        //         json: jsonString
        //     }
        // }).done(function(response) {
        //     var responseJP = JSON.parse(response); //esto se recibe con formato Json pero en variable string
        //     //console.log(responseJP['data'][0].descripcion_producto);
        //
        //     $.each(responseJP['data'], function(key, valor) {
        //         console.log(valor);
        //         $("#id_cliente").append(`<option id=${valor.id_cliente} value=${valor.id_cliente}>${valor.nombre_cliente}</option>`);
        //         $("#id_estado_coti").append(`<option id=${valor.id_estado_coti} value=${valor.id_estado_coti}>${valor.estado_cotizacion}</option>`);
        //         $("#id_producto").append(`<option id=${valor.id_producto} value=${valor.id_producto}>${valor.descripcion_producto}</option>`);
        //         $("#id_moneda_coti").append(`<option id=${valor.id_moneda_coti} value=${valor.id_moneda_coti}>${valor.moneda}</option>`);
        //         $("#id_moneda_pres").append(`<option id=${valor.id_moneda_pres} value=${valor.id_moneda_pres}>${valor.moneda}</option>`);
        //         $("#id_empresas").append(`<option id=${valor.id_empresas} value=${valor.id_empresas}>${valor.empresa}</option>`);
        //     });
        // });

        if (id_cotizacion != "") { //si el id no es vacio, quiere decir que es una edición del registro y no una inserción

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
                /*
                $('#descripcion_producto').val(responseJP['data'][0].descripcion_producto);
                $('#cod_sap').val(responseJP['data'][0].cod_sap);
                /*$.each(responseJP['data'], function(key, valor) {
                    $("#id_grupo").append(`<option id=${valor.id_producto} value=${valor.id_grupo}>${valor.descripcion_grupo}</option>`);
                });*/
                //TODO: mostrar el select que corresponda
            });
        }

        $(document).on('keyup', 'input#cantidad, input#precio_unitario, input#costo, input#precio_ganador, input#cantidad_entregada, input#valor_dolar', function(){
            actualizarpreview();
        })

        $(document).on('change', 'select#id_empresas, select#id_moneda_coti, select#id_moneda_pres', function(){
            actualizarpreview()
        })

        /*$(document).on('keyup', 'input#precio_ganador', function(){
            let data = {}
            data.valor = $(this).val()
            data.cantidad_decimales = 2
            data.tipo = 'money'
            $.post("<?php echo base_url() ?>index.php/DevelAdmin/formatear_nro", data, function(response){
                if (response){
                    $('span#span_precio_ganador').text(response);
                }

            })
        })*/


    });


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
                title: 'Desea eliminar el siguiente registro?' + data.descripcion_producto,
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