var stockTable;
var catstockTable;
var table;
var Brid;
var iteminiid;
var categid;
var typingTimer;                
var doneTypingInterval = 1000;
var aa = 0;
$(document).on('click', function (e) 
{
    $('[data-toggle="popover"]').each(function () {
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            if ($(this).data('bs.popover')) {
                (($(this).popover('hide').data('bs.popover') || {}).inState || {}).click = false  
            }
        }
    });
});
$(document).ready(function()
{
    $('#saveBtn').hide();
    var table =
    $('table.branchTable').DataTable({ 
        "dom": 'lrtip',
        "language": {
            "emptyTable": 'No branch found.',
            "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Searching...</span> '
        },
        processing: true,
        serverSide: false,
        ajax: 'branches',
        columns: [
            { data: 'branch', name:'branch', "width": "14%" },
            { data: 'area', name:'area', "width": "14%"},
            { data: 'head', name:'head', "width": "14%"},
            { data: 'phone', name:'phone',"width": "14%"},
            { data: 'email', name:'email',"width": "14%"},
            { data: 'status', name:'status', "width": "14%"},
            { data: 'address', name:'address', "width": "14%"}
        ]
    });
    $('#branchTable tbody').on('click', 'tr', function () { 
        var dtdata = $('#branchTable tbody tr:eq(0)').data();
        var trdata = table.row(this).data();
        var id = trdata.id;
        Brid = trdata.id;
        $('#catBtn').hide();
        $('table.branchDetails').dataTable().fnDestroy();
        $('table.catbranchDetails').dataTable().fnDestroy();
        $('#table').hide();
        $('#branchDetails').hide();
        catstockTable =
        $('table.catbranchDetails').DataTable({ 
            "dom": 'rtip',
            "language": {
                "emptyTable": " "
            },
            "pageLength": 15,
            "order": [[ 1, "asc" ]],
            processing: true,
            serverSide: true,
            ajax: {
                "async": false,
                "url": "/stocks/"+id,
                "data": {
                    "data": 0
                },
                error: function (data) {
                    if(data.status == 401) {
                        window.location.href = '/login';
                    }
                    alert(data.responseText);
                }
            },
            columns: [
                { data: 'category', name:'category'},
                { data: 'available', name:'available'},
                { data: 'stock_out', name:'stock_out'}
            ]
        });
        $('#cattable').show();
        $('#catbranchDetails').show();
        $('#branch_name').prop('disabled', true);
        $('#address').prop('disabled', true);
        $('#area').prop('disabled', true);
        $('#contact_person').prop('disabled', true);
        $('#mobile').prop('disabled', true);
        $('#email').prop('disabled', true);
        $('#status').prop('disabled', true);
        $('#myid').val(trdata.id);
        $('#branch_name').val(trdata.branch);
        $('#address').val(trdata.address);
        $('#area').val(trdata.area_id);
        $('#contact_person').val(trdata.head);
        $('#mobile').val(trdata.phone);
        $('#email').val(trdata.email);
        $('#status').val(dtdata.dataStatus);
        $('#myid').val(trdata.id);
        $('#editBtn').val('Edit');
        $('#editBtn').show();
        $('#saveBtn').hide();
        $('#branchModal').modal('show');
    });
    $('#addBtn').on('click', function(){ 
        $('#branchModal').modal('show');
        $('#branch_name').val('');
        $('#address').val('');
        $('#area').val('select area');
        $('#contact_person').val('');
        $('#mobile').val('');
        $('#email').val('');
        $('#status').val('select status');
        $('#branch_name').prop('disabled', false);
        $('#address').prop('disabled', false);
        $('#area').prop('disabled', false);
        $('#contact_person').prop('disabled', false);
        $('#mobile').prop('disabled', false);
        $('#email').prop('disabled', false);
        $('#status').prop('disabled', false);
        $('#editBtn').val('Save');
        $('#editBtn').hide();
        $('#saveBtn').show();
        $('#table').hide();
    });
    $('#editBtn').on('click', function(){
        $('#branch_name').prop('disabled', false);
        $('#address').prop('disabled', false);
        $('#area').prop('disabled', false);
        $('#contact_person').prop('disabled', false);
        $('#mobile').prop('disabled', false);
        $('#email').prop('disabled', false);
        $('#status').prop('disabled', false);
        $('#editBtn').hide();
        $('#saveBtn').show();
    });
    $('#branchForm').on('submit', function(e){
        e.preventDefault();
        editBtn = $('#editBtn').val();
        $('#loading').show();
        if(editBtn == 'Edit'){
            var myid = $('#myid').val();
            $.ajax({
                type: "PUT",
                url: "/branch_update/"+myid,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
                },
                data: $('#branchForm').serialize(),
                success: function(data){
                    if($.isEmptyObject(data.error)){
                        $('#branchModal').modal('hide');
                        alert("Branch data updated");
                        location.reload();
                    }else{
                        alert(data.error);
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
        if(editBtn == 'Save'){
            $.ajax({
                type: "POST",
                url: "branch_add",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
                },
                data: $('#branchForm').serialize(),
                success: function(data){
                    if($.isEmptyObject(data.error)){
                        $('#branchModal').modal('hide');
                        alert("Branch data saved");
                        location.reload();
                    }else{
                        alert(data.error);
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
    $('#filter').popover({ 
        html: true,
        sanitize: false,
        title: 'Filter Columns &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
    });
    $('#filter').on("click", function () { 
        for ( var i=1 ; i<=6 ; i++ ) {
            if (table.column( i ).visible()){
                $('#filter-'+i).prop('checked', true);
            }
            else {
                $('#filter-'+i).prop('checked', false);
            }
        }
    });
    table.columns( [5, 6] ).visible(false);
    $('body').on('click', '.branchColumnCb', function(){ 
        var column = table.column( $(this).attr('data-column') );
        var colnum = $(this).attr('data-column');
        $('.fl-'+colnum).val('');
        table
            .columns(colnum).search( '' )
            .draw();
        column.visible( ! column.visible() );
    });
    $('#search-ic').on("click", function () { 
        for ( var i=0 ; i<=6 ; i++ ) {
            $('.fl-'+i).val('').change();
            table
            .columns(i).search( '' )
            .draw();
        }
        $('.tbsearch').toggle();
    });
    $('.filter-input').keyup(function() { 
        table.column( $(this).data('column'))
            .search( $(this).val())
            .draw();
    });
    $('.mfilter-input').keyup(function() { 
        stockTable.column($(this).data('column'))
            .search($(this).val())
            .draw();
    });
    $('.cfilter-input').on('keyup', function() { 
        catstockTable.column($(this).data('column'))
            .search($(this).val())
            .draw();
    });
});
$(document).on('click', '#catbranchDetails tr', function(){
    var trdata = catstockTable.row(this).data();
    categid = trdata.id;
    $('table.branchDetails').dataTable().fnDestroy();
    $('#cattable').hide();
    $('#catbranchDetails').hide();
    $('#table').show();
    $('#catname').text(trdata.category.replace(/&#039;/g, '\'').replace(/&quot;/g, '\"').replace(/&amp;/g, '\&').replace(/&AMP;/g, '\&'));
    stockTable =
        $('table.branchDetails').DataTable({ 
            "dom": 'rtip',
            "language": {
                "emptyTable": " "
            },
            "pageLength": 5,
            "order": [[ 1, "asc" ]],
            processing: true,
            serverSide: true,
            ajax: {
                "async": false,
                "url": "/stocks/"+Brid,
                "data": {
                    "data": 1,
                    "category": categid 
                },
                error: function (data) {
                    if(data.status == 401) {
                        window.location.href = '/login';
                    }
                    alert(data.responseText);
                }
            },
            columns: [
                { data: 'item', name:'item', "width": "17%"},
                { data: 'available', name:'available', "width": "14%"},
                { data: 'stock_out', name:'stock_out', "width": "14%"}
            ]
        });
        $('#branchDetails').show();
        $('#catBtn').show();
});
$(document).on('click', '#branchDetails tr', function(){
    var trdata = stockTable.row(this).data();
    $('#head4').text(trdata.item);
    $('#item-qty').val(trdata.initial);
    $('#iniitemid').val(trdata.items_id);
    $('#inibranchid').val(trdata.branch_id);
    $('#updateModal').modal({backdrop: 'static', keyboard: false});
});
$(document).on('click', '#catBtn', function(){
    $('#catBtn').hide();
    $('table.branchDetails').dataTable().fnDestroy();
    $('table.catbranchDetails').dataTable().fnDestroy();
    $('#catbranchDetails').show();
    $('#cattable').show();
    $('#table').hide();
    $('#branchDetails').hide();
    catstockTable =
    $('table.catbranchDetails').DataTable({ 
        "dom": 'rtip',
        "language": {
            "emptyTable": " "
        },
        "pageLength": 10,
        "order": [[ 1, "asc" ]],
        processing: true,
        serverSide: true,
        ajax: {
            "async": false,
            "url": "/stocks/"+Brid,
            "data": {
                "data": 0
            },
            error: function (data) {
                if(data.status == 401) {
                    window.location.href = '/login';
                }
                alert(data.responseText);
            }
        },
        columns: [
            { data: 'category', name:'category'},
            { data: 'available', name:'available'},
            { data: 'stock_out', name:'stock_out'}
        ]
    });
    $('#cattable').show();
    $('#catbranchDetails').show();
});
$(document).on('click', '.close', function () {
   location.reload(); 
});
$(document).on('click', '#updateBtn', function(){
    var itemid = $('#iniitemid').val();
    var branchid = $('#inibranchid').val();
    var qty = $('#item-qty').val();
    $.ajax({
        url: 'branch_ini',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="ctok"]').attr('content')
        },
        dataType: 'json',
        type: 'PUT',
        data: {
            itemid: itemid,
            branchid: branchid,
            qty: qty
        },
        success:function()
        {
            $('table.branchDetails').dataTable().fnDestroy();
            stockTable =
            $('table.branchDetails').DataTable({
                "dom": 'lrtip',
                "language": {
                    "emptyTable": " ",
                    "processing": "Updating. Please wait.."
                },
                processing: true,
                serverSide: true,
                ajax: "/stocks/"+branchid,
                columns: [
                    { data: 'item', name:'item', "width": "17%"},
                    { data: 'initial', name:'initial', "width": "17%"},
                    { data: 'available', name:'available', "width": "14%"},
                    { data: 'stock_out', name:'stock_out', "width": "14%"}
                ]
            });
            $("#updateModal .close").click();
        },
        error: function (data) {
            if(data.status == 401) {
                window.location.href = '/login';
            }
            alert(data.responseText);
        }
    });
});