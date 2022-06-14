var table;
$(document).ready( function () {
 table = $('table.userTable').DataTable({
        ajax: {
            url: '/user/data',
        },
        columnDefs: [
        {
            targets: [0],
            visible: false,
            searchable: false
        }],
        columns: [
            { data: 'id'},
            { data: 'name' },
            { data: 'email'},
            { data: 'userlevel'},
            { data: 'status'}
        ],
        order:[[1, 'asc']],
    });
} );

$('#userlevel').on('change', function(){
    var userlevel = $('#userlevel').val();
    if(userlevel == ''){
        $('#userlevel').css({"color":"Gray"});
    }
    else{
        $('#userlevel').css({"color":"Black"});
    }
});

$(document).on('click', '#btnAddUser', function(){
    $('#newuser').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#newuser').modal('show');
    $('.modal-body').html();
    $('#userTitle').html('CREATE NEW USER');
    $('.hidepass').show();

    $('#btnDelete').hide();
    $('#btnSave').val('Save');
    $('#fullname').val('');
    $('#password').val('');
    $('#email').val('');
    $('#userlevel').val('');
    $('#status').val('');
});

$(document).on('click', '#userTable tbody tr', function(){
    $('#newuser').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#newuser').modal('show');
    $('.modal-body').html();
    $('#userTitle').html('UPDATE CURRENT USER');
    $('.hidepass').hide();
    $('#btnDelete').show();
    $('#btnSave').val('Update');
    
    var table = $('#userTable').DataTable();
    var data = table.row(this).data();
    $('#id').val(data.id);
    $('#fullname').val(data.name);
    $('#email').val(data.email);
    $('#userlevel').val(data.userlevel);
    $('#status').val(data.status);
    // var table = $('#userTable').DataTable();
    // var data = table.row(this).data();
    // $('#userlevel').val(data.);
});

