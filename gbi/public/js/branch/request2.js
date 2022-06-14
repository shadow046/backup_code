$(document).on('click', '#del_Btn', function(){
    var reqno = $(this).attr('reqno');
    $('#loading').show();
    $.ajax({
        url: 'remove',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
        },
        dataType: 'json',
        type: 'DELETE',
        data: {
            reqno : reqno                     
        },
        success: function(){
            location.reload();
        },
        error: function (data) {
            if(data.status == 401) {
                window.location.href = '/login';
            }
            alert(data.responseText);
        }
    });
});
$(document).on('click', '#rec_Btn', function(){
    var reqno = requestno;
    var sched = $('#sched').val();
    $('#loading').show();
    if(dtdata.status == "IN TRANSIT" || dtdata.status == "INCOMPLETE"){
        var status = "COMPLETED";
    }else if(dtdata.status == "PARTIAL IN TRANSIT" || dtdata.status == "PARTIAL SCHEDULED"){
        var status = "PARTIAL IN TRANSIT";
    }
    var datas = intransittable.rows( { selected: true } ).data();
    var id = [];
    var eachcount = 0;
    if(datas.length > 0){
        var mydata = $.map(datas, function(value, index) {
            return [value];
        });
        mydata.forEach(value => {
            eachcount++;
            if (value.uom == 'Unit' ) {
                id.push(value.id);
                if (eachcount == datas.length) {
                    $.ajax({
                        url: 'storerreceived',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            reqno : reqno,
                            id: id,
                            status: status,
                            sched: sched,
                            Unit: 'yes',
                        },
                        success: function(){
                            location.reload();
                        },
                        error: function (data) {
                            if(data.status == 401) {
                                window.location.href = '/login';
                            }
                            alert(data.responseText);
                        }
                    });
                }
            }else if(value.uom != 'Unit'){
                var itemsid = value.items_id;
                $.ajax({
                    type:'get',
                    url: 'getcon',
                    dataType: 'json',
                    async: false,
                    data: {
                        reqno : reqno,
                        itemsid: itemsid                        
                    },
                    success:function(data)
                    {
                        data.forEach(valv => {
                            id.push(valv.id);
                        });
                        if (eachcount == datas.length) {
                            $.ajax({
                                url: 'storerreceived',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
                                },
                                dataType: 'json',
                                type: 'POST',
                                data: {
                                    reqno : reqno,
                                    id: id,
                                    status: status,
                                    sched: sched,
                                    Unit: 'no'
                                },
                                success: function(){
                                    location.reload();
                                },
                                error: function (data) {
                                    if(data.status == 401) {
                                        window.location.href = '/login';
                                    }
                                    alert(data.responseText);
                                }
                            });
                        }
                    },
                    error: function (data) {
                        if(data.status == 401) {
                            window.location.href = '/login';
                        }
                        alert(data.responseText);
                    }
                });
            }
        });    
    }
});
$(document).on('click', '#reqBtn', function(){
    $.ajax({
        type:'get',
        url:'gen',
        success:function(result)
        {
            $('#sreqno').val(result);
            reqstock = result;
            reqno = result;
            $.ajax({
                url: 'checkrequest',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
                },
                dataType: 'json',
                type: 'GET',
                async:false,
                data: {
                    reqno : reqno,
                },
                success: function(data){
                    if(data != "wala pa"){
                        $('#sreqno').val(data);
                        reqno = data;
                        checkrequest = 'meron';
                    }
                },
                error: function (data) {
                    if(data.status == 401) {
                        window.location.href = '/login';
                    }
                    alert(data.responseText);
                }
            });
        },
    });
    $('#loading').show()
    setTimeout(function() { 
        $('#loading').delay(2000).hide()
        $('#sendrequestModal').modal({backdrop: 'static', keyboard: false}); 
        if($('#level').val() == 'Tech'){
            $('#requesttype').val('Service').change();
        }
    }, 3000);
    
});
$(document).on('click', '.add_item', function(){
    var rowcount = $(this).attr('btn_id');
    if ($(this).val() == 'Add Item') {
        if($('#qty'+rowcount).val() != 0){
            if($('#item'+rowcount).val()){
                y++;
                add++;
                var additem = '<div class="row no-margin" id="row'+y+'"><div class="col-md-2 form-group"><select id="category'+y+'" style="color: black;" class="form-control category" row_count="'+y+'"></select></div><div class="col-md-2 form-group" id="itemdiv'+y+'" style="display:none"><select id="item'+y+'" style="color: black;" class="form-control item" row_count="'+y+'"><option selected disabled>select item code</option></select></div><div class="col-md-3 form-group"><select id="desc'+y+'" class="form-control desc" style="color: black;" row_count="'+y+'"><option selected disabled>select item description</option></select></div><div class="col-md-1 form-group"><input type="number" min="0" class="form-control" style="color: black; width: 6em" name="qty'+y+'" id="qty'+y+'" placeholder="0" disabled></div><div class="col-md-2 form-group text-center"><input type="text" class="form-control" name="uom'+y+'" id="uom'+y+'" style="color:black;"readonly></div><div class="col-md-1 form-group"><input type="button" class="add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>'
                $(this).val('Remove');
                $('#category'+ rowcount).prop('disabled', true);
                $('#item'+ rowcount).prop('disabled', true);
                $('#desc'+ rowcount).prop('disabled', true);
                $('#qty'+ rowcount).prop('disabled', true);
                $('#reqfield').append(additem);
                $('#category'+ rowcount).find('option').clone().appendTo('#category'+y);
                console.log('pasok');
            }else{
                alert("Please Select Item!");
            }
        }else{
            alert("Invalid Quantity value!");
        }
    }else{
        add--;
        $('#category'+rowcount).val('select category');
        $('#item'+rowcount).val('select item code');
        $('#desc'+rowcount).val('select item description');
        $('#serial'+rowcount).val('select serial');
        $('#category'+rowcount).prop('disabled', false);
        $('#item'+rowcount).prop('disabled', false);
        $('#desc'+rowcount).prop('disabled', false);
        $('#serial'+rowcount).prop('disabled', false);
        $('#row'+rowcount).hide();
        $(this).val('Add Item');
    }
    if (add == 0) {
        $('#send_sub_Btn').prop('disabled', true);
        $('#requesttype').prop('disabled', false);
    }else{
        $('#send_sub_Btn').prop('disabled', false);
        $('#requesttype').prop('disabled', true);
    }
});
$(document).on('click', '.send_sub_Btn', function(){
    if (add == 0 || sub > 0) {
        alert('Please add item/s.');
        return false;
    }
    var item = "";
    var qty = "";
    var stat = "notok";
    
    if (!$('#requesttype').val()) {
        alert('Please Select request type!');
        return false;
    }else if ($('#requesttype').val() == "Service" && $('#customer-id').val() == "") {
        alert('Please Select the correct Customer Name!');
        return false;
    }else if ($('#requesttype').val() == "Service" && $('#ticket').val() == "") {
        alert('Please input ticket number!');
        return false;
    }
    $('#sendrequestModal').modal('toggle');
    $('#loading').show();
    if ($('#requesttype').val() == "Service") {
        reqno = reqstock;
    }
    for(var q=1;q<=y;q++){
        if ($('#row'+q).is(":visible")) {
            if ($('.add_item[btn_id=\''+q+'\']').val() == 'Remove') {
                sub++;
                cat = $('#category'+q).val();
                item = $('#item'+q).val();
                desc = $('#desc'+q).val();
                qty = $('#qty'+q).val();
                $.ajax({
                    url: 'storerequest',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        reqno : reqno,
                        item: item,
                        qty: qty,
                        stat: stat,
                        check: checkrequest,                       
                    },
                    error: function (data) {
                        if(data.status == 401) {
                            window.location.href = '/login';
                        }
                        alert(data.responseText);
                    }
                });
            }
        }
        if (q == y) {
            var ticketno;
            var customer;
            var client;
            if ($('#requesttype').val() == "Service") {
                ticketno = $('#ticket').val();
                client = $('#client-id').val();
                customer = $('#customer-id').val();
            }
            stat = "ok";
            $.ajax({
                url: 'storerequest',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
                },
                dataType: 'json',
                type: 'POST',
                data: {
                    reqno : reqno,
                    clientid : client,  
                    customerid : customer,  
                    ticket : ticketno,  
                    type : $('#requesttype').val(),  
                    stat: stat                     
                },
                success: function(){
                    if (checkrequest == 'meron') {
                        alert('ATTENTION: Your new stock request was added to your previous pending request with Request No. '+reqno);
                    }
                    window.location.href = 'request';
                },
                error: function (data) {
                    if(data.status == 401) {
                        window.location.href = '/login';
                    }
                    alert(data.responseText);
                }
            });
        }
    }
});
$(document).on('change', '.desc', function(){
    var count = $(this).attr('row_count');
    var id = $(this).val();
    $('#item' + count).val(id);
    $('#qty'+count).val('0');
    $('#qty'+count).prop('disabled', false);
    $.ajax({
        type:'get',
        url:'uom',
        data:{
            id: id
        },
        success:function(data)
        {
            $('#uom'+count).val(data);
        },
        error: function (data) {
            if(data.status == 401) {
                window.location.href = '/login';
            }
            alert(data.responseText);
        }
    });
});
$(document).on('change', '.item', function(){
    var count = $(this).attr('row_count');
    var id = $(this).val();
    $('#desc' + count).val(id);
    $('#qty'+count).prop('disabled', false);
    $('#qty'+count).val('0');
    $.ajax({
        type:'get',
        url:'uom',
        data:{
            id: id
        },
        success:function(data)
        {
            $('#uom'+count).val(data);
        },
        error: function (data) {
            if(data.status == 401) {
                window.location.href = '/login';
            }
            alert(data.responseText);
        }
    });
});
$(document).on('change', '.category', function(){
    var codeOp = " ";
    var descOp = " ";
    var count = $(this).attr('row_count');
    var id = $(this).val();
    $('#stock' + count).val('Stock');
    if ($('#requesttype').val() == 'Stock') {
        $.ajax({
            type:'get',
            url:'getcode',
            data:{'id':id},
            success:function(data)
            {
                var itemcode = $.map(data, function(value, index) {
                    return [value];
                });
                codeOp+='<option selected disabled>select item code</option>';
                descOp+='<option selected disabled>select item description</option>';
                itemcode.forEach(value => {
                    codeOp+='<option value="'+value.id+'">'+value.id+'</option>';
                    descOp+='<option value="'+value.id+'">'+value.item.toUpperCase()+'</option>';
                });
                $("#item" + count).find('option').remove().end().append(codeOp);
                $("#desc" + count).find('option').remove().end().append(descOp);
                itemcode.forEach(value => {
                    for(var g=1;g<=count;g++){
                        if (value.id == $("#item" + g).val()) {
                            $('#item'+count+' option[value='+value.id+']').remove()
                            $('#desc'+count+' option[value='+value.id+']').remove()
                        }
                    }
                });
            },
            error: function (data) {
                if(data.status == 401) {
                    window.location.href = '/login';
                }
                alert(data.responseText);
            }
        });
    }else if ($('#requesttype').val() == 'Service') {
        $.ajax({
            type:'get',
            url:'servicerequest',
            data:{'id':id},
            success:function(data)
            {   
                if (data.length != "0") {
                    var itemcode = $.map(data, function(value, index) {
                        return [value];
                    });
                    codeOp+='<option selected disabled>select item code</option>';
                    descOp+='<option selected disabled>select item description</option>';
                    itemcode.forEach(value => {
                        codeOp+='<option value="'+value.id+'">'+value.id+'</option>';
                        descOp+='<option value="'+value.id+'">'+value.item.toUpperCase()+'</option>';
                    });
                    $("#item" + count).find('option').remove().end().append(codeOp);
                    $("#desc" + count).find('option').remove().end().append(descOp);
                    itemcode.forEach(value => {
                        for(var g=1;g<=count;g++){
                            if (value.id == $("#item" + g).val()) {
                                $('#item'+count+' option[value='+value.id+']').remove()
                                $('#desc'+count+' option[value='+value.id+']').remove()
                            }
                        }
                    });
                }
            },
            error: function (data) {
                if(data.status == 401) {
                    window.location.href = '/login';
                }
                alert(data.responseText);
            }
        });
    }
    $('#qty'+count).val('0');
});
$(document).on('click', '.close', function(){
    location.reload();
});
$(document).on('click', '.cancel', function(){
    location.reload();
});
$(document).on('change', '#requesttype', function(){
    var catop;
    var desc;
    $('.requesttype').show();
    desc+='<option selected disabled>select item description</option>';
    $("#desc1").find('option').remove().end().append(desc);
    if ($(this).val() == 'Stock') {
        $('#clientrow').hide();
        $('#ticketrow').hide();
        catop+='<option selected disabled>select category</option>';
        stockcat.forEach(value => {
            catop+='<option value="'+value.id+'">'+value.category.toUpperCase()+'</option>';
        });
        $("#category1").find('option').remove().end().append(catop);
        $('#sreqno').val(reqno);
    }else if ($(this).val() == 'Service'){
        $('#ticketrow').show();
        $('#clientrow').show();
        catop+='<option selected disabled>select category</option>';
        servicecat.forEach(value => {
            catop+='<option value="'+value.id+'">'+value.category.toUpperCase()+'</option>';
        });
        $("#category1").find('option').remove().end().append(catop);
        $('#sreqno').val(reqstock);
    }
});
$(document).on('keyup', '#client', function(){
    var id = $(this).val();
    var op = " ";
    $('#customer').val('');
    $('#customer-id').val('');
    $("#customer-name").find('option').remove();
    $.ajax({
        type:'get',
        url:'client-autocomplete',
        data:{
            'id':id
        },
        success:function(data)
        {
            var customer = $.map(data, function(value, index) {
                return [value];
            });
            op+=' ';
            customer.forEach(value => {
                op+='<option data-value="'+value.id+'" value="'+value.customer.toUpperCase().replace(/&#039;/g, '\'').replace(/&quot;/g, '\"').replace(/&amp;/g, '\&').replace(/&AMP;/g, '\&')+'"></option>';
            });
            $("#client-name").find('option').remove().end().append(op);
            
            $('#client-id').val($('#client-name [value="'+$('#client').val()+'"]').data('value'));
        },
        error: function (data) {
            if(data.status == 401) {
                window.location.href = '/login';
            }
            alert(data.responseText);
        }
    });
});

/*$( "#customer" ).autocomplete({
    source: function( request, response ) {
      // Fetch data
      $.ajax({
        url:"customer-autocomplate",
        type: 'post',
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
        },
        data: {
            client: client,
            search: request.term
        },
        success: function( data ) {
           response( data );
        }
      });
    },
    select: function (event, ui) {
       $('#customer').val(ui.item.customer_branch);
       $('##customer-id').val(ui.item.id); 
       return false;
    }
  });*/

$(document).on('keyup', '#customer', function(){
    var id = $(this).val();
    var op = " ";
    
    if ($('#client-id').val()) {
        var client = $('#client-id').val();
    }else{
        alert("Incomplete Client Name!");
        return false;
    }
    $.ajax({
        type:'get',
        url:'customer-autocomplete',
        data:{
            'id':id,
            'client':client
        },
        success:function(data)
        {
            var customer = $.map(data, function(value, index) {
                return [value];
            });
            op+=' ';
            customer.forEach(value => {
                op+='<option data-value="'+value.id+'" value="'+value.customer_branch.toUpperCase().replace(/&#039;/g, '\'').replace(/&quot;/g, '\"').replace(/&amp;/g, '\&').replace(/&AMP;/g, '\&')+'"></option>';
            });
            $("#customer-name").find('option').remove().end().append(op);
            $('#customer-id').val($('#customer-name [value="'+$('#customer').val()+'"]').data('value'));
        },
        error: function (data) {
            if(data.status == 401) {
                window.location.href = '/login';
            }
            alert(data.responseText);
        }
    });
});

