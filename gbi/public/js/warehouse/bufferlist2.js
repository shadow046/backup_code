$(document).on('click', '.recBtn', function(){
    var thisdata = buffersenditems.row( $(this).parents('tr') ).data();
    var row =  $(this).parents('tr');
    $('#loading').show();
    $.ajax({
        url: 'bufferreceived',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
        },
        dataType: 'json',
        type: 'put',
        data: {
            buffers_no : buffers_no,
            items_id: thisdata.items_id,
            qty: thisdata.qty,
            item: thisdata.item,
            category_id: thisdata.category_id
        },
        success: function(data){
            $('#loading').hide();
            buffersenditems
                .row(row)
                .remove().draw( false );
            if (data == "go") {
                location.reload();
            }
        },
        error: function (data) {
            if(data.status == 401) {
                window.location.href = '/login';
            }
            alert(data.responseText);
        }
    });
});
$(document).on('click', '#approvedBtn', function(){
    $('#bufferModal').toggle();
    $('#loading').show();
    $.ajax({
        url: 'bufferapproved',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
        },
        dataType: 'json',
        type: 'put',
        data: {
            buffers_no : buffers_no,
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

$(document).on('click', '#prcBtn', function(){
    $("#bufferModal .closes").click();
    $('#loading').show();
    $('#sreqno').val(buffers_no);
    $('#sdate').val(reqDate);
    console.log(user);
    $('#reqby').val(user);
    $('table.sendDetails').DataTable({ 
        "dom": 'lrtip',
        processing: true,
        serverSide: false,
        async:false,
        "language": {
            "emptyTable": "No item found!",
            "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Searching...</span> ',
        },
        "order": [ 0, "asc" ],
        "pageLength": 25,
        ajax: {
            url: 'bufferitem',
            data: {
                buffers_no: buffers_no,
            },
            error: function(data) {
                if(data.status == 401) {
                    window.location.href = '/login';
                }
            }
        },
        columns: [
            { data: 'category', name:'category'},
            { data: 'item', name:'item'},
            { data: 'pending', name:'pending'},
        ]
    });
    bufferdata = buffer.rows().data()
    for (let index = 0; index < items; index++) {
        var additem = '<div class="row no-margin" id="row'+index+'"><div class="col-md-2 form-group"><select id="categ'+index+'" disabled class="form-control categ" row_count="'+index+'" style="color:black;-webkit-appearance: none;"><option selected value="'+bufferdata[index].cat_id+'">'+bufferdata[index].category+'</option></select></div>  <div class="col-md-7 form-group"><select id="desc'+index+'" disabled class="form-control desc" row_count="'+index+'" style="color:black;-webkit-appearance: none;"><option selected value="'+bufferdata[index].items_id+'">'+bufferdata[index].item+'</option></select></div><div class="col-md-1 form-group"><input type="number" class="form-control qty" row_count="'+index+'" id="qty'+index+'" min="0" max="'+bufferdata[index].pending+'" style="color:black" autocomplete="off" placeholder="input quantity" value="0"></div></div>'
        $('#reqfield').append(additem);
    }
    $('#loading').hide();
    $('#sendModal').modal('show');
});

$(document).on('keydown', '.qty', function(){
    var qty = $(this).attr('max');
    if (!$(this).val() || (parseInt($(this).val()) <= qty && parseInt($(this).val()) >= 0))
    $(this).data("old", $(this).val());
});
$(document).on('keyup', '.qty', function(){
    var qty = $(this).attr('max');
    if (!$(this).val() || (parseInt($(this).val()) <= qty && parseInt($(this).val()) >= 0))
      ;
    else
      $(this).val($(this).data("old"));
});

$(document).on('click', '.sub_Btn', function(){
    $('#sendModal').toggle();
    $('#loading').show();
    for (let index = 0; index < items; index++) {
        qty = $('#qty'+index).val();
        if (!$('#qty'+index).val()) {
            qty = 0;
            console.log('pumasok');
        }
        $.ajax({
            url: 'buffersend',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
            },
            dataType: 'json',
            async:false,
            type: 'PUT',
            data: {
                items_id: $('#desc'+index).val(),
                buffers_no: $('#sreqno').val(),
                qty: qty
            },
            success: function(){
                location.reload();
            },
            error: function (data) {
                alert(data.responseText);
                return false;
            }
        });
    }
});

$(document).on('click', '.cancel', function(){
    $('#loading').show();
    location.reload();
});