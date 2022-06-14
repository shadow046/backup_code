var month = [
    '',
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
]
$(document).ready( function () {
    $('table.leaveTable').DataTable({
        ajax: {
            url: '/leave/data',
        },
        columns: [
           
            { data: 'code' },
            { data: 'type'},
            { data: 'no_of_days'},
            { data: 'from_month', visible: false},
            { data: 'to_month', visible: false},
            // {data: 'from_month'},
            {
                data: null,
                    "render": function(data, type, row){
                    var datetoday = row.to_month;
                return(month[row.from_month]+' to '+month[row.to_month]);
                }
            }
        ],
        order:[[2, 'asc']],
    });
} );
$(document).on('click', '.closeModal', function(){
    $('#newholiday').modal('hide');
    location.reload();
});

$(document).on('click', '#leaveTable tbody tr', function(){

    $('#newleave').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#newleave').modal('show');
    $('.modal-body').html();
    $('#leaveTitle').html('UPDATE CURRENT LEAVE');
    $('#btnSave').val('Update');
    
    var table = $('#leaveTable').DataTable();
    var data = table.row(this).data();
    $('#id').val(data.id);
    $('#leavecode').val(data.code);
    $('#leavetype').val(data.type);
    $('#noofdays').val(data.no_of_days);
    $('#availmonthfrom').val(data.from_month);
    $('availmonthto').val(data.to_month);
});

$(document).on('click', '#btnSave', function(){
    var id = $('#id').val();
    var leavecode = $('#leavecode').val();
    var leavetype = $('#leavetype').val();
    var noofdays = $('#noofdays').val();
    var availmonthfrom = $('#availmonthfrom').val();
    var availmonthto = $('#availmonthto').val();
    var btnSave = $('#btnSave').val();
    
    if(btnSave == 'Save'){
        if(leavecode=='' || leavetype=='' || noofdays=='' || availmonthfrom=='' || availmonthto==''){
            swal('REQUIRED','Fill up all required fields!','error');
            }
        else{
            if(['N/A', 'N /A', 'N/ A', 'N / A', 'NA', 'N A', 'NONE', 'N O N E'].includes(leavetype) == true){
                swal('INVALID INPUT','Please enter only valid information!','error');   
            }
            else{
                $.ajax({
                    url: "/leave/validate/leave",
                    type: "POST",
                    headers: {
                    'X-CSRF-TOKEN': $("#csrf").val()
                    },
                    data: {
                        _token: $("#csrf").val(),
                        id: id,
                        leavecode: leavecode,
                        leavetype: leavetype,
                        noofdays: noofdays,
                        availmonthfrom: availmonthfrom,
                        availmonthto: availmonthto
                    },
                    success: function(result){
                        // alert(result);
                        if (result == "duplicate"){
                            // $('#newuser').hide();
                            swal('DUPLICATE LEAVE','Leave type already exists!','error');             
                        }
                        else{
                            swal({
                                title: "ADD NEW LEAVE?",
                                text: "You are about to ADD a new leave!",
                                icon: "warning",
                                buttons: true,
                            })
                            .then((willDelete) => {
                                if(willDelete){
                                    $.ajax({
                                        url: "/leave/save",
                                        type: "POST",
                                        headers: {
                                        'X-CSRF-TOKEN': $("#csrf").val()
                                        },
                                        data: {
                                            _token: $("#csrf").val(),
                                            leavecode: leavecode,
                                            leavetype: leavetype,
                                            noofdays: noofdays,
                                            availmonthfrom: availmonthfrom,
                                            availmonthto: availmonthto
                                        },
                                        success: function(result){
                                            if (result == "true"){
                                                $('#newleave').hide();
                                                swal('SAVE SUCCESS','New leave saved successfully!','success');
                                                setTimeout(function(){window.location.href="/leave"}, 2000);
                                            }
                                            else{
                                                $('#newleave').hide();
                                                swal('SAVE FAILED','New leave save failed!','error');
                                                setTimeout(function(){window.location.href="/leave"}, 2000);
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
    else{
        if(leavecode && leavetype && noofdays && availmonthfrom && availmonthto ){
            if(['N/A', 'N /A', 'N/ A', 'N / A', 'NA', 'N A', 'NONE', 'N O N E'].includes(leavetype) == true){
                swal('INVALID INPUT','Please enter only valid information!','error');   
            }
            else{
                
                $.ajax({
                    url: "/user/validate/update",
                    type: "POST",
                    headers: {
                    'X-CSRF-TOKEN': $("#csrf").val()
                    },
                    data: {
                        _token: $("#csrf").val(),
                        id: id,
                        fullname: fullname,
                        email: email,
                        userlevel: userlevel
                    },
                    success: function(result){
                        // alert(result);
                        if (result == "nochanges"){
                            // $('#newuser').hide();
                            swal('NO CHANGES FOUND','User details are all still the same!','error');
                            
                        }
                        else if (result == "invalid"){
                            // $('#newuser').hide();
                            swal('INVALID EMAIL','Enter a valid email address!','error');
                            
                        }
                        else if (result == "duplicate"){
                            // $('#newuser').hide();
                            swal('DUPLICATE EMAIL','Email address already exists!','error');
                            
                        }
                        else{
                            swal({
                                title: "UPDATE CURRENT USER?",
                                text: "You are about to UPDATE this current user!",
                                icon: "warning",
                                buttons: true,
                            })
                            .then((willDelete) => {
                                if(willDelete){
                                    $.ajax({
                                        url: "/user/update",
                                        type: "POST",
                                        headers: {
                                        'X-CSRF-TOKEN': $("#csrf").val()
                                        },
                                        data: {
                                            _token: $("#csrf").val(),
                                            id: id,
                                            fullname: fullname,
                                            email: email,
                                            userlevel: userlevel
                                    
                                        },
                                        success: function(result){
                                            if (result == "true"){
                                                $('#newuser').hide();
                                                swal('UPDATE SUCCESS','User updated successfully!','success');
                                                setTimeout(function(){window.location.href="/user"}, 2000);
                                            }
                                            else{
                                                $('#newuser').hide();
                                                swal('UPDATE FAILED','User update failed!','error');
                                                setTimeout(function(){window.location.href="/user"}, 2000);
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
        else{
            // $('#userform')[0].reportValidity();
            swal('REQUIRED','Fill up all required fields!','error');
        }
    }
  
});