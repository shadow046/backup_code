$(document).ready( function () {
    $('table.holidayTable').DataTable({
        ajax: {
            url: '/holiday/data',
        },
        columns: [
           
            { data: 'name' },
            { data: 'type'},
            { data: 'remarks'},
            {
                data: 'date',
                "render": function(data, type, row){
                    return(row.date).slice(5);
                }
            }
            // { data: 'id', visible: false}
        ],
        order:[[3, 'asc']],
    });
} );

$(document).on('click', '#btnAddHoliday', function(){
    $('#newholiday').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#newholiday').modal('show');
    $('.modal-body').html();
});

$(document).on('click', '.closeModal', function(){
    $('#newholiday').modal('hide');
    location.reload();
});

$('#holidaytype').on('change', function(){
    var holidaytype = $('#holidaytype').val();
    if(holidaytype == ''){
        $('#holidaytype').css({"color":"Gray"});
    }
    else{
        $('#holidaytype').css({"color":"Black"});
    }
});


$(document).on('click', '#holidayTable tbody tr', function(){


    // const d = new Date();
    // let year = d.getFullYear();
    // alert(year);
    // return false;



    $('#newholiday').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#newholiday').modal('show');
    $('.modal-body').html();
    $('#holidayTitle').html('UPDATE CURRENT HOLIDAY');
    $('#btnSave').val('Update');
    
    var table = $('#holidayTable').DataTable();
    var data = table.row(this).data();
    $('#id').val(data.id);
    $('#holidayname').val(data.name);
    $('#holidaytype').val(data.type_id);
    $('#remarks').val(data.remarks);
    var date = data.date.slice(5);
    const d = new Date();
    let year = d.getDate();
    $('#date').val(year+'-'+date);
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