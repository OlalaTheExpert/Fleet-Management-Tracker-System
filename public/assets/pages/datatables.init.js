$(document).ready(function() {
    $('#datatable-buttons').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [2, ':visible']
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6]
                }
            },
            'colvis'
        ]
    });
});