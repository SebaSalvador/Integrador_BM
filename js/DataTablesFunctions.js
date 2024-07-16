$(document).ready(function () {
  // Inicializar la tabla DataTable
  var Tabla_Reportes = $("#Tabla_Reportes").DataTable({
    destroy: true, // Para poder reinicializar la tabla si es necesario
    pageLength: 10,
    lengthChange: true,
    responsive: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json",
      emptyTable: "No hay datos disponibles en la tabla.",
      zeroRecords: "No se encontraron registros que coincidan.",
      info: "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "No existen registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
    autoWidth: true,
    scrollX: false,
    pagingType: "simple_numbers",
    // Configuración de Ajax
    ajax: {
      url: "buscarLector.php",
      type: "POST",
      dataType: "json",
      data: {
        accion: "obtener_prestamos",
        estado: $("#estado").val(),
      },
      dataSrc: "",
      /*success: function (data) {
        console.log(data); // Imprimir la data obtenida del AJAX en la consola
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud AJAX:");
        console.error("Estado: " + textStatus);
        console.error("Error: " + errorThrown);
        console.error("Respuesta del servidor:");
        console.error(jqXHR.responseText);
      },*/
    },
    // Configuración de columnas
    columns: [
      { data: "id" },
      { data: "titulo" },
      { data: "nombre_apellido" },
      { data: "fecha_prestamo" },
      { data: "fecha_devolucion" },
      { data: "estado" },
    ],
    // Botones para exportar
    dom: "Blfrtip",
    buttons: [
      {
        extend: "excel",
        text: "Excel",
        title: "Sebitas OwO",
      },
      {
        extend: "pdf",
        text: "PDF",
        title: "Sebitas UwU",
        customize: function (doc) {
          doc.content[1].table.widths = Array(
            doc.content[1].table.body[0].length + 1
          )
            .join("*")
            .split("");
          doc.defaultStyle.alignment = "center";
        },
      },
    ],
    initComplete: function () {
      $("#estado").on("input", function () {
        Tabla_Reportes.search(this.value).draw();
      });
    },
  });

  var Tabla_Reportes_Cliente = $("#Tabla_Reportes_Cliente").DataTable({
    destroy: true,
    pageLength: 10,
    lengthChange: true,
    responsive: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json",
      emptyTable: "No hay datos disponibles en la tabla.",
      zeroRecords: "No se encontraron registros que coincidan.",
      info: "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "No existen registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
    autoWidth: true,
    scrollX: false,
    pagingType: "simple_numbers",
    ajax: {
      url: "buscarLector.php",
      type: "POST",
      dataType: "json",
      data: {
        accion: "obtener_clientes",
      },
      dataSrc: "",
      /*success: function (data) {
        console.log(data); // Imprimir la data obtenida del AJAX en la consola
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud AJAX:");
        console.error("Estado: " + textStatus);
        console.error("Error: " + errorThrown);
        console.error("Respuesta del servidor:");
        console.error(jqXHR.responseText);
      },*/
    },
    columns: [
      { data: "DNI" },
      { data: "Nombre" },
      { data: "Correo" },
      { data: "Telefono" },
      { data: "Estado" },
    ],
    
    select: true,
    dom: "Blfrtip",
    buttons: [
      {
        extend: "excel",
        text: "Excel",
        title: "Sebitas OwO",
      },
      {
        extend: "pdf",
        text: "PDF",
        title: "Sebitas UwU",
        customize: function (doc) {
          doc.content[1].table.widths = Array(
            doc.content[1].table.body[0].length + 1
          ).join("*").split("");
          doc.defaultStyle.alignment = "center";
        },
      },
    ],
    initComplete: function () {
      $("#estado").on("input", function () {
        Tabla_Reportes_Cliente.search(this.value).draw();
      });
    },
  });

  var Tabla_Reportes_Empleado = $("#Tabla_Reportes_Empleado").DataTable({
    destroy: true, // Para poder reinicializar la tabla si es necesario
    pageLength: 10,
    lengthChange: true,
    responsive: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json",
      emptyTable: "No hay datos disponibles en la tabla.",
      zeroRecords: "No se encontraron registros que coincidan.",
      info: "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "No existen registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
    autoWidth: true,
    scrollX: false,
    pagingType: "simple_numbers",
    // Configuración de Ajax
    ajax: {
      url: "buscarLector.php",
      type: "POST",
      dataType: "json",
      data: {
        accion: "obtener_empleados",
      },
      dataSrc: "",
      /*success: function (data) {
        console.log(data); // Imprimir la data obtenida del AJAX en la consola
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud AJAX:");
        console.error("Estado: " + textStatus);
        console.error("Error: " + errorThrown);
        console.error("Respuesta del servidor:");
        console.error(jqXHR.responseText);
      },*/
    },
    // Configuración de columnas
    columns: [
      { data: "DNI" },
      { data: "Nombre" },
      { data: "Correo" },
      { data: "Telefono" },
      { data: "Estado" },
    ],
    // Botones para exportar
    dom: "Blfrtip",
    buttons: [
      {
        extend: "excel",
        text: "Excel",
        title: "Sebitas OwO",
      },
      {
        extend: "pdf",
        text: "PDF",
        title: "Sebitas UwU",
        customize: function (doc) {
          doc.content[1].table.widths = Array(
            doc.content[1].table.body[0].length + 1
          )
            .join("*")
            .split("");
          doc.defaultStyle.alignment = "center";
        },
      },
    ],
    initComplete: function () {
      $("#estado").on("input", function () {
        Tabla_Reportes_Empleado.search(this.value).draw();
      });
    },
  });

  var Tabla_Reportes_Sanciones = $("#Tabla_Reportes_Sanciones").DataTable({
    destroy: true, // Para poder reinicializar la tabla si es necesario
    pageLength: 10,
    lengthChange: true,
    responsive: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json",
      emptyTable: "No hay datos disponibles en la tabla.",
      zeroRecords: "No se encontraron registros que coincidan.",
      info: "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "No existen registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
    autoWidth: true,
    scrollX: false,
    pagingType: "simple_numbers",
    // Configuración de Ajax
    ajax: {
      url: "buscarLector.php",
      type: "POST",
      dataType: "json",
      data: {
        accion: "obtener_sanciones",
      },
      dataSrc: "",
      /*success: function (data) {
        console.log(data); // Imprimir la data obtenida del AJAX en la consola
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud AJAX:");
        console.error("Estado: " + textStatus);
        console.error("Error: " + errorThrown);
        console.error("Respuesta del servidor:");
        console.error(jqXHR.responseText);
      },*/
    },
    // Configuración de columnas
    columns: [
      { data: "id_sancion" },
      { data: "nombre" },
      { data: "dias_sancion" },
      { data: "fecha_inicio" },
      { data: "fecha_fin" },
      { data: "motivo" },
      { data: "estado_sancion" },
    ],
    // Botones para exportar
    dom: "Blfrtip",
    buttons: [
      {
        extend: "excel",
        text: "Excel",
        title: "Sebitas OwO",
      },
      {
        extend: "pdf",
        text: "PDF",
        title: "Sebitas UwU",
        customize: function (doc) {
          doc.content[1].table.widths = Array(
            doc.content[1].table.body[0].length + 1
          )
            .join("*")
            .split("");
          doc.defaultStyle.alignment = "center";
        },
      },
    ],
    initComplete: function () {
      $("#estado").on("input", function () {
        Tabla_Reportes_Sanciones.search(this.value).draw();
      });
    },
  });





});
