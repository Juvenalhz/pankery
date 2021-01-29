<!-- HEADER DESKTOP-->

<!-- MAIN CONTENT-->
<div class="main-content" style="background-color: white;">
    <div class="section__content section__content--p30">
        <h1>CAJA CHICA</h1><br>
        <div class="container-fluid">
            <ul class="nav nav-tabs" style="align-items: center;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#gastos">TOTAL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#efijo">MOVIMIENTOS</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="gastos">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary"  style="float: right; margin-right: 1.5em; margin-left: 1.5em;" id="agregarCajaChica">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                        </button>
                        <table id="tableCajaChica" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CANTIDAD</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>CANTIDAD</th>
                                    <th>ACCION</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
                <div class="tab-pane container" id="efijo">
                    <div class="card-body">
                        
                        <table id="tableMovimientosCajaChica" class="table table-bordered table-striped" style="width:100%">
                            <thead>

                                <!--  ,usuario_out character varying,fecha_registro_out date -->
                                <tr>
                                    <th>ID</th>
                                    <th>MOVIMIENTO</th>
                                    <th>CANTIDAD ($)</th>
                                    <th>USUARIO</th>
                                    <th>FECHA</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>MOVIMIENTO</th>
                                    <th>CANTIDAD ($)</th>
                                    <th>USUARIO</th>
                                    <th>FECHA</th>
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
                <h3>Ingreso a Caja Chica</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-pane container" id="ef">
                    <form id="formCajaChica" name="formEF" method="post" action="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Gasto">Total Disponible </label>
                                <input type="numeric" disabled="true"  class="form-control" id="disponible" name="disponible">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Fecha">Monto a Ingresar</label>
                                <input type="numeric" class="form-control" id="MontoIngreso" name="MontoIngreso">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" id="guardargastoEgresoFijo">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
