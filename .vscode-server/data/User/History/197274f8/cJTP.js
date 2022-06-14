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
$(document).on('click', '#shiftTable tbody tr', function(){

    $('#newshift').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#newshift').modal('show');
    $('.modal-body').html();
    $('#shiftTitle').html('UPDATE CURRENT SHIFT');
    $('#btnSave').val('Update');
    
    var table = $('#shiftTable').DataTable();
    var data = table.row(this).data();
    $('#id').val(data.id);
    $('#shiftcode').val(data.code);
    $('#start').val(data.start);
    $('#break1').val(data.break_1);
    $('#break2').val(data.break_2);
    $('#end').val(data.end);
    $('#totalhours').val(data.total_hours);
   
});