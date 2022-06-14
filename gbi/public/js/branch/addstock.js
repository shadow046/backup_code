
$(document).on('click', '.sub_Btn', function(){
    var cat = "";
    var item = "";
    var check = 1;
    var go = 0;
    var stop = 0;
    $('#loading').show();
    for(var q=1;q<=y;q++){
        if ($('#row'+q).is(":visible")) {
            if ($('.add_item[btn_id=\''+q+'\']').val() == 'Remove') {
                check++;
                $('.sub_Btn').prop('disabled', true)
                cat = $('#category'+q).val();
                item = $('#desc'+q).val();
                serial = $('#serial'+q).val();
                $.ajax({
                    url: 'store',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        item: item,
                        serial: serial,
                        cat : cat,
                    },
                    error: function(data) {
                        if(data.status == 401) {
                            window.location.href = '/login';
                        }
                    }
                });
            }
        }
    }
    if (check > 1) {
        location.reload();
    }
});
$(document).on('change', '.category', function(){
    var codeOp = " ";
    var descOp = " ";
    var count = $(this).attr('row_count');
    var id = $(this).val();
    $('#serial' + count).prop('disabled', true);
     $.ajax({
        type:'get',
        url:'itemcode',
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
            $("#desc" + count).find('option').remove().end().append(descOp);
        },
    });
});
$(document).on('change', '.item', function(){
    var count = $(this).attr('row_count');
    var id = $(this).val();        
    $('#desc' + count).val(id);
});
$(document).on('change', '.desc', function(){
    var count = $(this).attr('row_count');
    var id = $(this).val();
    $('#serial' + count).prop('disabled', false);
    $('#serial' + count).val('');
    $('#item' + count).val(id);
});
$('input[type="text"]').keyup(function() {
    $(this).val().replace('-','');
});