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
            
            {
                data: null,
                    "render": function(data, type, row){
                    var datetoday = row.to_month;
                return(month[row.from_month]+' to '+month[row.to_month]);
                }
            },
            { data: 'activation'},
            { data: 'expiration'},
            { data: 'no_of_days_prior_avail'},
            { data: 'from_month', visible: false},
            { data: 'to_month', visible: false}
        ],
        order:[[2, 'asc']],
    });
} );
$(document).on('click', '.closeModal', function(){
    $('#newleave').modal('hide');
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
    $('#activation').val(data.id);
    $('#expiration').val(data.expiration);
    $('#noofdaystoavail').val(data.no_of_days_prior_avail);
});

$(document).on('click', '#btnSave', function(){
    var id = $('#id').val();
    var leavecode = $('#leavecode').val();
    var leavetype = $('#leavetype').val();
    var noofdays = $('#noofdays').val();
    var availmonthfrom = $('#availmonthfrom').val();
    var availmonthto = $('#availmonthto').val();
    var activation = $('#activation').val();
    var expiration = $('#expiration').val();
    var noofdaystoavail = $('#noofdaystoavail').val();
    var btnSave = $('#btnSave').val();
    
    if(btnSave == 'Save'){
        if(leavecode=='' || leavetype=='' || noofdays=='' || availmonthfrom=='' ||
         availmonthto==''|| noofdaystoavail==''|| activation==''|| expiration==''){
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
                        availmonthto: availmonthto,
                        noofdaystoavail: noofdaystoavail,
                        activation: activation,
                        expiration: expiration
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
                                            availmonthto: availmonthto,
                                            noofdaystoavail: noofdaystoavail,
                                            activation: activation,
                                            expiration: expiration
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
        if(leavecode && leavetype && noofdays && availmonthfrom && availmonthto && noofdaystoavail){
            if(['N/A', 'N /A', 'N/ A', 'N / A', 'NA', 'N A', 'NONE', 'N O N E'].includes(leavetype) == true){
                swal('INVALID INPUT','Please enter only valid information!','error');   
            }
            else{
                
                $.ajax({
                    url: "/leave/validate/update",
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
                        availmonthto: availmonthto,
                        noofdaystoavail: noofdaystoavail
                    },
                    success: function(result){
                        // alert(result);
                        if (result == "nochanges"){
                            // $('#newuser').hide();
                            swal('NO CHANGES FOUND','Leave details are all still the same!','error');  
                        }
                        else if (result == "duplicate"){
                            // $('#newuser').hide();
                            swal('DUPLICATE LEAVE TYPE','Leave type already exists!','error');
                        }
                        else{
                            swal({
                                title: "UPDATE CURRENT LEAVE?",
                                text: "You are about to UPDATE this current leave!",
                                icon: "warning",
                                buttons: true,
                            })
                            .then((willDelete) => {
                                if(willDelete){
                                    $.ajax({
                                        url: "/leave/update",
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
                                            availmonthto: availmonthto,
                                            noofdaystoavail: noofdaystoavail
                                        },
                                        success: function(result){
                                            if (result == "true"){
                                                $('#newuser').hide();
                                                swal('UPDATE SUCCESS','Leave updated successfully!','success');
                                                setTimeout(function(){window.location.href="/leave"}, 2000);
                                            }
                                            else{
                                                $('#newuser').hide();
                                                swal('UPDATE FAILED','Leave update failed!','error');
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
        else{
            // $('#userform')[0].reportValidity();
            swal('REQUIRED','Fill up all required fields!','error');
        }
    }
  
});