<!-- HEADER DESKTOP-->

<!-- MAIN CONTENT-->
<div class="main-content" style="background-color: white;">
    <div class="section__content section__content--p30">
        <h1>Egresos</h1><br>
        <div class="container-fluid">
            <ul class="nav nav-tabs" style="align-items: center;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#gastos">Gastos de la empresa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#efijo">Lista de Egresos Fijos</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="gastos">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalaggventa" style="float: right; margin-right: 1.5em; margin-left: 1.5em;" id="agregarGasto">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                        </button>
                        <table id="tableegresos" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TIPO GASTO</th>
                                    <th>GASTO</th>
                                    <th>NUMERO</th>
                                    <th>FECHA</th>
                                    <th>CANTIDAD</th>
                                    <th>PESO (gr)</th>
                                    <th>PRECIO ($)</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>TIPO GASTO</th>
                                    <th>GASTO</th>
                                    <th>NUMERO</th>
                                    <th>FECHA</th>
                                    <th>CANTIDAD</th>
                                    <th>PESO (gr)</th>
                                    <th>PRECIO ($)</th>
                                    <th>ACCION</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
                <div class="tab-pane container" id="efijo">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalaggegresoFijo" style="float: right; margin-right: 1.5em; margin-left: 1.5em;" id="agregarFijo">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                        </button>
                        <table id="tableegresosfijo" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>GASTO</th>
                                    <th>PRECIO ($)</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>GASTO</th>
                                    <th>PRECIO ($)</th>
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
                <ul class="nav nav-tabs" style="align-items: center;">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#mp">Materia Prima</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#ef" id="botongastoEgresoFijo">Egreso Fijo</a>
                    </li>


                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane container active" id="mp">
                        <form id="formMP" name="formMP" method="post" action="">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Producto">Producto</label>
                                    <select class="form-control" id="Producto" name="Producto">
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="compra">Número de compra</label>
                                    <input type="numeric" class="form-control" id="Numcompra" name="Numcompra">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fechacompra">Fecha compra</label>
                                    <input type="date" class="form-control" id="fechacompra" name="fechacompra">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Cantidad">Cantidad</label>
                                    <input type="number" class="form-control" id="Cantidad" name="Cantidad">
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Precio">Precio</label>
                                    <input type="number" class="form-control" id="Precio" name="Precio">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Peso">Peso</label>
                                    <input type="numeric" class="form-control" id="Peso" name="Peso">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="guardarGasto">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane container" id="ef">
                        <form id="formEF" name="formEF" method="post" action="">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="egresofijo">Egreso Fijo</label>
                                    <select class="form-control" id="egresofijo" name="egresofijo">
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Gasto">Gasto </label>
                                    <input type="numeric" class="form-control" id="Gasto" name="Gasto">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Fecha">Fecha</label>
                                    <input type="date" class="form-control" id="Fecha" name="Fecha">
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
</div>

<div class="modal fade" id="modalmodificarGasto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Egreso
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formmodifMP" name="formmodifMP" method="post" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ModifProducto">Producto</label>
                            <select class="form-control" id="ModifProducto" name="ModifProducto">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="modifcompra">Número de compra</label>
                            <input type="numeric" class="form-control" id="modifcompra" name="modifcompra">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="modiffechacompra">Fecha compra</label>
                            <input type="date" class="form-control" id="modiffechacompra" name="modiffechacompra">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="modifCantidad">Cantidad</label>
                            <input type="number" class="form-control" id="modifCantidad" name="modifCantidad">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="modifPrecio">Precio</label>
                            <input type="number" class="form-control" id="modifPrecio" name="modifPrecio">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="modifPeso">Peso</label>
                            <input type="numeric" class="form-control" id="modifPeso" name="modifPeso">
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="idcompra" name="idcompra">
                    <div class="form-group">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="guardarmodifGasto">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalmodificarGastoEF" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Egreso
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="formEFmodif" name="formEFmodif" method="post" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="egresofijo">Egreso Fijo</label>
                            <select class="form-control" id="egresofijomodif" name="egresofijomodif">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Gasto">Gasto </label>
                            <input type="numeric" class="form-control" id="Gastomodif" name="Gastomodif">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Fecha">Fecha</label>
                            <input type="date" class="form-control" id="Fechamodif" name="Fechamodif">
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="idcompramodif" name="idcompramodif">

                    <div class="form-group">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="guardargastoEgresoFijomodif">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalaggegresoFijo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Agregar Egreso Fijo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-pane container" id="aggEF">
                    <form id="formaggEF" name="formaggEF" method="post" action="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="egresofijo">Egreso Fijo</label>
                                <input type="text" class="form-control" id="nombreEgresoFijo" name="nombreEgresoFijo">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="GastoEF">Gasto </label>
                                <input type="numeric" class="form-control" id="GastoEF" name="GastoEF">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" id="guardarnuevoegresoFijo">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalmodifegresoFijo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Agregar Egreso Fijo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-pane container" id="aggEF">
                    <form id="formmodifEF" name="formmodifEF" method="post" action="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="egresofijo">Egreso Fijo</label>
                                <input type="text" class="form-control" id="modifnombreEgresoFijo" name="modifnombreEgresoFijo">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="GastoEF">Gasto </label>
                                <input type="numeric" class="form-control" id="modifGastoEF" name="modifGastoEF">
                                <input type="hidden" name="id_egresofijo" id="id_egresofijo">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" id="guardarmodifegresoFijo">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>