$(document).ready( function () {
    $('table.shiftTable').DataTable({
        ajax: {
            url: '/shift/data',
        },
        columns: [
           
            { data: 'name' },
            { data: 'type'},
            { data: 'remarks'},
            { data: 'date'}
        ],
    });
} );