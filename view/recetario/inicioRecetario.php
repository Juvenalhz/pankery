<!-- HEADER DESKTOP-->

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <h2>Recetario</h2>
        <div class="container-fluid">
            <!-- <button class="btn btn-primary" type="button" id="agregarerror" title="Agregar" style="float: right; margin-right: 1.5em; margin-left: 1.5em;"><i class="fas fa-plus" aria-hidden="true"></i> </button> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right; margin-right: 1.5em; margin-left: 1.5em;" id="agregarProducto">
                <i class="fas fa-plus" aria-hidden="true"></i>
            </button>
            <div class="card-body">
                <table id="dataRecetario" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>PPRODUCTO</th>
                            <th>PRECIO ($)</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>PPRODUCTO</th>
                            <th>PRECIO ($)</th>
                            <th>ACCION</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
            <!-- Button trigger modal -->


            <!-- Modal -->

        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formRec" name="formRec" method="post" action=""> </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-sm" id="verReceta" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloReceta"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <ul class="list-group" id="listReceta">

            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="modificarMateriaPrimaRecetario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Receta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formreceta" name="formreceta" method="post" action="">

                </form>
                <div class="form-group">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="guardarReceta">Guardar</button>
                        <button type="button" class="btn btn-primary" style="float: right; margin-right: 1.5em; margin-left: 1.5em;" id="agregarmp">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                        </button></div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
