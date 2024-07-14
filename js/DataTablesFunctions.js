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

  function modificarPrestamos() {
    Tabla_Reportes.ajax.reload();
  }
});
