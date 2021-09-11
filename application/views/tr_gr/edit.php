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



        <div class="modal fade" id="modal_gr" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title" id="myModalLabel">GR Detail</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group" >
                                <label class="control-label col-md-2">Item</label>
                                <div class="col-md-10">
                                    <select class="form-control select2" id="modal_item_code" placeholder="Item" name="item_code">
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
                            <div class="form-group">
                                <label for="name" class="control-label col-md-2">Harga</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control currency" id="modal_item_harga_beli" placeholder="000" name="modal_item_harga_beli" readonly >
                                    <input type="hidden" id="modal_item_harga_jual" name="modal_item_harga_jual" value="0">
                                    <input type="hidden" id="modal_kode_item" name="modal_kode_item" value="0">
                                    <input type="hidden" class="form-control" id="modal_gr_index"  name="fc_index" disabled>
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
                        <input type="hidden" class="form-control"  name="id" id="id" >
                             <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label >Kode GR</label>
                                            <input type="text" class="form-control"  name="kode_gr" id="kode_gr" readonly>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label >Tgl GR</label>
                                            <input type="text" class="form-control datepicker"   name="tgl_gr" id="tgl_gr" autocomplete="off">
                                        </div> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-10">
                                    <label>Keterangan GR</label>
                                    <input type="text" class="form-control" name="keterangan_gr"  id="keterangan_gr" autocomplete="off">
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
                                            <select class="form-control select2" name="suplier_gr"  id="suplier_gr">
                                                <option value="">pilih Suplier</option>
                                                <?php foreach($supliers as $row){ ?>
                                                    <option value="<?php echo $row['id'];?>"> <?php echo $row['nama_suplier'];?> </option>
                                                <?php } ?>
                                            </select>
                                        </div> 
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-primary btn-flat" id="search_po"> <i class="fa fa-truck" aria-hidden="true"></i> Cari PO</button>
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
                                            id="tr_gr_d" 
                                            data-toggle="table"
                                            data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="delete" data-checkbox="true" class="col-sm-1"></th>
                                                <th data-field="po_id" class="text-center" data-visible="false">PO ID</th>
                                                <th data-field="kode_po" data-sortable="true" class="text-center">Kode PO</th>
                                                <th data-field="gr_item_id" class="text-center" data-visible="false">Item</th>
                                                <th data-field="kode_barang" data-sortable="true" class="text-center">Kode Item</th>
                                                <th data-field="nama_barang" data-sortable="true" class="text-center">Nama Item</th>
                                                <th data-field="gr_item_qty" data-sortable="true" class="text-center " data-align="right" >Qty</th>
                                                <th data-field="gr_harga_beli_item" class="text-center " data-visible="true" data-align="right">Harga beli</th>
                                                <th data-field="gr_harga_jual_item" class="text-center " data-visible="false" data-align="right" data-formatter="moneyFormatter">Harga jual</th>
                                                <th data-field="gr_total_harga_beli" class="text-center " data-align="right" >Subtotal</th>
                                                <th data-field="gr_total_harga_jual" class="text-center " data-align="right" data-formatter="moneyFormatter" data-visible="false">Subtotal jual</th>
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
                                        <span class="pull-right" id="gr_total_harga_beli_span">0.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-sm-12">
                                    <div class="hidden-xs col-sm-8 text-right ">
                                    </div>
                                    <div class="col-xs-12 col-sm-4 btn-lg text-center">
                                        <input type="hidden" id="gr_total_harga_beli" name="gr_total_harga_beli" value="0">
                                        <input type="hidden" id="gr_total_harga_jual_val" name="gr_total_harga_jual_val" value="0">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger pull-right btn-flat" id="gr_save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>

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
    window.modal_edit = false;
    window.gr_id_edit = <?php echo $this->uri->segment(3) ?>;
    
    $( document ).ready(function(){
        load_data_gr();
    });
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

    $("#show_item_gr").click( function(){
        window.modal_edit= false;
        $('#modal_gr').modal('show');
        clear_gr_d();
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
        modal_add_gr_d(index_data);
    }
    else{
        var index_data = $('#modal_gr_index').val();
        console.log(index_data);
        modal_add_gr_d(index_data);  
        recalculate(); 
    }

    $('#modal_gr').modal('hide');
});


$('#modal_close').click(function(){
    $('#modal_gr').modal('hide');                    
});

