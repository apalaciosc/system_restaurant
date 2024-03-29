<input type="hidden" id="moneda" value="<?php echo $_SESSION["moneda"]; ?>"/>
<input type="hidden" id="cod_m" value="<?php echo $_GET['m']; ?>"/>
<input type="hidden" id="cod_p" value="<?php echo $_GET['Cod']; ?>"/>
<input type="hidden" id="cod_tipe" value="<?php echo $_SESSION["cod_tipe"]; ?>"/>
<input type="hidden" id="rol_usr" value="<?php echo $_SESSION["rol_usr"]; ?>"/>

<div class="row">
    <div class="col-lg-5" style="padding: 0px !important;">
        <div class="mail-box-header title-pink">
            <div class="pull-right mail-search btn-imp"></div>
            <div style="margin:5px 0;width:10px;" class="pull-right"></div>
            <div class="pull-right mail-search btn-imp2"></div>
            <h2><i id="ico-ped"></i> <span class="mes_dg"></span></h2>
        </div>
        <div class="mail-box-header border-top" style="border-top: 1px solid #c4c4c4;">
            <div class="row">
                <div class="col-sm-8">
                    <p>Cliente: <strong class="cli_dg"></strong> - <i class="fa fa-calendar"></i> <span class="fec_dg"></span> <i class="fa fa-clock-o"></i> <span class="hor_dg"></span></p>
                </div>
                <div class="col-sm-4 text-right bc" style="display: none; margin-top: -5px;">
                    <input type="hidden" name="cod_p" id="cod_p" value="<?php echo $_GET['Cod']; ?>"/>
                    <button class="btn btn-md btn-primary animated wobble" id="btn-confirmar"><i class="fa fa-location-arrow"></i>&nbsp;CONFIRMAR</button>
                </div>
            </div>
        </div>
        <div class="mail-box scroll_izq">
            <ul id="pedido-detalle" class="sortable-list agile-list" style="display: none;"></ul>
            <table class="table table-hover table-mail" id="table-pedidos" style="margin-bottom: 0px;" width="100%">
                <thead class="li-c">
                    <tr>
                        <td class="check-mail li-c">Cant.</td>
                        <td class="mail-contact">Producto</td>
                        <td class="text-right mail-date">P.U.</td>
                        <td class="text-right mail-date">Total</td>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="mail-box" style="padding: 10px; background: #fcfcfc">
            <div class="row">
                <div class="col-sm-4">
                    <div class="descriptive-icon text-left">
                        <span class="icon"><i class="fa fa-money fa-2x"></i></span>
                        <div class="text">
                            <span id="totalPagar"></span><span>por pagar</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                <?php if($_SESSION["rol_usr"] <> 4) { ?>
                    <div class="text-right opc1" style="display: none">
                        <button type="button" class="btn btn-success" onclick="facturar(<?php echo $_GET['Cod']; ?>,2);"><i class="fa fa-files-o"></i>&nbsp;Dividir Cuenta</button>
                        <button type="button" class="btn btn-lg btn-primary" onclick="facturar(<?php echo $_GET['Cod']; ?>,1);"><i class="fa fa-file-o"></i>&nbsp;Cuenta</button>
                    </div>
                <?php } ?>
                    <div class="text-right opc2" style="display: none">
                        <button type="button" class="btn btn-danger" onclick="desocuparMesa(<?php echo $_GET['Cod']; ?>);"><i class="fa fa-sign-out"></i>&nbsp;Desocupar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 border-left" style="padding: 0px !important;">
        <div class="ibox-content" style="background: #e5e5e5;  border-bottom: 1px solid #72be98;">
            <div class="row">
                <div class="col-sm-12">
                    <div class="has-success">
                    <div class="input-group">
                        <input type="text" name="busq_prod" id="busq_prod" class="form-control ui-autocomplete-input" placeholder="Buscar producto..." autocomplete="off">
                        <span class="input-group-btn">
                            <button class="btn btn btn-primary"> <i class="fa fa-search"></i></button>
                        </span>
                    </div>
                    </div>
                </div>
            </div> 
        </div>
        <ul class="nav nav-tabs" id="list-catgrs"></ul>
        <div class="tab-content" style="padding: 8px !important">
            <div id="tab-1" class="tab-pane active">
                <div class="row scroll_der" id="list-prods">
                    <div class="panel panel-transparent text-center">
                        <div class="row">
                            <div class="col-sm-8 col-sm-push-2">
                                <br><br><br>
                                <i class="fa fa-long-arrow-up fa-3x"></i>
                                <h2 class="ich m-t-none">Selecciona una Categor&iacute;a</h2>
                                <p class="ng-binding">Para poder agregar productos a la lista</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-facturar" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form id="frm-facturar" method="post" enctype="multipart/form-data" class="frm-facturar">
        <input type="hidden" name="cod_pedido" id="cod_pedido">
        <input type="hidden" name="tipoEmision" id="tipoEmision">
        <input type="hidden" name="totalPed" id="totalPed">
        <input type="hidden" name="total_pedido" id="total_pedido">
            <div class="modal-header mh" id="hhb">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title mt"><strong>CERRAR MESA</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="sortable-list connectList agile-list">
                            <li class="list-group-item lihds">
                                <strong>LISTA DE PEDIDOS:</strong>
                            </li>
                            <div class="scroll_content" id="list-items"></div>
                            <li class="warning-element lisbt" id="sbt" style="display: none;">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9">
                                        <strong>SubTotal</strong>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <div class="text-right">
                                            <strong><?php echo $_SESSION["moneda"]; ?><span id="t_sbt">0.00</span></strong>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="warning-element lides" id="desc" style="display: none;">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="text-left">
                                            <span class="form-control txtlbl">Descuento</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="text-left">
                                            <div class="has-warning">
                                                <div class="input-group ent">
                                                    <input type="text" name="porcentaje" id="porcentaje" class="form-control" placeholder="" autocomplete="off" />
                                                    <span class="input-group-addon">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="text-right">
                                            <div class="has-warning">
                                                <div class="input-group dec">
                                                    <span class="input-group-addon"><?php echo $_SESSION["moneda"]; ?></span>
                                                    <input type="text" name="m_desc" id="m_desc" class="form-control" placeholder="" autocomplete="off" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="sortable-list connectList agile-list">
                            <li class="list-group-item lihds">
                                <strong>PAGO:</strong>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tipo Pago</label>
                                    <select name="tipo_pago" id="tipo_pago" class="selectpicker show-tick form-control" data-live-search-style="begins" data-live-search="true" title="Seleccionar" autocomplete="off">
                                        <option value="1">EFECTIVO</option>
                                        <option value="2">TARJETA</option>
                                        <option value="3">AMBOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tipo Documento</label>
                                    <select name="tipo_doc" id="tipo_doc" class="selectpicker show-tick form-control" data-live-search-style="begins" data-live-search="true" title="Seleccionar" autocomplete="off">
                                        <option value="1">BOLETA</option>
                                        <option value="2">FACTURA</option>
                                        <option value="3">TICKET</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6" id="pe" style="display: none;">
                                <div class="form-group">
                                    <div class="input-group dec">
                                        <span class="input-group-addon"><?php echo $_SESSION["moneda"]; ?></span>
                                        <input type="text" name="pago_e" id="pago_e" class="form-control" placeholder="Efectivo" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" id="pt" style="display: none;">
                                <div class="form-group">
                                    <div class="input-group dec">
                                        <span class="input-group-addon"><?php echo $_SESSION["moneda"]; ?></span>
                                        <input type="text" name="pago_t" id="pago_t" class="form-control" placeholder="Tarjeta" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Cliente</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">    
                                            <button type="button" class="btn btn-primary" onclick="nuevoCliente();"><i class="fa fa-plus"></i></button>
                                        </span>
                                        <input type="hidden" name="cliente_id" id="cliente_id" value="1"/>
                                        <input type="text" name="busq_cli" id="busq_cli" class="form-control" placeholder="Ingrese DNI/RUC del cliente" autocomplete="off" />
                                        <span class="input-group-btn">
                                            <button id="btnClienteLimpiar" class="btn btn-danger" type="button">
                                                <span class="fa fa-remove"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="nombre_c" id="nombre_c" class="form-control" autocomplete="off" value="P&Uacute;BLICO GENERAL" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="sortable-list agile-list">
                            <li class="litot-i">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9">
                                        <strong>TOTAL</strong>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <div class="text-right">
                                            <strong><?php echo $_SESSION["moneda"]; ?><span class="totalP" id="total"></span></strong>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="sortable-list agile-list">
                            <li class="litot-d">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9">
                                        <strong>VUELTO</strong>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <div class="text-right">
                                            <strong><?php echo $_SESSION["moneda"]; ?><span id="vuelto">0.00</span></strong>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="text-left">
                            <span class="btn btn-warning-2" onclick="porcentajeTotal();">%</span>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="text-right">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Volver</button>
                            <button type="submit" class="btn btn-primary" id="btn-fact"><i class="fa fa-save"></i> Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-nuevo-cliente" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInTop">
            <div class="modal-header mhs-e">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="mt">Nuevo Cliente</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input name="tipo_docc" type="radio" value="1" id="td_dni" class="flat-red" checked="true"> DNI
                                &nbsp;
                            <input name="tipo_docc" type="radio" value="2" id="td_ruc" class="flat-red"> RUC
                        </div>
                    </div>
                    <div class="col-lg-6" id="f_dni" style="display: block;">
                        <form method="post" id="form_consultadni">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="dni_numero" id="dni_numero" class="form-control" placeholder="Ingrese DNI" autocomplete="off" />
                                    <span class="input-group-btn">
                                        <button id="btnBuscar" class="btn btn-primary" type="submit"><span class="fa fa-search"></span></button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6" id="f_ruc" style="display: none;">
                        <form method="post" id="form_consultaruc">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="ruc_numero" id="ruc_numero" class="form-control" placeholder="Ingrese RUC" autocomplete="off" />
                                    <span class="input-group-btn">
                                        <button id="btnBuscar" class="btn btn-primary" type="submit"><span class="fa fa-search"></span></button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <form method="post" id="form_c">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6" id="d_ruc" style="display: none;">
                                <div class="form-group">
                                    <label>RUC</label>
                                    <input type="text" name="ruc" id="ruc" data-mask="99999999999" class="form-control" placeholder="Ingrese ruc" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>DNI</label>
                                    <input type="text" name="dni" id="dni" data-mask="99999999" class="form-control" placeholder="Ingrese dni" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-lg-6" id="d_nombres" style="display: block;">
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Ingrese nombres" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-lg-6" id="d_apep" style="display: block;">
                                <div class="form-group">
                                    <label>Apellido Paterno</label>
                                    <input type="text" name="ape_paterno" id="ape_paterno" class="form-control" placeholder="Ingrese apellido paterno" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-6" id="d_apem" style="display: block;">
                                <div class="form-group">
                                    <label>Apellido Materno</label>
                                    <input type="text" name="ape_materno" id="ape_materno" class="form-control" placeholder="Ingrese apellido materno" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-6" id="d_fecha" style="display: block;">
                                <div class="form-group">
                                    <label>Fecha de Nacimiento</label>
                                    <input type="text" name="fecha_nac" id="fecha_nac" data-mask="99-99-9999" class="form-control" placeholder="Ingrese fecha de nacimiento" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-6" id="d_telefono" style="display: block;">
                                <div class="form-group">
                                    <label>Tel&eacute;fono</label>
                                    <input type="text" name="telefono" id="telefono" data-mask="999999999" class="form-control" placeholder="Ingrese tel&eacute;fono" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-12" id="d_correo" style="display: block;">
                                <div class="form-group">
                                    <label>Correo electr&oacute;nico</label>
                                    <input type="text" name="correo" id="correo" class="form-control" placeholder="Ingrese correo electr&oacute;nico" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="d_rs" style="display: none;">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Raz&oacute;n Social</label>
                            <input type="text" name="razon_social" id="razon_social" class="form-control" placeholder="Ingrese raz&oacute;n social" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Direcci&oacute;n</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese direcci&oacute;n" autocomplete="off" />
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Volver</button>
                <button type="button" class="btn btn-primary" id="RegistrarCliente"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-sub-pedido" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated bounceInRight">
        <form method="post" enctype="multipart/form-data" action="#">
            <div class="modal-header mh-e">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title mt"><strong id="title-caja">Detalle por orden de pedido</strong></h4>
            </div>
            <div class="modal-body">
                <ul class="sortable-list agile-list">
                    <li class="list-group-item li-c">
                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1"><strong>Cant.</strong></div>
                            <div class="col-xs-5 col-sm-6 col-md-6"><strong>Producto</strong></div>
                            <div class="col-xs-4 col-sm-4 col-md-4"><strong>P.U. / Total</strong></div>
                            <div class="col-xs-1 col-sm-1 col-md-1"></div>
                        </div>
                    </li>
                    <div class="scroll_content" id="list-subitems"></div>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Volver</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-cancelar-pedido" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
        <form method="post" enctype="multipart/form-data" action="?c=Inicio&a=CancelarPedido">
            <input type="hidden" name="cod_ped" id="cod_ped">
            <input type="hidden" name="cod_pro" id="cod_pro">
            <input type="hidden" name="fec_ped" id="fec_ped">
            <input type="hidden" name="cod_tipe" value="<?php echo $_SESSION["cod_tipe"]; ?>"/>
            <div class="modal-header mh-p">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <i class="fa fa-times modal-icon"></i>
            </div>
            <div class="modal-body">
                <br><h4><div id="mensaje-e"></div></h4><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Aceptar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-desocupar-mesa" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
        <form method="post" enctype="multipart/form-data" action="?c=Inicio&a=Desocupar">
            <input type="hidden" name="cod_pede" id="cod_pede">
            <input type="hidden" name="cod_tipe" value="<?php echo $_SESSION["cod_tipe"]; ?>"/>
            <div class="modal-header mh-p">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <i class="fa fa-sign-out modal-icon"></i>
            </div>
            <div class="modal-body">
                <br><center><h4>¿Desea desocupar la mesa?</h4></center><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Aceptar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script id="pedido-detalle-template" type="text/x-jsrender" src="">
    <li class="list-group-item" style="background: #666666;color: #ffffff; border-radius: 0px; border: 0px; border-top: 1px solid #e7eaec;">
        <div class="row">
            <div class="col-xs-12 text-left">
                Nuevos pedidos:
            </div>
        </div>
    </li>
    {{for items}}
    <li class="warning-element" style="border-radius: 0px; border: 0px; border-top: 1px solid #e7eaec; border-left: 3px solid #f8ac59">
        <div class="row">
            <input type="hidden" name="producto_id" value="{{:producto_id}}" />
            <input type="hidden" name="precio" value="{{:precio}}"/>
            <div class="col-xs-4 col-md-3 col-sm-3">
                <input class="touchspin1" type="text" value="{{:cantidad}}" name="cantidad" style="text-align: center;" onchange="pedido.actualizar({{:id}}, this);">
            </div>
            <div class="col-xs-5 col-md-6 col-sm-6">
                <span name="producto">{{:producto}}</span><br>
                Precio Uni. <span name="total" style="text-align: left;"><b><?php echo $_SESSION["moneda"]; ?> {{:precio}}</b><span/>
            </div>
            <div class="col-xs-3 col-md-3 col-sm-3 text-right">
                <button type="button" class="btn btn-primary" onclick="pedido.comentar({{:id}}, this);"><i class="fa fa-comment"></i></button>
                <button type="button" class="btn btn-danger" onclick="pedido.retirar({{:id}});"><i class="fa fa-times"></i></button>
            </div>
            <div id="com{{:id}}" style="display: none;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <input type="text" name="comentario" class="form-control" value="{{:comentario}}" placeholder="Agrega un comentario aqu&iacute;..." onchange="pedido.actualizar({{:id}}, this);"/>
                </div>
            </div>
        </div> 
    </li>
    {{else}}
    <li class="text-center list-group-item" style="border-radius: 0px; border: 0px; border-top: 1px solid #e7eaec;">No se han agregado productos al detalle</li>
    {{/for}}
    </li>
    <li class="list-group-item" style="background: #666666;color: #ffffff; border-radius: 0px; border: 0px; border-top: 1px solid #e7eaec;">
        <div class="row">
            <div class="col-xs-12 text-right">
                Total a confirmar <b><?php echo $_SESSION["moneda"]; ?>{{:total}}</b>
            </div>
        </div>
    </li>
</script>

<script src="assets/scripts/inicio/func-procesos.js"></script>
<script src="assets/scripts/inicio/func-cliente.js"></script>
<script src="assets/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script src="assets/js/js-render.js"></script>
<script src="assets/js/jquery.email-autocomplete.min.js"></script>
<script type="text/javascript">
    $('#restau').addClass("active");
</script>