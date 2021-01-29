function datatables_apps() {
  $("#dataMateriaPrima").DataTable({
    bDeferRender: true,
    sPaginationType: "full_numbers",
    ajax: {
      url: "view/inventario/materiaTable.php",
      type: "POST",
    },

    columns: [
      { data: "id_mp" },
      { data: "descp" },
      { data: "cant" },

      {
        defaultContent: "",
        render: function (data, type, full, meta) {
          return "<div class='btn-group' role='group' aria-label='Basic example'><button class='modificarError btn btn-primary' data-toggle='modal' data-target='#modificarMateriaPrima' type='button' id='modificarError' title='modificarError'><i class='fas fa-edit' aria-hidden='true'></i> </button><button class= 'habilitarError btn btn-warning' type='button' title='habilitarError' id='habilitarError'><i class='fas fa-eye'></i> </button></div>";
        },
      },
    ],
    order: [[1,"asc"]],
    oLanguage: {
      sProcessing: "Procesando...",
      sLengthMenu:
        "Mostrar <select>" +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        "</select> registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Filtrar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Por favor espere - cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });

  $("table#tableCajaChica").DataTable({
    bDeferRender: true,
    sPaginationType: "full_numbers",
    ajax: {
      url: "view/cajaChica/totalCajaChica.php",
      type: "POST",
    },

    columns: [
      { data: "id_out" },
      { data: "total_out" },
      {defaultContent: '<button type="button" class="btn btn-danger"  id="agregarGasto"><i class="fas fa-minus-circle" aria-hidden="true"></i></button>'},
    ],
    order: [[1,"asc"]],
    oLanguage: {
      sProcessing: "Procesando...",
      sLengthMenu:
        "Mostrar <select>" +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        "</select> registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Filtrar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Por favor espere - cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });

  $("table#tableMovimientosCajaChica").DataTable({
    bDeferRender: true,
    sPaginationType: "full_numbers",
    ajax: {
      url: "view/cajaChica/MovimientosCajaChica.php",
      type: "POST",
    },
    columns: [
      { data: "id_out" },
      { data: "nombre_out" },
      { data: "cantidad_out" },
      { data: "usuario_out" },
      { data: "fecha_registro_out" },
      {defaultContent: '<button type="button" class="btn btn-danger"  id="agregarGasto"><i class="fas fa-minus-circle" aria-hidden="true"></i></button>'},
    ],
    order: [[1,"asc"]],
    oLanguage: {
      sProcessing: "Procesando...",
      sLengthMenu:
        "Mostrar <select>" +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        "</select> registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "No se encontraron movimientos",
      sInfo:
        "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Filtrar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Por favor espere - cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });

  $("#dataRecetario").DataTable({
    bDeferRender: true,
    sPaginationType: "full_numbers",
    ajax: {
      url: "view/recetario/productos.php",
      type: "POST",
    },

    columns: [
      { data: "id_pro" },
      { data: "descp" },
      { data: "precio" },

      {
        defaultContent: "",
        render: function (data, type, full, meta) {
          return "<div class='btn-group' role='group' aria-label='Basic example'><button class='recetario btn btn-primary' data-toggle='modal' data-target='#modificarMateriaPrimaRecetario' type='button' id='recetario' title='modificarError'><i class='fas fa-edit' aria-hidden='true'></i> </button><button class= 'verreceta btn btn-warning' type='button'  data-toggle='modal' data-target='#verReceta' title='verreceta' id='verreceta'><i class='fas fa-eye'></i> </button></div>";
        },
      },
    ],
    order: [[1,"asc"]],
    oLanguage: {
      sProcessing: "Procesando...",
      sLengthMenu:
        "Mostrar <select>" +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        "</select> registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Filtrar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Por favor espere - cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });

  $("#DataPendienteVentas").DataTable({
    bDeferRender: true,
    sPaginationType: "full_numbers",
    ajax: {
      url: "view/ventas/pedidos.php",
      data: { estatus: 1 },
      type: "POST",
    },

    columns: [
      { data: "id_pedidos" },
      { data: "cliente" },
      { data: "descr" },
      { data: "cantidad" },
      { data: "total" },
      { data: "monto" },
      { data: "estatus" },

      {
        defaultContent: "",
        render: function (data, type, full, meta) {
          return "<div class='btn-group' role='group' aria-label='Basic example'><button class=' btn btn-primary' data-toggle='modal' data-target='#modalcambiarestatus' type='button' id='cambiarestatus' title='cambiarestatus'><i class='fas fa-edit' aria-hidden='true'></i> </button><button class= ' btn btn-warning' type='button'  data-toggle='modal' data-target='#modalmodificarpedido' title='modificarpedido' id='modificarpedido'><i class='fas fa-eye'></i> </button><button class=' btn btn-danger' data-toggle='modal' data-target='#modaleliminarpedido' type='button' id='eliminarpedido' title='eliminarpedido'><i class='fas fa-trash' aria-hidden='true'></i> </button></div>";
        },
      },
    ],
    order: [[0,"desc"]],
    oLanguage: {
      sProcessing: "Procesando...",
      sLengthMenu:
        "Mostrar <select>" +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        "</select> registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Filtrar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Por favor espere - cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });

  $("#DataProcesoVentas").DataTable({
    bDeferRender: true,
    sPaginationType: "full_numbers",
    ajax: {
      url: "view/ventas/pedidos.php",
      type: "POST",
      data: { estatus: 2 },
    },

    columns: [
      { data: "id_pedidos" },
      { data: "cliente" },
      { data: "descr" },
      { data: "cantidad" },
      { data: "total" },
      { data: "monto" },
      { data: "estatus" },

      {
        defaultContent: "",
        render: function (data, type, full, meta) {
          return "<div class='btn-group' role='group' aria-label='Basic example'><button class=' btn btn-primary' data-toggle='modal' data-target='#modalcambiarestatus' type='button' id='cambiarestatus' title='cambiarestatus'><i class='fas fa-edit' aria-hidden='true'></i> </button></div>";
        },
      },
    ],
    order: [[0,"desc"]],
    oLanguage: {
      sProcessing: "Procesando...",
      sLengthMenu:
        "Mostrar <select>" +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        "</select> registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Filtrar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Por favor espere - cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });

  $("#DataCobranzaVentas").DataTable({
    bDeferRender: true,
    sPaginationType: "full_numbers",
    ajax: {
      url: "view/ventas/pedidos.php",
      type: "POST",
      data: { estatus: 3 },
    },

    columns: [
      { data: "id_pedidos" },
      { data: "cliente" },
      { data: "descr" },
      { data: "cantidad" },
      { data: "total" },
      { data: "monto" },
      { data: "estatus" },

      {
        defaultContent: "",
        render: function (data, type, full, meta) {
          return "<div class='btn-group' role='group' aria-label='Basic example'><button class= ' btn btn-warning' type='button'  data-toggle='modal' data-target='#modalagregarpagos' title='agregarpagos' id='agregarpagos'><i class='fas fa-eye'></i> </button></div>";
        },
      },
    ],
    order: [[0,"desc"]],
    oLanguage: {
      sProcessing: "Procesando...",
      sLengthMenu:
        "Mostrar <select>" +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        "</select> registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Filtrar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Por favor espere - cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });

  $("#tableegresos").DataTable({
    bDeferRender: true,
    sPaginationType: "full_numbers",
    ajax: {
      url: "view/egresos/consultaegresos.php",
      type: "POST",
    },

    columns: [
      { data: "id_compra" },
      { data: "tipogasto" },
      { data: "gasto" },
      { data: "nro_compra" },
      { data: "fecha_compra" },
      { data: "cantidad_mp" },
      { data: "peso" },
      { data: "precio" },

      {
        defaultContent: "",
        render: function (data, type, full, meta) {
          return "<div class='btn-group' role='group' aria-label='Basic example'><button class= ' btn btn-warning' type='button' title='modificarGasto' id='modificarGasto'><i class='fas fa-eye'></i> </button></div>";
        },
      },
    ],
    order: [[4,"desc"]],
    oLanguage: {
      sProcessing: "Procesando...",
      sLengthMenu:
        "Mostrar <select>" +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        "</select> registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Filtrar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Por favor espere - cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });
  $("#tableegresosfijo").DataTable({
    bDeferRender: true,
    sPaginationType: "full_numbers",
    ajax: {
      url: "view/egresos/consultaegresosfijos.php",
      type: "POST",
    },

    columns: [
      { data: "id_egresofijo" },
      { data: "egresofijo" },
      { data: "costo" },
  

      {
        defaultContent: "",
        render: function (data, type, full, meta) {
          return "<div class='btn-group' role='group' aria-label='Basic example'><button class= ' btn btn-warning' type='button'  data-toggle='modal' data-target='#modalmodifegresoFijo' title='modificarGasto' id='modificarEgresoFijo'><i class='fas fa-eye'></i> </button></div>";
        },
      },
    ],

    oLanguage: {
      sProcessing: "Procesando...",
      sLengthMenu:
        "Mostrar <select>" +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        "</select> registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Filtrar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Por favor espere - cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });
  $("#HistorialFinanzas").DataTable({
    bDeferRender: true,
    sPaginationType: "full_numbers",
    ajax: {
      url: "view/finanzas/consultahistoricoFinanzas.php",
      type: "POST",
    },

    columns: [
      { data: "id_finanzahist" },
      { data: "tipo" },
      { data: "descripcion" },
      { data: "monto" },
      { data: "fecha" },
  

      // {
      //   defaultContent: "",
      //   render: function (data, type, full, meta) {
      //     return "<div class='btn-group' role='group' aria-label='Basic example'><button class= ' btn btn-warning' type='button'  data-toggle='modal' data-target='#modalmodifegresoFijo' title='modificarGasto' id='modificarEgresoFijo'><i class='fas fa-eye'></i> </button></div>";
      //   },
      // },
    ],
    order: [[4,"desc"]],
    oLanguage: {
      sProcessing: "Procesando...",
      sLengthMenu:
        "Mostrar <select>" +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        "</select> registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Filtrar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Por favor espere - cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });
}