function modal_add_gr_d(index_data){
    var qty = $("#modal_item_qty").val();
    var item = $("#modal_item_code");
    var $tableData = $('#tr_gr_d').bootstrapTable('getData');
    var item_exis = _.findWhere( $tableData, { gr_item_id: item.val() } );
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
    
    $('#tr_gr_d').bootstrapTable(state, {
        index : index_data,
        row : {
            gr_item_id : item.val(),
            nama_barang : $("#modal_item_code option:selected").text(),
            gr_item_qty : qty,
            gr_harga_beli_item : $("#modal_item_harga_beli").val(),
            gr_harga_jual_item : $("#modal_item_harga_jual").val(),
            gr_total_harga_beli : parseInt( $("#modal_item_harga_beli").val() )  * qty,
            gr_total_harga_jual : parseInt($("#modal_item_harga_jual").val() )  * qty,
            kode_barang : $("#modal_kode_item").val()
        }
    });
    recount_data( $tableData );
}



$('#tr_gr_d').on('click-row.bs.table', function (e, row, $element) {
    console.log (row);
    if( after_save == false ){
        $('#modal_gr_index').val($element.attr('data-index'));

        window.modal_edit = true;
        // $('#modal_gr_id').val(row.gr_id);
        $('#modal_item_qty').val(row.gr_item_qty);
        $('#modal_item_code').val(row.gr_item_id).trigger('change');;
        $('#modal_item_harga_beli').val(row.gr_harga_beli_item);
        $('#modal_item_harga_jual').val(row.gr_harga_jual_item);
        $('#modal_kode_item').val(row.kode_barang);
        $('#modal_gr').modal('show');
    }
});


$("#delete_item").click( function(){
    var ids = $.map($('#tr_gr_d').bootstrapTable("getSelections"), function (row) {
        return row.gr_item_id;
    });
    $('#tr_gr_d').bootstrapTable("remove", {
        field: "gr_item_id",
        values: ids
    });
    var $tableData = $('#tr_gr_d').bootstrapTable('getData');
    recount_data( $tableData );
});





