// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se han encontrado registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin resultados",
            "infoFiltered": "(Filtrado de _MAX_ registros existentes)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            }
        }
    });
});
$(document).ready(function() {
    $('#tablaPagos').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_",
            "zeroRecords": "No se han encontrado registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin resultados",
            "infoFiltered": "(Filtrado de _MAX_ registros existentes)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            }
        },
        // Target escoge la fila (es un arrya desde 0), visible, controla si aparece o no en el dom, y searchable, permite o no su busqueda por esa fila
        // orderable permite hablitar o desaviliar el ordenamiento
        "columnDefs": [{
                "targets": [0, 1],
                "visible": false,
                "searchable": false,
            },
            {
                "targets": [0, 1, 5],
                "searchable": false
            },
            {
                "targets": [0, 1, 2, 3, 4, 5],
                "orderable": false
            }
        ],
        "order": [
            [1, "desc"]
        ]
    });
});
$(document).ready(function() {
    $('#tablaMedidas').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_",
            "zeroRecords": "No se han encontrado registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin resultados",
            "infoFiltered": "(Filtrado de _MAX_ registros existentes)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            }
        },
        "columnDefs": [{
            "targets": [0],
            "visible": false,
            "searchable": false,
            "orderable": false
        }, {
            "targets": [2],
            "orderable": false
        }],
        "order": [
            [1, "desc"]
        ]
    });
});
$(document).ready(function() {
    $('#productos').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se han encontrado registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin resultados",
            "infoFiltered": "(Filtrado de _MAX_ registros existentes)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            }
        },
        "columnDefs": [{
            "targets": [0],
            "visible": false,
            "searchable": false,
            "orderable": false
        }, {
            "targets": [2],
            "searchable": false,
        }],
        "order": [
            [1, "asc"]
        ]
    });
});
$(document).ready(function() {
    $('#clientesTable').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se han encontrado registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin resultados",
            "infoFiltered": "(Filtrado de _MAX_ registros existentes)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            }
        },
        "columnDefs": [{
            "targets": [4],
            "searchable": false,
            "orderable": false
        }],
        "order": [
            [1, "asc"]
        ]
    });
});
$(document).ready(function() {
    $('#tablaReportesDiario').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se han encontrado registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin resultados",
            "infoFiltered": "(Filtrado de _MAX_ registros existentes)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            }
        },
        "columnDefs": [{
            "targets": [],
            "searchable": false,
            "visible": false,
        }, {
            "targets": [6],
            "searchable": false,
            "orderable": false
        }],
        "order": [
            [4, "asc"]
        ]
    });
});
$(document).ready(function() {
    $('#tablaReportesMensual').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se han encontrado registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin resultados",
            "infoFiltered": "(Filtrado de _MAX_ registros existentes)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            }
        },
        "columnDefs": [{
            "targets": [0],
            "searchable": false,
            "visible": false
        }],
        "order": [
            [0, "desc"]
        ]
    });
});