var table;
$(document).ready(function()
{
    table = $('table.defectiveTable').DataTable({ 
        "dom": 'Brtip',
        processing: true,
        serverSide: false,
        destroy: true,
        searching: false,
        "language": {
            "emptyTable": "No item/s for return found!",
            "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Searching...</span> ',
        },
        "pageLength": 25,
        columnDefs: [
            {
            orderable: false,
            className: 'select-checkbox',      
            targets: 0
            },
        ],
        ajax: {
            url: '/printtable',
            error: function(data) {
                if(data.status == 401) {
                    window.location.href = '/login';
                }
                alert(data.responseText);
            }
        },
        "order": [[ 1, "asc" ],[ 2, "asc" ]],
        columns: [
            { data: null, defaultContent: ''},
            { data: 'category', name:'category'},
            { data: 'item', name:'item'},
            { data: 'serial', name:'serial'}
        ],
        
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        buttons: {
            buttons: [
                {
                    extend: 'print',
                    className: 'btn btn-primary btn-icon-split',
                    titleAttr: 'PRINT',
                    enabled: false,
                    autoPrint: true,
                    text: '<span class="icon text-white-50"><i class="fa fa-print" style="color:white"></i></span><span> Print Preview</span>',
                    customize: function (doc) {
                        var d = new Date();
                        var hour = String(d.getHours()).padStart(2, '0') % 12 || 12
                        var ampm = (String(d.getHours()).padStart(2, '0') < 12 || String(d.getHours()).padStart(2, '0') === 24) ? "AM" : "PM";
                        var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                        
                        $(doc.document.body)
                            .prepend('<img style="position:absolute; top:10; left:20;width:100;margin-botton:50px" src="'+window.location.origin+'/idsi.png">')
                            //.prepend('<div style="position:absolute; top:10; right:0;">My Title</div>')
                            .prepend('<div style="position:absolute; top:90; width:100%;left:40%;font-size:28px;font-weight: bold"><b></b>DEFECTIVE ITEMS DELIVERY RECEIPT<b></b></div>')
                            //.prepend('<div style="position:absolute; top:90;margin: auto;font-size:16px;color: #0d1a80; font-family: arial; font-weight: bold;">Delivery receipt of defective units from '+$('#branchname').val()+'</div>')
                            .prepend('<div style="position:absolute; top:40; left:125;font-size:28px;color: #0d1a80; font-family: arial; font-weight: bold;">SERVICE CENTER STOCK MONITORING SYSTEM</div>')
                            .prepend('<img style="position:absolute; top:400; left:300;font-size:20px;margin-botton:50px" src="'+window.location.origin+'/idsiwatermark.png">')
                            .prepend('<div style="position:absolute; top:140;font-size:24px"><b>Prepared by:</b> '+$('#userlog').val()+'</div>')
                            .prepend('<div style="position:absolute; top:170;font-size:24px"><b>Area.:</b> '+$('#areaname').val()+'</div>')
                            .prepend('<div style="position:absolute; top:140;left:60%;font-size:24px"><b>Date prepared:</b> '+months[d.getMonth()]+' '+d.getDate()+', ' +d.getFullYear()+' '+hour+':'+String(d.getMinutes()).padStart(2, '0')+ampm+'</div>')
                            .prepend('<div style="position:absolute; top:200;font-size:24px"><label for="textbranch"><b>Branch name: '+$('#branchname').val()+'</div>')
                            // .prepend('<div style="position:absolute; top:230;font-family: arial; font-weight: bold;font-size:24px">Prepared By: '+$("#userlog").val()+'</div>')
                            // .prepend('<div style="position:absolute; top:260;font-family: arial; font-weight: bold;font-size:24px">Prepared Date: '+months[d.getMonth()]+' '+d.getDate()+', ' +d.getFullYear()+' '+hour+':'+String(d.getMinutes()).padStart(2, '0')+ampm+'</div>')
                            .prepend('<div style="position:absolute; top:230;font-family: arial; font-weight: bold;font-size:24px">Received By: _____________________</div>')
                            .prepend('<div style="position:absolute; top:260;font-family: arial; font-weight: bold;font-size:24px">Received Date: _____________________</div>')
                                    //  .prepend('<div style="position:absolute; bottom:20; left:100;">Pagina '+page.toString()+' of '+pages.toString()+'</div>');
                        //jsDate.toString()
                        // $(doc.document.body)
                        //     //.append('<div style="position:absolute; bottom:80; left:15;font-family: arial; font-weight: bold;">Prepared By: '+$("#userlog").val()+'</div>')
                        //     //.append('<div style="position:absolute; bottom:50; left:15;font-family: arial; font-weight: bold;">Prepared Date: '+months[d.getMonth()]+' '+d.getDate()+', ' +d.getFullYear()+' '+hour+':'+String(d.getMinutes()).padStart(2, '0')+ampm+'</div>')
                        //     .append('<div style="position:absolute; bottom:80; right:15;font-family: arial; font-weight: bold;font-size:24px">Received By: _____________________</div>')
                        //     .append('<div style="position:absolute; bottom:50; right:15;font-family: arial; font-weight: bold;font-size:24px">Received Date: _____________________</div>')
                        $(doc.document.body).find('table')            			
                            .removeClass('dataTable')
                            .css('font-size','24px') 
                            .css('margin-top','340px')
                            .css('margin-bottom','250px')
                        $(doc.document.body).find('th').each(function(index){
                            $(this).css('font-size','26px');
                            $(this).css('color','black');
                            $(this).css('background-color','F0F0F0');
                        });                
                    },
                    title:'',
                    exportOptions: {
                        rows: function ( idx, data, node ) {
                            var dt = new $.fn.dataTable.Api('#defectiveTable' );
                            var selected = dt.rows( { selected: true } ).indexes().toArray();
                        
                            if( selected.length === 0 || $.inArray(idx, selected) !== -1)
                            return true;

                            return false;
                        }
                    },
                    init: function(api, node, config) {$(node).removeClass('dt-button')}    
                }
            ]
        }
    });
    table.on( 'select deselect', function () {
        var selectedRows = table.rows( { selected: true } ).count();
 
        table.button( 0 ).enable( selectedRows > 0 );
    });
    table.buttons().container().appendTo('div.panel-heading');
});
$('table.defectiveTable').DataTable().on('select', function () {
    var rowselected = table.rows( { selected: true } ).data();
    if(rowselected.length > 0){
        $('#printBtn').prop('disabled', false);
    }
});
$('table.defectiveTable').DataTable().on('deselect', function () {
    var rowselected = table.rows( { selected: true } ).data();
    if(rowselected.length == 0){
        $('#printBtn').prop('disabled', true);
    }
});
$(document).on('click', '#printBtn', function(){
    $('#loading').show();
    var rowcount = table.data().count();
    var rows = table.rows( '.selected' ).data();
    var id = new Array();
    for(var i=0;i<rows.length;i++){
        id.push(rows[i].id);
    }
    var ids = new Array();
    for(var i=0;i<rowcount;i++){
        if ($.inArray(table.rows( i ).data()[0].id, id) == -1)
        {
            ids.push(i);
        }
    }
    table.rows( ids ).remove().draw();
    $('#loading').hide();
    window.print();
});

