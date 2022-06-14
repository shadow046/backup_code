$(document).ready( function () {
    $('table.shiftTable').DataTable({
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

$(document).on('click', '#btnAddShift', function(){
    $('#newshift').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#newshift').modal('show');
    $('.modal-body').html();
});
$(document).on('click', '.closeModal', function(){
    $('#newshift').modal('hide');
    location.reload();
});