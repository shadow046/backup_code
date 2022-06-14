var table =$('table.employeeTable').DataTable({
    ajax: {
        url: '/employee/data',
        "type": "GET"
    },
    columns: [
        
        { data: 'employee_no'},
        // { data: 'last_name' + 'first_name'},
        {
            data: null,
                "render": function(data, type, row){   
                 return([row.last_name]+' '+[row.first_name]+' '+[row.middle_name]);
            }
        },
        { data: 'branch_name'},
        { data: 'address'},
        { data: 'position'},
        { data: 'status'}

    ],
    order:[[1, 'asc']],
     });

    $(document).on('click', '#btnAddCredits', function(){
        
    $('table.leaveTable').DataTable({
        ajax: {
            url: '/employee/dataleave',
            "type": "GET",
                data: {
                    gender: $('#gender').val(),
                }
        },
        columns: [
            { data: 'code'},
            { data: 'type'},
            { data: 'no_of_days'}
        ],
        order:[[1, 'asc']],
        paging: false,
        searching: false,
        info: false,
        destroy: true
            }); 
    });

    $(document).on('click', '#btnApprovingGroup', function(){
        
        $('table.approvinggroupTable').DataTable({
            ajax: {
                url: '/employee/dataapproving',
                "type": "GET",
                    data: {
                        branchname: $('#branchname').val(),
                    }
            },
            columns: [
                { data: 'branch_code'},
                { data: 'branch_name'},
                { data: 'officer_name'},
                { data: 'user_level'}
            ],
            order:[[1, 'asc']],
            paging: false,
            searching: false,
            info: false,
            destroy: true
                }); 
        });
        $(document).on('click', '#employeeTable tbody tr', function(){

            $('#newemployee').modal({
                backdrop: 'static',
                keyboard: false
            });
            var table = $('#employeeTable').DataTable();
            var data = table.row(this).data();
            $('#id').val(data.id);
            $('#firstname').val(data.first_name);
            $('#lastname').val(data.middle_name);
            $('#middlename').val(data.last_name);
            $('#employeeno').val(data.employee_no);
            $('#gender').val(data.gender);
            $('#shift').val(data.shift);
            $('#position').val(data.position);
            $('#branchname').val(data.branch_name);
            $('#datehired').val(data.date_hired);
            $('#email').val(data.email);
            $('#contactno').val(data.contact_no);
            $('#address').val(data.address);
            $('#employeestatus').val(data.employee_status);
            $('#userlevel').val(data.level);
            $('#status').val(data.status);
            $('#btnSave').val('Update');
            alert('#id');
            return false;
            $('#newemployee').modal('show');
            $('.modal-body').html();
            $('#employeeTitle').html('UPDATE CURRENT EMPLOYEE');
           
        });

     $('.filter-input').on('keyup', function(){
        table.column($(this).data('column'))
            .search($(this).val())
            .draw();
    });

    $(document).on('click', '.closeModal', function(){
        $('#newemployee').modal('hide');
        location.reload();
    });

    $('#userlevel').on('change', function(){
        var userlevel = $('#userlevel').val();
        if(userlevel == ''){
            $('#userlevel').css({"color":"Gray"});
        }
        else{
            $('#userlevel').css({"color":"Black"});
        }
    });
    $('#status').on('change', function(){
        var status = $('#status').val();
        if(userlevel == ''){
            $('#status').css({"color":"Gray"});
        }
        else{
            $('#status').css({"color":"Black"});
        }
    });    
    $('#employeestatus').on('change', function(){
        var employeestatus = $('#employeestatus').val();
        if(employeestatus == ''){
            $('#employeestatus').css({"color":"Gray"});
        }
        else{
            $('#employeestatus').css({"color":"Black"});
        }
    });  
    $('#branchname').on('change', function(){
        var branch = $('#branchname').val();
        if(branch == ''){
            $('#branchname').css({"color":"Gray"});
        }
        else{
            $('#branchname').css({"color":"Black"});
        }
    });  
    
    $(document).on('click', '#btnAddCredits', function(){
        $('#leavecredit').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#leavecredit').modal('show');
        $('.modal-body').html();
    });
    $(document).on('click', '#btnApprovingGroup', function(){
        $('#approvinggroup').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#approvinggroup').modal('show');
        $('.modal-body').html();
    });

    // $(document).on('click', '#btnAdd', function(){
    //     var leaveCode = $('#employeeleave').val();
    //     var leaveType = $("#employeeleave option:selected").text();
    //     var noofDays = $('#noofdays').val();
    //     var markup ="<tr><td>" + leaveCode + "</td><td>" + leaveType + "</td><td>" + noofDays + "</td><td> <button type='button' style='zoom: 75%;' class='delete-row btn btn-danger bp'>REMOVE</button> </td></tr>";
    //     table = document.getElementById("leaveTable");
    //     var rows = table.rows;
    //     for (var i = 1; i < rows.length; i++) {
    //         var cols = rows[i].cells;
    //         for (var c = 0; c < cols.length; c++) {
    //             if (cols[c].innerText == leaveType) {
    //                 $('#employeeleave').val('');
    //                 $('#noofdays').val('0');
    //                 return false;
    //             }
    //         }
    //     }
        // var ctr = 'false';
        // var table = document.getElementById('leaveTable');
        // var count = table.rows.length;
        // for (i = 1; i <= count; i++) {
        //     alert($('#leaveTable').rows.item(i).cells.item(0).innerHTML);
        //     if(leaveCode==table.rows.item(i).cells.item(0).innerHTML){
        //         alert('d');
        //         $('#employeeleave').val('');
        //         $('#noofdays').val('0');
        //         ctr = 'true';
        //         return false;
        //     }
        //     else {
        //         alert('a');
        //         ctr = 'false';
        //     }
        //     if(ctr == 'false'){
        //         $("table.leaveTable tbody").append(markup);
        //     }
        //     leaveCode = $('#employeeleave').val('');
        //     noofDays = $('#noofdays').val('');
            
        // }
    //     $("table.leaveTable tbody").append(markup);
    //     leaveCode = $('#employeeleave').val('');
    //     noofDays = $('#noofdays').val('');
    // });
    // $("#leaveTable").on('click', '.delete-row', function(){
    //     $(this).closest("tr").remove();
    // });

    $(document).on('click', '#btnReset', function(){
        $('#employeeleave').val('');
        $('#noofdays').val('0');
        $("#leaveTable tbody tr").remove();
    });

    $('#employeeleave').on('change', function(){
        var leaveCode = this.value;
        $.ajax({
            url: "/employee/leave",
            type: "GET",
            async:false,
            data: {
                leaveCode: leaveCode,
                 _token: '{{csrf_token()}}' 
            },
            success: function(result){
            $('#noofdays').val(result);
               
               
            },
            error: function(data){
                if(data.status == 401){
                    window.location.reload;
                }
                alert(data.responseText);
            }
        });
    });    

    $(document).on('click', '#btnSave', function(){
        
        var id =$('#id').val();
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var middlename = $('#middlename').val();
        var employeeno = $('#employeeno').val();
        var gender = $('#gender').val();
        var shift = $('#shift').val();
        var position = $('#position').val();
        var branchname = $('#branchname').val();
        var datehired = $('#datehired').val();
        var email = $('#email').val();
        var contactno = $('#contactno').val();
        var address = $('#address').val();
        var employeestatus = $('#employeestatus').val();
        var userlevel = $('#userlevel').val();
        var status = $('#status').val();
        var btnSave = $('#btnSave').val();
        

        if(btnSave == 'Save'){
            if(firstname=='' || address=='' || employeeno=='' || gender=='' || shift=='' || 
            position==''|| middlename=='' || lastname=='' || status==''|| datehired =='' ||
            branchname==''|| email==''|| contactno=='' || employeestatus=='' || userlevel==''){
                swal('REQUIRED','Fill up all required fields!','error');
            }
            else{
                if(['N/A', 'N /A', 'N/ A', 'N / A', 'NA', 'N A', 'NONE', 'N O N E'].includes(firstname) == true){
                    swal('INVALID INPUT','Please enter only valid information!','error');    
                }
                else{
                    swal({
                        title: "ADD NEW EMPLOYEE?",
                        text: "You are about to ADD a new employee!",
                        icon: "warning",
                        buttons: true,
                    })
                    .then((willDelete) => {
                        if(willDelete){
                            $.ajax({
                                url: "/employee/save",
                                type: "POST",
                                headers: {
                                // 'X-CSRF-TOKEN': $("#csrf").val()
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    _token: $("#csrf").val(),
                                    firstname: firstname,
                                    lastname: lastname,
                                    middlename: middlename,
                                    employeeno: employeeno,
                                    gender: gender,
                                    shift: shift,
                                    position: position,
                                    branchname: branchname,
                                    datehired: datehired,
                                    email: email,
                                    contactno: contactno,
                                    address: address,
                                    employeestatus: employeestatus,
                                    userlevel: userlevel,
                                    status: status
                                },
                                success: function(result){
                                    if (result == "true"){
                                        $('#newemployee').hide();
                                        swal('SAVE SUCCESS','New employee saved successfully!','success');
                                        setTimeout(function(){window.location.href="/employee"}, 2000);
                                    }
                                    else{
                                        $('#newemployee').hide();
                                        swal('SAVE FAILED','New employee save failed!','error');
                                        setTimeout(function(){window.location.href="/employee"}, 2000);
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
            if(firstname=='' || address=='' || employeeno=='' || gender=='' || shift=='' || 
            position==''|| middlename=='' || lastname=='' || status==''|| datehired =='' ||
            branchname==''|| email==''|| contactno=='' || employeestatus=='' || userlevel==''){
                swal('REQUIRED','Fill up all required fields!','error');
            }
            else{
                if(['N/A', 'N /A', 'N/ A', 'N / A', 'NA', 'N A', 'NONE', 'N O N E'].includes(firstname) == true){
                    swal('INVALID INPUT','Please enter only valid information!','error');
                }
                else{
                    swal({
                        title: "UPDATE CURRENT EMPLOYEE",
                        text: "You are about to UPDATE this current employee",
                        icon: "warning",
                        buttons: true,
                    })
                    .then((willDelete) => {
                        if(willDelete){
                            $.ajax({
                                url: "/employee/update",
                                type: "POST",
                                headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    _token: $("#csrf").val(),
                                    id:id,
                                    firstname: firstname,
                                    lastname: lastname,
                                    middlename: middlename,
                                    employeeno: employeeno,
                                    gender: gender,
                                    shift: shift,
                                    position: position,
                                    branchname: branchname,
                                    datehired: datehired,
                                    email: email,
                                    contactno: contactno,
                                    address: address,
                                    employeestatus: employeestatus,
                                    userlevel: userlevel,
                                    status: status
                                },
                                success: function(result){
                                    if (result == "true"){
                                        $('#newemployee').hide();
                                        swal('UPDATE SUCCESS','Employee updated successfully!','success');
                                        setTimeout(function(){window.location.href="/employee"}, 2000);
                                    }
                                    else{
                                        $('#newemployee').hide();
                                        swal('UPDATE FAILED','Employee update failed!','error');
                                        setTimeout(function(){window.location.href="/employee"}, 2000);
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
    });