<!-- HEADER DESKTOP-->

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <h2>Inventario</h2>
        <div class="container-fluid">
            <!-- <button class="btn btn-primary" type="button" id="agregarerror" title="Agregar" style="float: right; margin-right: 1.5em; margin-left: 1.5em;"><i class="fas fa-plus" aria-hidden="true"></i> </button> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right; margin-right: 1.5em; margin-left: 1.5em;" id="agregarArticulo">
                <i class="fas fa-plus" aria-hidden="true"></i>
            </button>
            <div class="card-body">
                <table id="dataMateriaPrima" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>MATERIA PRIMA</th>
                            <th>CANTIDAD (gr)</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>MATERIA PRIMA</th>
                            <th>CANTIDAD (gr)</th>
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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" id="Nuevomp" href="#">Nuevo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="Actualizarmp">Actualizar</a>
                    </li>
                </ul>
                <div id="formularioinv">
                
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modificarMateriaPrima" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formmodif" name="formmodif" method="post" action=""> </form>
            </div>
        </div>
    </div>
</div>

<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
</div>

</div>