$(document).on('click', '#btnDelete', function(){
    var id = $('#id').val();
    $.ajax({
        url: "/user/delete",
        type: "POST",
        headers: {
        'X-CSRF-TOKEN': $("#csrf").val()
        },
        data: {
            _token: $("#csrf").val(),
            id: id
        },
        success: function(data){
            if (data== "true"){
                $('#newuser').hide();
                swal('DELETE SUCCESS','User deleted successfully!','success');
                setTimeout(function(){window.location.href="/user"}, 2000);
            }
            else{
                $('#newuser').hide();
                swal('DELETE FAILED','User delete failed!','success');
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
});

$(document).on('click', '.closeModal', function(){
    $('#newuser').modal('hide');
    // location.reload();
});

$(document).on('click', '#btnSave', function(){
    var id = $('#id').val();
    var fullname = $.trim($('#fullname').val().toUpperCase());
    var email = $.trim($('#email').val().toLowerCase());
    var password = $('#password').val();
    var userlevel = $('#userlevel').val();
    var status = $('#status').val();
    var btnSave = $('#btnSave').val();
    
    if(btnSave == 'Save'){
        if(fullname=='' || email=='' || password=='' || userlevel=='' ){
            swal('REQUIRED','Fill up all required fields!','error');
        }
        else{
            if(['N/A', 'N /A', 'N/ A', 'N / A', 'NA', 'N A', 'NONE', 'N O N E'].includes(fullname) == true){
                swal('INVALID INPUT','Please enter only valid information!','error');   
            }
            else{
                $.ajax({
                    url: "/user/validate/user",
                    type: "POST",
                    headers: {
                    'X-CSRF-TOKEN': $("#csrf").val()
                    },
                    data: {
                        _token: $("#csrf").val(),
                        id: id,
                        fullname: fullname,
                        email: email,
                        userlevel: userlevel,
                        status: status
                    },
                    success: function(result){
                        // alert(result);
                        if (result == "invalid"){
                            // $('#newuser').hide();
                             swal('INVALID EMAIL','Enter a valid email address!','error');   
                            
                        }
                         else if (result == "duplicate"){
                            // $('#newuser').hide();
                            swal('DUPLICATE EMAIL','Email address already exists!','error');   
                                         
                        }
                        else{
                            swal({
                                title: "ADD NEW USER?",
                                text: "You are about to ADD a new user!",
                                icon: "warning",
                                buttons: true,
                            })
                            .then((willDelete) => {
                                if(willDelete){
                                    $('.closeModal').click();
                                    $.ajax({
                                        url: "/user/save",
                                        type: "POST",
                                        headers: {
                                        'X-CSRF-TOKEN': $("#csrf").val()
                                        },
                                        data: {
                                            _token: $("#csrf").val(),
                                                fullname: fullname,
                                                email: email,
                                                password: password,
                                                userlevel: userlevel,
                                                status: status
                                        },
                                        success: function(result){
                                            if (result == "true"){
                                                // $('#newuser').hide();
                                                // $('#newuser').modal('dispose');
                                                swal('SAVE SUCCESS','New user saved successfully!','success');
                                                // setTimeout(function(){window.location.href="/user"}, 2000);
                                                table.ajax.reload(null, false);
                                            }
                                            else{
                                                // $('#newuser').hide();
                                                // $('#newuser').modal('dispose');
                                                swal('SAVE FAILED','New user save failed!','error');
                                                // setTimeout(function(){window.location.href="/user"}, 2000);
                                                table.ajax.reload(null, false);
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

                // swal({
                //     title: "ADD NEW USER?",
                //     text: "You are about to ADD a new user!",
                //     icon: "warning",
                //     buttons: true,
                // })
                // .then((willDelete) => {
                //     if(willDelete){
                //         $.ajax({
                //             url: "/user/save",
                //             type: "POST",
                //             headers: {
                //             'X-CSRF-TOKEN': $("#csrf").val()
                //             },
                //             data: {
                //                 _token: $("#csrf").val(),
                //                 fullname: fullname,
                //                 email: email,
                //                 password: password,
                //                 userlevel: userlevel
                        
                //             },
                //             success: function(result){
                //                 if (result == "true"){
                //                     $('#newuser').hide();
                //                     swal('SAVE SUCCESS','New user saved successfully!','success');
                //                      setTimeout(function(){window.location.href="/user"}, 2000);
                //                 }
                //                 else if (result == "invalid"){
                //                     $('#newuser').hide();
                //                     swal('INVALID EMAIL','Enter a valid email address!','error');
                                    
                //                 }
                //                 else if (result == "duplicate"){
                //                     $('#newuser').hide();
                //                     swal('DUPLICATE EMAIL','Email address already exists!','error');
                                    
                //                 }
                //                 else{
                //                     $('#newuser').hide();
                //                     swal('SAVE FAILED','New user save failed!','error');
                //                      setTimeout(function(){window.location.href="/user"}, 2000);
                //                 }
            
                //             },
                //             error: function(data){
                //                 if(data.status == 401){
                //                     window.location.reload;
                //                 }
                //                 alert(data.responseText);
                //             }
                //         });
                //     }
                // });
            }
        }
    }
    else{
        if(fullname && email && userlevel ){
            if(['N/A', 'N /A', 'N/ A', 'N / A', 'NA', 'N A', 'NONE', 'N O N E'].includes(fullname) == true){
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
                        userlevel: userlevel,
                        status: status
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
                                  $('.closeModal').click();
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
                                            userlevel: userlevel,
                                            status: status
                                        },
                                        success: function(result){
                                            if (result == "true"){
                                                // $('#newuser').modal('hide');
                                                // $('#newuser').modal('dispose');
                                                swal('UPDATE SUCCESS','User updated successfully!','success');
                                                // setTimeout(function(){window.location.href="/user"}, 2000);
                                                table.ajax.reload(null, false);
                                            }
                                            else{
                                                // $('#newuser').hide();
                                                // $('#newuser').modal('hide');
                                                // $('#newuser').modal('dispose');
                                                swal('UPDATE FAILED','User update failed!','error');
                                                // setTimeout(function(){window.location.href="/user"}, 2000);
                                                table.ajax.reload(null, false);
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
    // else{
    //     if(fullname && email && userlevel ){
    //         if(['N/A', 'N /A', 'N/ A', 'N / A', 'NA', 'N A', 'NONE', 'N O N E'].includes(fullname) == true){
    //             swal('INVALID INPUT','Please enter only valid information!','error');   
    //         }
    //         else{
    //             swal({
    //                 title: "UPDATE CURRENT USER?",
    //                 text: "You are about to UPDATE this current user!",
    //                 icon: "warning",
    //                 buttons: true,
    //             })
    //             .then((willDelete) => {
    //                 if(willDelete){
    //                     $.ajax({
    //                         url: "/user/update",
    //                         type: "POST",
    //                         headers: {
    //                         'X-CSRF-TOKEN': $("#csrf").val()
    //                         },
    //                         data: {
    //                             _token: $("#csrf").val(),
    //                             id: id,
    //                             fullname: fullname,
    //                             email: email,
    //                             userlevel: userlevel
    //                         },
    //                         success: function(result){
    //                             // alert(result);
    //                             if (result== "true"){
    //                                 $('#newuser').hide();
    //                                 swal('UPDATE SUCCESS','User updated successfully!','success');
    //                                 setTimeout(function(){window.location.href="/user"}, 2000);
    //                             }
    //                             else if (result == "nochanges"){
    //                                 $('#newuser').hide();
    //                                 swal('NO CHANGES FOUND','User details are all still the same!','error');
    //                                 setTimeout(function(){window.location.href="/user"}, 2000);
    //                             }
    //                             else if (result == "invalid"){
    //                                 $('#newuser').hide();
    //                                 swal('INVALID EMAIL','Enter a valid email address!','error');
    //                                 setTimeout(function(){window.location.href="/user"}, 2000);
    //                             }
    //                             else if (result == "duplicate"){
    //                                 $('#newuser').hide();
    //                                 swal('DUPLICATE EMAIL','Email address already exists!','error');
    //                                 setTimeout(function(){window.location.href="/user"}, 2000);
    //                             }
    //                             else{
    //                                 $('#newuser').hide();
    //                                 swal('UPDATE FAILED','User update failed!','error');
    //                                 setTimeout(function(){window.location.href="/user"}, 2000);
    //                             }
            
    //                         },
    //                         error: function(data){
    //                             if(data.status == 401){
    //                                 window.location.reload;
    //                             }
    //                             alert(data.responseText);
    //                         }
    //                     });
    //                 }

    //             });
    //         }
    //     }
    //     else{
    //         // $('#userform')[0].reportValidity();
    //         swal('REQUIRED','Fill up all required fields!','error');
    //     }
    // }
});