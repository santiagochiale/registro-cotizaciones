<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-6">
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

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
                        <form id="formDatosCotizacion" method="post" action="<?php echo site_url('/DevelAdmin')?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <select class="form-control select2" id="id_cliente" name="id_cliente" style="width: 100%;">
                                                <option class="selected"></option>
                                                <?php if (!empty($clientes)) : ?>
                                                    <?php foreach ($clientes as $cliente): ?>
                                                        <option value="<?php echo $cliente['id_cliente']?>" <?php if (!empty($filtros['id_cliente']) && $filtros['id_cliente']==$cliente['id_cliente']) : ?>selected<?php endif; ?>><?php echo $cliente['nombre_cliente']?></option>
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
                                                    <?php foreach ($estados_cotizacion as $EC): ?>
                                                        <option value="<?php echo $EC['id_estado_coti']?>" <?php if (!empty($filtros['id_estado_coti']) && $filtros['id_estado_coti']==$EC['id_estado_coti']) : ?>selected<?php endif; ?>><?php echo $EC['estado_cotizacion']?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="numero_cotizacion">Numero cotización</label>
                                            <input type="text" name="numero_cotizacion" class="form-control" id="numero_cotizacion" placeholder="Numero cotización" <?php if (!empty($filtros['numero_cotizacion'])) : ?>value="<?php echo $filtros['numero_cotizacion']?>"<?php endif?> />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Fecha cotización</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="fecha_cotizacion" id="fecha_cotizacion" value="<?php if (!empty($filtros['fecha_cotizacion'])) : ?><?php echo $filtros['fecha_cotizacion']?><?php endif?>" />
                                                <div class="input-group-append" data-target="#fecha_cotizacion" >
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
                                                    <?php foreach ($productos as $producto): ?>
                                                        <option value="<?php echo $producto['id_producto']?>" <?php if (!empty($filtros['id_producto']) && $filtros['id_producto']==$producto['id_producto']) : ?>selected<?php endif; ?>><?php echo $producto['descripcion_producto']?></option>
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
                                                    <?php foreach ($monedas as $moneda): ?>
                                                        <option value="<?php echo $moneda['id_moneda']?>" <?php if (!empty($filtros['id_moneda_coti']) && $filtros['id_moneda_coti']==$moneda['id_moneda']) : ?>selected<?php endif; ?>><?php echo $moneda['moneda']?></option>
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
                                                    <?php foreach ($monedas as $moneda): ?>
                                                        <option value="<?php echo $moneda['id_moneda']?>" <?php if (!empty($filtros['id_moneda_pres']) && $filtros['id_moneda_pres']==$moneda['id_moneda']) : ?>selected<?php endif; ?>><?php echo $moneda['moneda']?></option>
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
                                                    <?php foreach ($estados_oc as $estado_oc): ?>
                                                        <option value="<?php echo $estado_oc['id_estado_oc']?>" <?php if (!empty($filtros['id_estado_oc']) && $filtros['id_estado_oc']==$estado_oc['id_estado_oc']) : ?>selected<?php endif; ?>><?php echo $estado_oc['estado_oc']?></option>
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
                                                    <?php foreach ($empresas as $empresa): ?>
                                                        <option value="<?php echo $empresa['id_empresa']?>" <?php if (!empty($filtros['id_empresas']) && $filtros['id_empresas']==$empresa['id_empresa']) : ?>selected<?php endif; ?>><?php echo $empresa['empresa']?></option>
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
                                                <input type="text" class="form-control" id="fecha_oc" name="fecha_oc" value="<?php if (!empty($filtros['fecha_oc'])) : ?><?php echo $filtros['fecha_oc']?><?php endif?>" />
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
                                                    <?php foreach ($estados_produccion as $EP): ?>
                                                        <option value="<?php echo $EP['id_estado-produccion']?>" <?php if (!empty($filtros['id_estado_produccion']) && $filtros['id_estado_produccion']==$EP['id_estado-produccion']) : ?>selected<?php endif; ?>><?php echo $EP['estado_produccion']?></option>
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
                                <button type="submit" class="btn btn-primary">Submit</button>
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
        <?php if (!empty($submit)) : ?>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="col-lg-12 col-12">
                        <!-- small box -->
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h3><?php echo $cantidad_cotizaciones ?></h3>
                                <p>TOTALES</p>
                            </div>
                            <?php
                                $url = 'DevelAdmin/resumen_cotizaciones';
                                if (!empty($filtros) && count($filtros)>0){
                                    $url .= '?';
                                    foreach ($filtros as $key => $value){
                                        $url.= $key.'='.$value.'&';
                                    }
                                    $url = substr($url, 0, -1);
                                }
    //                            var_dump($filtros, $url); exit;

                            ?>

                            <a href="<?php echo site_url($url)?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- Small boxes (Stat box) -->

            <div class="row">
                <div class="col-lg-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h2>Ganadas $</h2>
                            <p class="mb-0">Cantidad</p>
                            <h3><?php echo isset($data_dashboard['$']['GANADA']['cantidad'])?number_format($data_dashboard['$']['GANADA']['cantidad'], 0, ',', '.'):'-' ?></h3>
                            <p class="mb-0">Facturación</p>
                            <div class="align-items-center">
                                <h4><?php echo isset($data_dashboard['$']['GANADA']['facturacion'])?('$ '.number_format($data_dashboard['$']['GANADA']['facturacion'], 2, ',', '.')):'-' ?></h4>
                            </div>
                            <p class="mb-0">Cmg</p>
                            <div class="align-items-center">
                                <h4><?php echo isset($data_dashboard['$']['GANADA']['cmg_moneda'])?('$ '.number_format($data_dashboard['$']['GANADA']['cmg_moneda'], 2, ',', '.')):'-' ?></h4>
                                <h5><?php echo !empty($data_dashboard['$']['GANADA']['facturacion']) && isset($data_dashboard['$']['GANADA']['cmg_moneda'])?(number_format($data_dashboard['$']['GANADA']['cmg_moneda'] / $data_dashboard['$']['GANADA']['facturacion'] * 100, 2, ',', '.').'%'):'-' ?></h5>
                            </div>
                        </div>
                        <div class="icon">
                            <i class="font-weight-bolder">
                                <bold><?php echo isset($data_dashboard['$']['GANADA']['porcentaje'])?number_format($data_dashboard['$']['GANADA']['porcentaje'], 0, ',', '').' %':'-' ?></bold>
                            </i>
                        </div>
                        <?php if (isset($data_dashboard['$']['GANADA']['facturacion'])) : ?>
                            <a href="<?php echo site_url('/DevelAdmin/resumen_cotizaciones?id_estado_coti='.$data_dashboard['$']['GANADA']['id_estado_coti'].'&id_moneda_coti='.$data_dashboard['$']['GANADA']['id_moneda_coti'])?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <?php endif;?>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h2>Ganadas u$d</h2>
                            <p class="mb-0">Cantidad</p>
                            <h3><?php echo isset($data_dashboard['USD']['GANADA']['cantidad'])?number_format($data_dashboard['USD']['GANADA']['cantidad'], 0, ',', '.'):'-' ?></h3>
                            <p class="mb-0">Facturación</p>
                            <div class="align-items-center">
                                <h4><?php echo isset($data_dashboard['USD']['GANADA']['facturacion'])?('USD '.number_format($data_dashboard['USD']['GANADA']['facturacion'], 2, ',', '.')):'-' ?></h4>
                            </div>
                            <p class="mb-0">Cmg</p>
                            <div class="align-items-center">
                                <h4><?php echo isset($data_dashboard['USD']['GANADA']['cmg_moneda'])?('USD '.number_format($data_dashboard['USD']['GANADA']['cmg_moneda'], 2, ',', '.')):'-' ?></h4>
                                <h5><?php echo !empty($data_dashboard['USD']['GANADA']['facturacion']) && isset($data_dashboard['USD']['GANADA']['cmg_moneda'])?(number_format($data_dashboard['USD']['GANADA']['cmg_moneda'] / $data_dashboard['USD']['GANADA']['facturacion'] * 100, 2, ',', '.').'%'):'-' ?></h5>
                            </div>
                        </div>
                        <div class="icon">
                            <i class="font-weight-bolder">
                                <bold><?php echo isset($data_dashboard['USD']['GANADA']['porcentaje'])?number_format($data_dashboard['USD']['GANADA']['porcentaje'], 0, ',', '').' %':'-' ?></bold>
                            </i>
                        </div>
                        <?php if (isset($data_dashboard['USD']['GANADA']['facturacion'])) : ?>
                            <a href="<?php echo site_url('/DevelAdmin/resumen_cotizaciones?id_estado_coti='.$data_dashboard['USD']['GANADA']['id_estado_coti'].'&id_moneda_coti='.$data_dashboard['USD']['GANADA']['id_moneda_coti'])?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h2>En concurso $</h2>
                            <p class="mb-0">Facturación</p>
                            <div class="align-items-center">
                                <h4><?php echo isset($data_dashboard['$']['EN CONCURSO']['facturacion'])?('$ '.number_format($data_dashboard['$']['EN CONCURSO']['facturacion'], 2, ',', '.')):'-' ?></h4>
                            </div>
                            <p class="mb-0">Cmg</p>
                            <div class="align-items-center">
                                <h4><?php echo isset($data_dashboard['$']['EN CONCURSO']['cmg_moneda'])?('$ '.number_format($data_dashboard['$']['EN CONCURSO']['cmg_moneda'], 2, ',', '.')):'-' ?></h4>
                                <h5><?php echo !empty($data_dashboard['$']['EN CONCURSO']['facturacion']) && isset($data_dashboard['$']['EN CONCURSO']['cmg_moneda'])?(number_format($data_dashboard['$']['EN CONCURSO']['cmg_moneda'] / $data_dashboard['$']['EN CONCURSO']['facturacion'] * 100, 2, ',', '.').'%'):'-' ?></h5>
                            </div>
                        </div>
                        <div class="icon">
                            <i class="font-weight-bolder">
                                <bold><?php echo isset($data_dashboard['$']['EN CONCURSO']['porcentaje'])?number_format($data_dashboard['$']['EN CONCURSO']['porcentaje'], 0, ',', '').' %':'-' ?></bold>
                            </i>
                        </div>
                        <?php if (isset($data_dashboard['$']['EN CONCURSO']['facturacion'])) : ?>
                            <a href="<?php echo site_url('/DevelAdmin/resumen_cotizaciones?id_estado_coti='.$data_dashboard['$']['EN CONCURSO']['id_estado_coti'].'&id_moneda_coti='.$data_dashboard['$']['EN CONCURSO']['id_moneda_coti'])?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <?php endif;?>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h2>En concurso u$d</h2>
                            <p class="mb-0">Facturación</p>
                            <div class="align-items-center">
                                <h4><?php echo isset($data_dashboard['USD']['EN CONCURSO']['facturacion'])?('USD '.number_format($data_dashboard['USD']['EN CONCURSO']['facturacion'], 2, ',', '.')):'-' ?></h4>
                            </div>
                            <p class="mb-0">Cmg</p>
                            <div class="align-items-center">
                                <h4><?php echo isset($data_dashboard['USD']['EN CONCURSO']['cmg_moneda'])?('USD '.number_format($data_dashboard['USD']['EN CONCURSO']['cmg_moneda'], 2, ',', '.')):'-' ?></h4>
                                <h5><?php echo !empty($data_dashboard['USD']['EN CONCURSO']['facturacion']) && isset($data_dashboard['USD']['EN CONCURSO']['cmg_moneda'])?(number_format($data_dashboard['USD']['EN CONCURSO']['cmg_moneda'] / $data_dashboard['USD']['EN CONCURSO']['facturacion'] * 100, 2, ',', '.').'%'):'-' ?></h5>
                            </div>
                        </div>
                        <div class="icon">
                            <i class="font-weight-bolder">
                                <bold><?php echo isset($data_dashboard['USD']['EN CONCURSO']['porcentaje'])?number_format($data_dashboard['USD']['EN CONCURSO']['porcentaje'], 0, ',', '').' %':'-' ?></bold>
                            </i>
                        </div>
                        <?php if (isset($data_dashboard['USD']['EN CONCURSO']['facturacion'])) : ?>
                            <a href="<?php echo site_url('/DevelAdmin/resumen_cotizaciones?id_estado_coti='.$data_dashboard['USD']['EN CONCURSO']['id_estado_coti'].'&id_moneda_coti='.$data_dashboard['USD']['EN CONCURSO']['id_moneda_coti'])?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h2>Perdidas $</h2>
                            <p class="mb-0">Facturación</p>
                            <div class="align-items-center">
                                <h4><?php echo isset($data_dashboard['$']['PERDIDA']['facturacion'])?('$ '.number_format($data_dashboard['$']['PERDIDA']['facturacion'], 2, ',', '.')):'-' ?></h4>
                            </div>
                            <p class="mb-0">Cmg</p>
                            <div class="align-items-center">
                                <h4><?php echo isset($data_dashboard['$']['PERDIDA']['cmg_moneda'])?('$ '.number_format($data_dashboard['$']['PERDIDA']['cmg_moneda'], 2, ',', '.')):'-' ?></h4>
                                <h5><?php echo !empty($data_dashboard['$']['PERDIDA']['facturacion']) && isset($data_dashboard['$']['PERDIDA']['cmg_moneda'])?(number_format($data_dashboard['$']['PERDIDA']['cmg_moneda'] / $data_dashboard['$']['PERDIDA']['facturacion'] * 100, 2, ',', '.').'%'):'-' ?></h5>
                            </div>
                        </div>
                        <div class="icon">
                            <i class="font-weight-bolder">
                                <bold><?php echo isset($data_dashboard['$']['PERDIDA']['porcentaje'])?number_format($data_dashboard['$']['PERDIDA']['porcentaje'], 0, ',', '').' %':'-' ?></bold>
                            </i>
                        </div>
                        <?php if (isset($data_dashboard['$']['PERDIDA']['facturacion'])) : ?>
                            <a href="<?php echo site_url('/DevelAdmin/resumen_cotizaciones?id_estado_coti='.$data_dashboard['$']['PERDIDA']['id_estado_coti'].'&id_moneda_coti='.$data_dashboard['$']['PERDIDA']['id_moneda_coti'])?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h2>Perdidas u$d</h2>
                            <p class="mb-0">Facturación</p>
                            <div class="align-items-center">
                                <h4><?php echo isset($data_dashboard['USD']['PERDIDA']['facturacion'])?('USD '.number_format($data_dashboard['USD']['PERDIDA']['facturacion'], 2, ',', '.')):'-' ?></h4>
                            </div>
                            <p class="mb-0">Cmg</p>
                            <div class="align-items-center">
                                <h4><?php echo isset($data_dashboard['USD']['PERDIDA']['cmg_moneda'])?('USD '.number_format($data_dashboard['USD']['PERDIDA']['cmg_moneda'], 2, ',', '.')):'-' ?></h4>
                                <h5><?php echo !empty($data_dashboard['USD']['PERDIDA']['facturacion']) && isset($data_dashboard['USD']['PERDIDA']['cmg_moneda'])?(number_format($data_dashboard['USD']['PERDIDA']['cmg_moneda'] / $data_dashboard['USD']['PERDIDA']['facturacion'] * 100, 2, ',', '.').'%'):'-' ?></h5>
                            </div>
                        </div>
                        <div class="icon">
                            <i class="font-weight-bolder">
                                <bold><?php echo isset($data_dashboard['USD']['PERDIDA']['porcentaje'])?number_format($data_dashboard['USD']['PERDIDA']['porcentaje'], 0, ',', '').' %':'-' ?></bold>
                            </i>
                        </div>
                        <?php if (isset($data_dashboard['USD']['PERDIDA']['facturacion'])) : ?>
                            <a href="<?php echo site_url('/DevelAdmin/resumen_cotizaciones?id_estado_coti='.$data_dashboard['USD']['PERDIDA']['id_estado_coti'].'&id_moneda_coti='.$data_dashboard['USD']['PERDIDA']['id_moneda_coti'])?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        <?php endif; ?>
        <!-- Main row -->
        <?php /*
        <div class="row">
            <!-- Columna facturación -->
            <section class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Facturación
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- Morris chart - Facturación -->
                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Columna facturación -->

            <!-- Columna cantidad -->
            <section class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Cantidad
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- Morris chart - Facturación -->
                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Columna cantidad -->

        </div>
        <?php */ ?>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
    //Date picker
    // $('#fecha_cotizacion').datetimepicker({
    //     format: 'DD/MM/YYYY'
    // });

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