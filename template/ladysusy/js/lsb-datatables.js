$(document).ready(function() {
    $('#tablesAdmin').DataTable( {
         "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando: _START_ al _END_ de un total _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            dom:"<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            buttons: [
            {
                extend:'print',
                className:'btn gris btn-outline btn-sm',
                text:"Imprimir",
                title: 'Reporte de cursos'
            },
            {
                extend:"pdf",
                className:"btn celeste btn-outline btn-sm",
                title: 'Reporte de cursos'
            },
            {
                extend:"excel",
                className:"btn rojo btn-outline btn-sm",
                title: 'Reporte de cursos'
            },
            {
                extend:"copy",
                className:"btn azul btn-outline btn-sm",
                text:"Copiar"
            },
            {
                extend:"csv",
                className:"btn verde btn-outline btn-sm"
            }
        ]
       });
} );
