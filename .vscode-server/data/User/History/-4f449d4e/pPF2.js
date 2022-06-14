var branchid;
$(document).ready(function() {

  $('table.branchTable').DataTable({
        ajax: {
            url: '/branch/data',
            "type": "GET"
        },
        columns: [
            
            { data: 'branch_code'},
            { data: 'branch_name'},
            { data: 'address'},
            { data: 'Province'},
            { data: 'City'},
            { data: 'Region'},
            { data: 'status'}
        ],
        order:[[3, 'asc']],
    });

     // Setup - add a text input to each footer cell
     $('table.branchTable tfoot th').each( function (i) {
        var title = $('branchTable thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="'+title+'" data-index="'+i+'" />' );
    } );
  
    // DataTable
    var table = $('branchTable').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   true
    } );
 
    // Filter event handler
    $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
        table
            .column( $(this).data('branch_code') )
            .column( $(this).data('branch_name') )
            .column( $(this).data('address') )
            .column( $(this).data('Province') )
            .column( $(this).data('City') )
            .column( $(this).data('Region') )
            .column( $(this).data('status') )
            .search( this.value )
            .draw();
    } );
    
});

    $('#province').on('change', function(){
    var provincecode = this.value;
    // var country_id = $('#province').val();
    $("#city").html('');
    $.ajax({
        url: "/branch/city",
        type: "GET",
        async:false,
        data: {
            provincecode: provincecode,
             _token: '{{csrf_token()}}' 
        },
        dataType : 'json',
        success: function(result){
            $("#city").append('<option value="" selected disabled style="color: Gray;">Select City</option>');
            $.each(result.refcitymuns,function(key,value){
            $("#city").append('<option value="'+value.citymunCode+'">'+value.citymunDesc+'</option>');
            });
            // $('#region').html('<option value="">Select State First</option>'); 
        },
        error: function(data){
            if(data.status == 401){
                window.location.reload;
            }
            alert(data.responseText);
        }
    });
});

$('#city').on('change', function(){
    var citymunCode = this.value;
    // var country_id = $('#province').val();
    $("#region").html('');
    $.ajax({
        url: "/branch/region",
        type: "GET",
        async:false,
        data: {
            citymunCode: citymunCode,
             _token: '{{csrf_token()}}' 
        },
        dataType : 'json',
        success: function(result){
            $.each(result.refregions,function(key,value){
            $("#region").append('<option value="'+value.regCode+'">'+value.regDesc+'</option>');
            });
            // $('#region').html('<option value="">Select State First</option>'); 
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
    $('#newbranch').modal('hide');
    location.reload();
});
$(document).on('click', '#branchTable tbody tr', function(){
   
    $('#newbranch').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#newbranch').modal('show');
    $('.modal-body').html();
    $('#branchTitle').html('UPDATE CURRENT BRANCH');
    $('#btnSave').val('Update');
    
    var table = $('#branchTable').DataTable();
    var data = table.row(this).data();
    // console.log(data);
    branchid = data.id;
    $('#branchcode').val(data.branch_code);
    $('#branchname').val(data.branch_name);
    $('#address').val(data.address);
    $('#province').val(data.provCode);
    $('#province').change();
    $('#city').val(data.citymunCode);
    $('#city').change();
    $('#region').val(data.regCode);
    $('#status').val(data.status);
  
});

$(document).on('click', '#btnSave', function(){

    
    var branchcode = $('#branchcode').val();
    var branchname = $('#branchname').val();
    var address = $('#address').val();
    var province = $('#province').val();
    var city = $('#city').val();
    var region = $('#region').val();
    var status = $('#status').val();
    var btnSave = $('#btnSave').val();
    
    if(btnSave == 'Save'){
        if(branchcode=='' || branchname=='' || address=='' || province==''|| city=='' || region=='' || status==''){
            swal('REQUIRED','Fill up all required fields!','error');
        }
        else{
            if(['N/A', 'N /A', 'N/ A', 'N / A', 'NA', 'N A', 'NONE', 'N O N E'].includes(branchname) == true){
                swal('INVALID INPUT','Please enter only valid information!','error');    
            }
            else{
                swal({
                    title: "ADD NEW BRANCH?",
                    text: "You are about to ADD a new branch!",
                    icon: "warning",
                    buttons: true,
                })
                .then((willDelete) => {
                    if(willDelete){
                        $.ajax({
                            url: "/branch/save",
                            type: "POST",
                            headers: {
                            'X-CSRF-TOKEN': $("#csrf").val()
                            },
                            data: {
                                _token: $("#csrf").val(),
                                branchcode: branchcode,
                                branchname: branchname,
                                address: address,
                                province: province,
                                city: city,
                                region: region,
                                status: status
                            },
                            success: function(result){
                                if (result == "true"){
                                    $('#newbranch').hide();
                                    swal('SAVE SUCCESS','New branch saved successfully!','success');
                                    setTimeout(function(){window.location.href="/branch"}, 2000);
                                }
                                else{
                                    $('#newbranch').hide();
                                    swal('SAVE FAILED','New branch save failed!','error');
                                    setTimeout(function(){window.location.href="/branch"}, 2000);
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
        if(branchcode=='' || branchname=='' || address=='' || province==''|| city=='' || region=='' || status==''){
            swal('REQUIRED','Fill up all required fields!','error');
        }
        else{
            
            if(['N/A', 'N /A', 'N/ A', 'N / A', 'NA', 'N A', 'NONE', 'N O N E'].includes(branchcode) == true){
                // alert('UPDATE');
                // return false;
                swal('INVALID INPUT','Please enter only valid information!','error');
            }
            else{
                swal({
                    title: "UPDATE CURRENT BRANCH",
                    text: "You are about to UPDATE this current branch!",
                    icon: "warning",
                    buttons: true,
                })
                .then((willDelete) => {
                    if(willDelete){
                        $.ajax({
                            url: "/branch/update",
                            type: "POST",
                            headers: {
                            'X-CSRF-TOKEN': $("#csrf").val()
                            },
                            data: {
                                _token: $("#csrf").val(),
                                id: branchid,
                                branchcode: branchcode,
                                branchname: branchname,
                                address: address,
                                province: province,
                                city: city,
                                region: region,
                                status: status
                            },
                            success: function(result){
                                if (result == "true"){
                                    $('#newbranch').hide();
                                    swal('UPDATE SUCCESS','Branch updated successfully!','success');
                                    setTimeout(function(){window.location.href="/branch"}, 2000);
                                }
                                else{
                                    $('#newbranch').hide();
                                    swal('UPDATE FAILED','Branch update failed!','error');
                                    setTimeout(function(){window.location.href="/branch"}, 2000);
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