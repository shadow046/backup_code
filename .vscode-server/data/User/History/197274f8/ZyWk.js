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
$(document).on('click', '#btnSave', function(){
    var id = $('#id').val();
    var name = $('#holidayname').val();
    var type = $('#holidaytype').val();
    var remarks = $('#remarks').val();
    var date = $('#date').val();
    var btnSave = $('#btnSave').val();
    
    if(btnSave == 'Save'){
        if(name=='' || type=='' || remarks=='' || date==''){
            swal('REQUIRED','Fill up all required fields!','error');
        }
        else{
            if(['N/A', 'N /A', 'N/ A', 'N / A', 'NA', 'N A', 'NONE', 'N O N E'].includes(name) == true){
                swal('INVALID INPUT','Please enter only valid information!','error');   
                
            }
            else{
                swal({
                    title: "ADD NEW HOLIDAY?",
                    text: "You are about to ADD a new holiday!",
                    icon: "warning",
                    buttons: true,
                })
                .then((willDelete) => {
                    if(willDelete){
                        $.ajax({
                            url: "/holiday/save",
                            type: "POST",
                            headers: {
                            'X-CSRF-TOKEN': $("#csrf").val()
                            },
                            data: {
                                _token: $("#csrf").val(),
                                    name: name,
                                    type: type,
                                    remarks: remarks,
                                    date: date
                            },
                            success: function(result){
                                if (result == "true"){
                                    $('#newholiday').hide();
                                    swal('SAVE SUCCESS','New holiday saved successfully!','success');
                                    setTimeout(function(){window.location.href="/holiday"}, 2000);
                                }
                                else{
                                    $('#newholiday').hide();
                                    swal('SAVE FAILED','New holiday save failed!','error');
                                    setTimeout(function(){window.location.href="/holiday"}, 2000);
                                }
            
                            },
                            error: function(data){
                                if(data.status == 401){
                                    window.location.reload;
                                }
                                alert(data.responseText);
                            }
                        });
                    }
                });
            }
        }
    }
    else{

        // if(name && type && remarks && date){
        if(name=='' || type=='' || remarks=='' || date==''){
              // $('#userform')[0].reportValidity();
            swal('REQUIRED','Fill up all required fields!','error');
        }
        else{
            if(['N/A', 'N /A', 'N/ A', 'N / A', 'NA', 'N A', 'NONE', 'N O N E'].includes(name) == true){
                swal('INVALID INPUT','Please enter only valid information!','error');
            }
            else{
                $.ajax({
                    url: "/holiday/validate/update",
                    type: "POST",
                    headers: {
                    'X-CSRF-TOKEN': $("#csrf").val()
                    },
                    data: {
                        _token: $("#csrf").val(),
                        id: id,
                        name: name,
                        type: type,
                        remarks: remarks,
                        date: date
                    },
                    success: function(result){
                        // alert(result);
                        if (result == "nochanges"){
                            // $('#newuser').hide();
                            swal('NO CHANGES FOUND','Holiday details are all still the same!','error');
                            
                        }
                       
                        else if (result == "duplicate"){
                            // $('#newuser').hide();
                            swal('DUPLICATE HOLIDAY','Holiday already exists!','error');
                            
                        }
                        else{
                            // alert('UPDATE');
                            // return false;
                            swal({
                                title: "UPDATE CURRENT HOLIDAY?",
                                text: "You are about to UPDATE this current holiday!",
                                icon: "warning",
                                buttons: true,
                            })
                            .then((willDelete) => {
                                if(willDelete){
                                    $.ajax({
                                        url: "/holiday/update",
                                        type: "POST",
                                        headers: {
                                        'X-CSRF-TOKEN': $("#csrf").val()
                                        },
                                        data: {
                                            _token: $("#csrf").val(),
                                            id: id,
                                            name: name,
                                            type: type,
                                            remarks: remarks,
                                            date: date
                                        },
                                        success: function(result){
                                            if (result == "true"){
                                                $('#newholiday').hide();
                                                swal('UPDATE SUCCESS','Holiday updated successfully!','success');
                                                setTimeout(function(){window.location.href="/holiday"}, 2000);
                                            }
                                            else{
                                                $('#newholiday').hide();
                                                swal('UPDATE FAILED','Holiday update failed!','error');
                                                setTimeout(function(){window.location.href="/holiday"}, 2000);
                                            }
                        
                                        },
                                        error: function(data){
                                            if(data.status == 401){
                                                window.location.reload;
                                            }
                                            alert(data.responseText);
                                        }
                                    });
                                }
                            });
                        }
    
                    },
                    error: function(data){
                        if(data.status == 401){
                            window.location.reload;
                        }
                        alert(data.responseText);
                    }
                });
            }
        }
    }
});