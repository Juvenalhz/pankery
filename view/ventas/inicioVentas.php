<!-- HEADER DESKTOP-->

<!-- MAIN CONTENT-->
<div class="main-content" style="background-color: white;">
    <div class="section__content section__content--p30">
        <h1>Ventas</h1><br>
        <div class="container-fluid">
            <!-- Nav pills -->

            <ul class="nav nav-tabs" style="align-items: center;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Pendientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Proceso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Cobranza</a>
                </li>

            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="home">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalaggventa" style="float: right; margin-right: 1.5em; margin-left: 1.5em;" id="agregarPedido">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                        </button>
                        <table id="DataPendienteVentas" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CLIENTE</th>
                                    <th>PEDIDO</th>
                                    <th>CANTIDAD</th>
                                    <th>TOTAL</th>
                                    <th>PAGÓ</th>
                                    <th>ESTATUS</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>CLIENTE</th>
                                    <th>PEDIDO</th>
                                    <th>CANTIDAD</th>
                                    <th>TOTAL</th>
                                    <th>PAGÓ</th>
                                    <th>ESTATUS</th>
                                    <th>ACCION</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu1">
                    <div class="card-body">
                    <table id="DataProcesoVentas" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CLIENTE</th>
                                    <th>PEDIDO</th>
                                    <th>CANTIDAD</th>
                                    <th>TOTAL</th>
                                    <th>PAGÓ</th>
                                    <th>ESTATUS</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>CLIENTE</th>
                                    <th>PEDIDO</th>
                                    <th>CANTIDAD</th>
                                    <th>TOTAL</th>
                                    <th>PAGÓ</th>
                                    <th>ESTATUS</th>
                                    <th>ACCION</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu2">
                    <div class="card-body">
                    <table id="DataCobranzaVentas" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CLIENTE</th>
                                    <th>PEDIDO</th>
                                    <th>CANTIDAD</th>
                                    <th>TOTAL</th>
                                    <th>PAGÓ</th>
                                    <th>ESTATUS</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>CLIENTE</th>
                                    <th>PEDIDO</th>
                                    <th>CANTIDAD</th>
                                    <th>TOTAL</th>
                                    <th>PAGÓ</th>
                                    <th>ESTATUS</th>
                                    <th>ACCION</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalaggventa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formPedido" name="formPedido" method="post" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Producto">Producto</label>
                            <select class="form-control" id="Producto" name="Producto">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Precio">Precio Unitario</label>
                            <input type="numeric" class="form-control" id="Precio" name="Precio" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="Cantidad" name="Cantidad">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Costo">Costo Total</label>
                            <input type="number" class="form-control" id="Costo" name="Costo" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Pago">Cliente</label>
                            <input type="numeric" class="form-control" id="Cliente" name="Cliente">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Pago">Pago</label>
                            <input type="numeric" class="form-control" id="Pago" name="Pago">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="guardarPedido">Guardar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalcambiarestatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar estatus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formstatus" name="formstatus" method="post" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Producto">Estatus</label>
                            <select class="form-control" id="estatuspedido" name="estatuspedido">
                                <option value="">Seleccione</option>
                                <option value="2" id="Proceso">Proceso</option>
                                <option value="3" id="Cobranza">Cobranza</option>
                            </select>
                        </div>
                        <input type="hidden" name="pedido" id="pedido">
                        <input type="hidden" name="estatusActual" id="estatusActual">
                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="cambioestatus">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalmodificarpedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formPedidomod" name="formPedidomod" method="post" action="">
                    <div class="form-row">
                        <input type="hidden" id="id_pedido" name="id_pedido">
                        <div class="form-group col-md-6">
                            <label for="Producto">Producto</label>
                            <select class="form-control" id="Productomod" name="Productomod">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Preciomod">Precio Unitario</label>
                            <input type="numeric" class="form-control" id="Preciomod" name="Preciomod" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="Cantidadmod" name="Cantidadmod">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Costo">Costo Total</label>
                            <input type="number" class="form-control" id="Costomod" name="Costomod" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Pago">Cliente</label>
                            <input type="numeric" class="form-control" id="Clientemod" name="Clientemod">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Pago">Pago</label>
                            <input type="numeric" class="form-control" id="Pagomod" name="Pagomod">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="guardarPedidomod">Guardar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalagregarpagos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cobranza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formpagos" name="formpagos" method="post" action="">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                            <label for="Debe">Debe $ :</label>
                            <input type="number" class="form-control" id="Deuda" name="Deuda" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Pago">Añadir Pago $ :</label>
                            <input type="number" class="form-control" id="pago" name="pago">
                            <input type="hidden" name="pedidoCobranza" id="pedidoCobranza">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="guardarpago">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