$("#gr_save").click( function (){

    recount_data( $("#tr_gr_d").bootstrapTable('getSelections') );
    var id = $("#id").val();
    var suplier_gr = $("#suplier_gr").val();
    var kode_gr = $("#kode_gr").val();
    var tgl_gr = $("#tgl_gr").val();
    var keterangan_gr = $("#keterangan_gr").val();
    var gr_total_harga_beli = parseInt( numeral($("#gr_total_harga_beli_span").text()).format('0.000') );
    var gr_total_harga_jual = $("#gr_total_harga_jual_val").val();
    var item = $("#tr_gr_d").bootstrapTable('getSelections');
    console.log('harga jual',$("#gr_total_harga_jual_val").val());
    console.log('harga beli',$("#gr_total_harga_beli").val());
    // if ( suplier_gr == "" )
    // {
    //     swal({
    //         title: "Error!",
    //         text: "Anda belum memilih suplier",
    //         type: "error",
    //         confirmButtonText: 'OK'
    //     });
    //     return "";
    // }
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
    // console.log (tr_gr);
    $.ajax({
        method: "POST",
        url:"<?php echo base_url();?>gr/update",
        async : true,
        dataType : 'json',
        data: {
             id : id,
             suplier_gr : suplier_gr,
             kode_gr : kode_gr,
             tgl_gr : tgl_gr,
             keterangan_gr : keterangan_gr,
             gr_total_harga_beli : gr_total_harga_beli,
             gr_total_harga_jual : gr_total_harga_jual,
             item : item
        },
        success: function( data ){
            swal({
                type: 'success',
                title: 'GR berhasil disimpan.',
                html:  'Nomor GR anda : ' + data.kode_gr,
                showConfirmButton: true
            })
            // $("#kode_gr").val(result.gr_code);
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




$("#search_po").click( function (){
        var date_range = $("#range_id").val();
        var date_split = date_range.split('-');
        var start_date = $.trim(date_split[0].replace(/\//ig, '-'));
        var end_date = $.trim(date_split[1].replace(/\//ig, '-'));
        var suplier_gr = $("#suplier_gr").val();
        console.log(suplier_gr);
        if ( suplier_gr == "" )
        {
            swal({
                title: "Error!",
                text: "Anda belum memilih suplier",
                type: "error",
                confirmButtonText: 'OK'
            });
            return "";
        }
        run_waitMe($('#tr_gr_d'), 1, 'facebook');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>gr/get-po-edit",
            data: {
                tanggal_awal : start_date,
                tanggal_akhir : end_date,
                suplier_gr : suplier_gr
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#tr_gr_d').bootstrapTable('load', data);
                $('#tr_gr_d').waitMe('hide');
                // recount_data( $('#tr_gr_d').bootstrapTable('getData') );
                },
            error: function(data){
                console.log(data);
            }
        }); 
    
});


function load_data_gr(){
            $.ajax({
                type: "GET",
                url:"<?php echo base_url();?>gr/show/" + gr_id_edit,
                dataType : "json",
                success: function( data ){
                    console.log (data);
                    window.gr_data = Get_Header_Detail ( data, "id", gr_header, gr_detail );
                    $('#tr_gr_d').bootstrapTable('load', gr_data[0].pod);
                    // console.log(cegr_data[0].total_harga_beli_gr);
                    // $('#suplier_gr').val(gr_data[0].suplier_gr).trigger('change');
                    $('#tgl_gr').val(gr_data[0].tgl_gr);
                    $('#keterangan_gr').val(gr_data[0].keterangan_gr);
                    $('#kode_gr').val(gr_data[0].kode_gr);
                    $('#id').val(gr_data[0].id);
                    $('#tr_gr_d').bootstrapTable('checkAll');
                    recount_data( $('#tr_gr_d').bootstrapTable('getData') );
                },
                error: function( data ){
                    console.log( data );
                }
            });
    }



$('#tr_gr_d').on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function (row, $element) {
    recalculate();
});

function recalculate() {
    var gr_total_harga_beli = $.map($('#tr_gr_d').bootstrapTable("getSelections"), function (row) {
        return row.gr_total_harga_beli;
        // console.log('test',row.gr_total_harga_jual);
});

var total_harga_beli = 0;

for(i=0;i<gr_total_harga_beli.length;i++){
    total_harga_beli += parseInt(gr_total_harga_beli[i]);
}

$('#gr_total_harga_beli_span').text(moneyFormatter(total_harga_beli));
$('#gr_total_harga_beli').val(total_harga_beli);
}



function clear_gr_d(){
    //Olds ways     
    $("#modal_item_code").val("");
    $('#select2-modal_item_code-container').text("Pilih Item");
    $("#modal_item_qty").val("");
    $("#modal_item_harga_beli").val("0");
    $("#modal_item_harga_jual").val("0");
    $("#modal_kode_item").val("");
};

function disable_all(){
    $('#suplier_gr').select2("enable",false);
    $("#keterangan_gr").attr("disabled",true);
    $("#tgl_gr").attr("disabled",true).datepicker("destroy");
    $("#range_id").attr("disabled",true).datepicker("destroy");
    $("#show_item_gr").fadeOut("Slow");
    $("#delete_item").fadeOut("Slow");
    $("#delete_all").fadeOut("Slow");
    $("#gr_save").fadeOut("Slow");
    $("#search_po").fadeOut("Slow");
}


function recount_data( arrayTable ){
    //counting summary
    var total_harga_beli = 0,
        total_harga_jual = 0;
    for ( i=0; i<=arrayTable.length-1; i++ ){
        var temp_table = arrayTable[i];
        console.log(arrayTable[i]);

        total_harga_beli = temp_table.gr_item_qty * temp_table.gr_harga_beli_item;
        total_harga_jual =  ( temp_table.gr_item_qty * numeral(temp_table.gr_harga_jual_item).format('0.000') );
    }
    $("#gr_total_harga_beli_span").text(numeral(total_harga_beli).format('0,0.00'));
    $("#gr_total_harga_jual_val").val(total_harga_jual);
}

function Get_Header_Detail( $summary, key, header, detail) {
    $po = []
    if ( $summary.length == 0){
        return [];
    }
    if ( ! $summary[0].hasOwnProperty( key ) ){
        return "don't have key";
    }
    var pervius_id = 0;
    var current_id = 0;
    var $poh = {};
    for( var i=0; i<= $summary.length; i++  ) {
        if ( i == $summary.length ){
            $po.push($poh);
        } else {
            if ( pervius_id != $summary[i][key] ){
                if ( $poh[key] != undefined ){
                    $po.push($poh);
                    $poh={};                    
                } 
                $poh.pod = [];         
                pervius_id = $summary[i][key];
                for ( h=0; h<= header.length -1 ; h++ ) {
                    $poh[ header[h] ] = $summary[i][ header[h] ];
                }
            } 
            var $pod = {};
            for ( d=0; d<= detail.length -1; d++ ) {
                $pod[ detail[d] ] = $summary[i][ detail[d] ];
            }
            $poh.pod.push($pod);
        }
    }
    return $po;
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
