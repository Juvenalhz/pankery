<!-- HEADER DESKTOP-->

<!-- MAIN CONTENT-->

<div class="main-content" style="background-color: white;">
    <div class="section__content section__content--p30">
        <?php
        require_once("controller/controladorgeneral.php");
        $controlador = new ControladorGeneral();
        $resultados = $controlador->sp_consultafinanza();
        $data = pg_fetch_assoc($resultados);
        ?>
        <h1>Finanzas</h1><br>
        <div class="container-fluid">
            <div class="row justify-content-center h-100">
                <div class="col-sm-8 align-self-center text-center">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                                <div class="text">
                                    <h2> <?php
                                            echo round( $data["capital"], 2);
                                            ?></h2>
                                    <span>Capital total</span>
                                </div>
                            </div>
                            <!-- <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div> -->
                        </div>
                    </div>

                </div>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="histo">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalaggcapital" style="float: right; margin-right: 1.5em; margin-left: 1.5em;" id="agregarGasto">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                        </button>
                        <table id="HistorialFinanzas" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TIPO TX</th>
                                    <th>DESCRIPCION</th>
                                    <th>MONTO</th>
                                    <th>FECHA</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>TIPO TX</th>
                                    <th>DESCRIPCION</th>
                                    <th>MONTO</th>
                                    <th>FECHA</th>

                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalaggcapital" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Agregar al Capital</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-pane container" id="aggF">
                    <form id="formaggF" name="formaggF" method="post" action="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="aggfinanza">Monto</label>
                                <input type="text" class="form-control" id="Cantidadagg" name="Cantidadagg">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" id="guardaraggfinanza">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

