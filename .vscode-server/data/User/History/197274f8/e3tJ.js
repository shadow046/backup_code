$(document).ready( function () {
    $('table.Table').DataTable({
        ajax: {
            url: '/shift/data',
        },
        columns: [
           
            { data: 'code' },
            { data: 'start'},
            { data: 'break_1'},
            { data: 'break_2'},
            { data: 'end'},
            { data: 'total_hours'}
        ],
    });
} );