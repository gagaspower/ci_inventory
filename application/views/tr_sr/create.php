<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $judul;?> | Dashboard</title>
  
<?php include(APPPATH.'views/layouts/style.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/admin/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/admin/bower_components/select2-bootstrap-theme/dist/select2-bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link href="<?php echo base_url(); ?>assets/theme/admin/bower_components/waitMe/waitMe.min.css" rel="stylesheet" type="text/css" />

<style>
.box-total {
    margin-top: 20px;
    font-size: 20px;
    font-weight: bold;
    padding: 5px;
    border:1px solid #d2d6de;
}
</style>
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">
<?php include(APPPATH.'views/layouts/header.php'); ?>
<?php include(APPPATH.'views/layouts/sidebar.php'); ?>
    <div class="content-wrapper">
        <!-- breadcumb -->
        <section class="content-header">
            <h1>Dashboard <small>Control panel</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><?php echo $judul;?></li>
            </ol>
        </section>
        <!-- content section -->
        <section class="content">



        <div class="modal fade" id="modal_sr" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title" id="myModalLabel">SR Detail</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group" >
                                <label class="control-label col-md-2">Item</label>
                                <div class="col-md-10">
                                    <select class="form-control select2" id="modal_item_code" placeholder="Item" name="item_code" disabled>
                                        <option value=""> Pilih Item </option>
                                        <?php foreach( $items as $item ) { ?>
                                            <option value="<?php echo $item['id'];?>"><?php echo $item['nama_barang'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Qty</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" id="modal_item_qty" min="0" placeholder="0" name="modal_item_qty">
                                </div>
                            </div>
>
                            <div class="form-group">
                                <label for="name" class="control-label col-md-2">Harga</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control currency" id="modal_item_harga_jual" placeholder="000" name="modal_item_harga_jual" readonly >
                                    <input type="hidden" id="modal_item_harga_beli" name="modal_item_harga_beli" value="0">
                                    <input type="hidden" id="modal_kode_item" name="modal_kode_item" value="0">
                                    <input type="hidden" id="modal_so_id" name="modal_so_id" >
                                    <input type="hidden" class="form-control" id="modal_sr_index"  name="fc_index" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="modal_close">Close</button>
                        <button type="button" class="btn btn-primary" id="modal_save">Save Changes</button> 
                    </div>
                </div>
            </div>
        </div>






            <div class="row">
                <!-- konten here -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" method="post" action="#">
                             <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label >Kode SR</label>
                                            <input type="text" class="form-control"  name="kode_sr" id="kode_sr" value="<?php echo $kode_sr;?>" readonly>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label >Tgl SR</label>
                                            <input type="text" class="form-control datepicker"   name="tgl_sr" id="tgl_sr" autocomplete="off">
                                        </div> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-10">
                                    <label>Keterangan SR</label>
                                    <input type="text" class="form-control" name="keterangan_sr"  id="keterangan_sr" autocomplete="off">
                                    </div> 
                                    </div>
                                </div>
                                <br><hr>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">
                                                        <span class="fa fa-calendar" aria-hidden="true"></span>
                                                    </span>
                                                    <input type="text" id="range_id" class="form-control" name="daterange"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- <labe >Suplier</label> -->
                                            <select class="form-control select2" name="customer_sr"  id="customer_sr">
                                                <option value="">pilih customer</option>
                                                <?php foreach($customers as $row){ ?>
                                                    <option value="<?php echo $row['id'];?>"> <?php echo $row['nama_customer'];?> </option>
                                                <?php } ?>
                                            </select>
                                        </div> 
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-primary btn-flat" id="search_so"> <i class="fa fa-truck" aria-hidden="true"></i> Cari SO</button>
                                        </div>
                                    </div>
                                </div>
                                <br><br><hr>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-xs-6 pull-left">
                                            <button type="button" class="btn btn-warning btn-flat btn-sm" id="delete_item"><i class="fa fa-list" aria-hidden="true"></i> Hapus Item </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-12">
                                    
                                    <table class="table table-striped" 
                                            id="tr_sr_d" 
                                            data-toggle="table"
                                            data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="delete" data-checkbox="true" class="col-sm-1"></th>
                                                <th data-field="so_id" class="text-center" data-visible="false">SO ID</th>
                                                <th data-field="kode_so" data-sortable="true" class="text-center">Kode SO</th>
                                                <th data-field="sr_item_id" class="text-center" data-visible="false">Item</th>
                                                <th data-field="kode_barang" data-sortable="true" class="text-center">Kode Item</th>
                                                <th data-field="nama_barang" data-sortable="true" class="text-center">Nama Item</th>
                                                <th data-field="sr_item_qty" data-sortable="true" class="text-center " data-align="right" >Qty</th>
                                                <th data-field="sr_harga_beli_item" class="text-center " data-visible="false" data-align="right">Harga beli</th>
                                                <th data-field="sr_harga_jual_item" class="text-center " data-visible="true" data-align="right" data-formatter="moneyFormatter">Harga jual</th>
                                                <th data-field="sr_total_harga_beli" class="text-center " data-align="right" data-visible="false">Subtotal Beli</th>
                                                <th data-field="sr_total_harga_jual" class="text-center " data-align="right" data-formatter="moneyFormatter" data-visible="true">Subtotal</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-4 box-total">
                                        <span>Total</span>
                                        <span class="pull-right" id="sr_total_harga_jual_span">0.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-sm-12">
                                    <div class="hidden-xs col-sm-8 text-right ">
                                    </div>
                                    <div class="col-xs-12 col-sm-4 btn-lg text-center">
                                        <input type="hidden" id="sr_total_harga_jual" name="sr_total_harga_jual" value="0">
                                        <input type="hidden" id="sr_total_harga_beli_val" name="sr_total_harga_beli_val" value="0">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger pull-right btn-flat" id="sr_save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>

                            </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php include(APPPATH.'views/layouts/copyright.php'); ?>
</div>
<?php include(APPPATH.'views/layouts/jquery.php'); ?>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/underscore/underscore-min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/waitMe/waitMe.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/js/JsFieldGR.js" type="text/javascript"></script>

    <script>
    window.items = <?php echo json_encode( $items ) ?>;
    window.after_save = false;

    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }


        $('input[name="daterange"]').daterangepicker({
            opens: 'right',
            startDate: start,
            endDate: end,
            locale: {
                format: 'YYYY/MM/DD'
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
    });
    $( ".select2" ).select2({
        theme: "bootstrap"
    });
    $(".select2").width("100%");

    $('.datepicker').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd",
      currentText: "Now",
    })
    $(".datepicker").datepicker().datepicker("setDate", new Date());

    $("#show_item_sr").click( function(){
        window.modal_edit= false;
        $('#modal_sr').modal('show');
        clear_sr_d();
    });

    $("#modal_item_code").change( function(){
        var item =  _.findWhere( window.items, { id:  this.value  } );
        console.log(item);
        if ( item ){
            $("#modal_item_harga_beli").val( item.harga_beli );
            $("#modal_item_harga_jual").val( item.harga_jual );
            $("#modal_kode_item").val( item.kode_barang );
        }
    });

$('#modal_save').click(function(){
    if(modal_edit == false){
        modal_add_sr_d(index_data);
    }
    else{
        var index_data = $('#modal_sr_index').val();
        console.log(index_data);
        modal_add_sr_d(index_data);  
        recalculate(); 
    }

    $('#modal_sr').modal('hide');
});


$('#modal_close').click(function(){
    $('#modal_sr').modal('hide');                    
});

function modal_add_sr_d(index_data){ 
    var qty = $("#modal_item_qty").val();
    var item = $("#modal_item_code");
    var $tableData = $('#tr_sr_d').bootstrapTable('getData');
    var item_exis = _.findWhere( $tableData, { sr_item_id: item.val() } );
    console.log ( item_exis );
    
    if ( window.modal_edit == false ){
        if ( item_exis ) {
            swal({
                title: "Error!",
                text: "Item sudah ada ditabel",
                type: "error",
                confirmButtonText: 'OK'
            });
            return "";
        }
        if ( qty == "" || qty == "0" ) {
            swal({
                title: "Error!",
                text: "Qty tidak boleh kosong atau nol", 
                type: "error",
                confirmButtonText: 'OK!'
            });
            return "";
        }

        if ( item.val() == "" ) {
            swal({
                title: "Error!",
                text: "Silahkan pilih item terlebih dahulu",
                type: "error",
                confirmButtonText: "OK"
            });
            return "";
        }
    }
    
    var state = 0;
    
    if(!index_data){
        state = "insertRow";
        index_data = 0;
    }
    else {
        state = "updateRow";
    }
    
    $('#tr_sr_d').bootstrapTable(state, {
        index : index_data,
        row : {
            sr_item_id : item.val(),
            nama_barang : $("#modal_item_code option:selected").text(),
            sr_item_qty : qty,
            sr_harga_beli_item : $("#modal_item_harga_beli").val(),
            sr_harga_jual_item : $("#modal_item_harga_jual").val(),
            sr_total_harga_beli : parseInt( $("#modal_item_harga_beli").val() )  * qty,
            sr_total_harga_jual : parseInt($("#modal_item_harga_jual").val() )  * qty,
            kode_barang : $("#modal_kode_item").val()
        }
    });
    recount_data( $tableData );
}



$('#tr_sr_d').on('click-row.bs.table', function (e, row, $element) {
    console.log (row);
    if( after_save == false ){
        $('#modal_sr_index').val($element.attr('data-index'));

        window.modal_edit = true;
        $('#modal_so_id').val(row.so_id);
        $('#modal_item_qty').val(row.sr_item_qty);
        $('#modal_item_code').val(row.sr_item_id).trigger('change');;
        $('#modal_item_harga_beli').val(row.sr_harga_beli_item);
        $('#modal_item_harga_jual').val(row.sr_harga_jual_item);
        $('#modal_kode_item').val(row.kode_barang);
        $('#modal_sr').modal('show');
    }
});


$("#delete_item").click( function(){
    var ids = $.map($('#tr_sr_d').bootstrapTable("getSelections"), function (row) {
        return row.sr_item_id;
    });
    $('#tr_sr_d').bootstrapTable("remove", {
        field: "sr_item_id",
        values: ids
    });
    var $tableData = $('#tr_sr_d').bootstrapTable('getData');
    recount_data( $tableData );
});





$("#sr_save").click( function (){

    recount_data( $("#tr_sr_d").bootstrapTable('getSelections') );
    var customer_sr = $("#customer_sr").val();
    var kode_sr = $("#kode_sr").val();
    var tgl_sr = $("#tgl_sr").val();
    var keterangan_sr = $("#keterangan_sr").val();
    var sr_total_harga_beli = $("#sr_total_harga_beli_val").val();
    var sr_total_harga_jual = $("#sr_total_harga_jual").val();
    var item = $("#tr_sr_d").bootstrapTable('getSelections');
    console.log('harga jual',sr_total_harga_beli);
    console.log('harga beli',sr_total_harga_jual);
    if ( customer_sr == "" )
    {
        swal({
            title: "Error!",
            text: "Anda belum memilih Customer",
            type: "error",
            confirmButtonText: 'OK'
        });
        return "";
    }
    if ( 0 == item.length )
    {
        swal({
            title: "Error!",
            text: "Centang item setidaknya 1 item",
            type: "error",
            confirmButtonText: 'OK'
        });
        return "";
    }
    // console.log (tr_sr);
    $.ajax({
        method: "POST",
        url:"<?php echo base_url();?>sr/simpan",
        async : true,
        dataType : 'json',
        data: {
             customer_sr : customer_sr,
             kode_sr : kode_sr,
             tgl_sr : tgl_sr,
             keterangan_sr : keterangan_sr,
             sr_total_harga_beli : sr_total_harga_beli,
             sr_total_harga_jual : sr_total_harga_jual,
             item : item
        },
        success: function( data ){
            swal({
                type: 'success',
                title: 'GR berhasil disimpan.',
                html:  'Nomor GR anda : ' + data.kode_sr,
                showConfirmButton: true
            })
            // $("#kode_sr").val(result.sr_code);
            disable_all();
            window.after_save = true;
        },
        error: function( data ){
            console.log(data);
            swal({
                type: 'error',
                title: 'Contact your Admin ',
                showConfirmButton: true
            })
        }
    });
    
    });




$("#search_so").click( function (){
        var date_range = $("#range_id").val();
        var date_split = date_range.split('-');
        var start_date = $.trim(date_split[0].replace(/\//ig, '-'));
        var end_date = $.trim(date_split[1].replace(/\//ig, '-'));
        var customer_so = $("#customer_sr").val();
        console.log(customer_so);
        if ( customer_so == "" )
        {
            swal({
                title: "Error!",
                text: "Anda belum memilih Customer",
                type: "error",
                confirmButtonText: 'OK'
            });
            return "";
        }
        run_waitMe($('#tr_sr_d'), 1, 'facebook');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>sr/get-so",
            data: {
                tanggal_awal : start_date,
                tanggal_akhir : end_date,
                customer_so : customer_so
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#tr_sr_d').bootstrapTable('load', data);
                $('#tr_sr_d').waitMe('hide');
                // recount_data( $('#tr_sr_d').bootstrapTable('getData') );
                },
            error: function(data){
                console.log(data);
            }
        }); 
    
});


$('#tr_sr_d').on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function (row, $element) {
    recalculate();
});

function recalculate() {
    var sr_total_harga_jual = $.map($('#tr_sr_d').bootstrapTable("getSelections"), function (row) {
        return row.sr_total_harga_jual;
        // console.log('test',row.sr_total_harga_jual);
});

var total_harga_jual = 0;

for(i=0;i<sr_total_harga_jual.length;i++){
    total_harga_jual += parseInt(sr_total_harga_jual[i]);
}

$('#sr_total_harga_jual_span').text(moneyFormatter(total_harga_jual));
$('#sr_total_harga_jual').val(total_harga_jual);
}



function clear_sr_d(){
    //Olds ways     
    $("#modal_item_code").val("");
    $('#select2-modal_item_code-container').text("Pilih Item");
    $("#modal_item_qty").val("");
    $("#modal_item_harga_beli").val("0");
    $("#modal_item_harga_jual").val("0");
    $("#modal_kode_item").val("");
};

function disable_all(){
    $('#customer_sr').select2("enable",false);
    $("#keterangan_sr").attr("disabled",true);
    $("#tgl_sr").attr("disabled",true).datepicker("destroy");
    $("#range_id").attr("disabled",true).datepicker("destroy");
    $("#show_item_sr").fadeOut("Slow");
    $("#delete_item").fadeOut("Slow");
    $("#delete_all").fadeOut("Slow");
    $("#sr_save").fadeOut("Slow");
    $("#search_so").fadeOut("Slow");
}


function recount_data( arrayTable ){
    //counting summary
    var total_harga_beli = 0,
        total_harga_jual = 0;
    for ( i=0; i<=arrayTable.length-1; i++ ){
        var temp_table = arrayTable[i];
        console.log(arrayTable[i]);

        total_harga_beli = temp_table.sr_item_qty * temp_table.sr_harga_beli_item;
        total_harga_jual =  ( temp_table.sr_item_qty * numeral(temp_table.sr_harga_jual_item).format('0.000') );
    }
    $("#sr_total_harga_jual_span").text(numeral(total_harga_jual).format('0,0.00'));
    $("#sr_total_harga_beli_val").val(total_harga_beli);
}



function moneyFormatter(value){
    return numeral(value).format('0,0.00');
}

function run_waitMe(el, num, effect){
    text = 'Please wait...';
    fontSize = '';
    maxSize = '50';
    textPos = 'vertical';
    el.waitMe({
        effect: effect,
        text: text,
        bg: 'rgba(255,255,255,0.7)',
        color: '#B71C1C',
        maxSize: maxSize,
        waitTime: -1,
        source: 'img.svg',
        textPos: textPos,
        fontSize: fontSize,
        onClose: function(el) {}
    });
}

    </script>
</body>
</html>
