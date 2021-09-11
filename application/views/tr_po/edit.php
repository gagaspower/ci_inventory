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



        <div class="modal fade" id="modal_po" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title" id="myModalLabel">PO Detail</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group" >
                                <label class="control-label col-md-2">Item</label>
                                <div class="col-md-10">
                                    <select class="form-control select2" id="modal_item_code" placeholder="Item" name="item_code">
                                        <option value=""> Pilih Item </option>
                                        <?php foreach( $items as $item ) { ?>
                                            <option value="<?php echo $item['id'];?>"><?php echo $item['kode_barang'];?> - <?php echo $item['nama_barang'];?></option>
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
                                    <input type="hidden" class="form-control" id="modal_po_index"  name="fc_index" disabled>
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
                                            <label >Kode PO</label>
                                            <input type="text" class="form-control"  name="kode_po" id="kode_po"  readonly>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label >Tgl PO</label>
                                            <input type="text" class="form-control datepicker"   name="tgl_po" id="tgl_po" autocomplete="off">
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                    <label >Suplier</label>
                                    <select class="form-control select2" name="suplier_po"  id="suplier_po">
                                        <option value="">pilih</option>
                                        <?php foreach($supliers as $row){ ?>
                                            <option value="<?php echo $row['id'];?>"> <?php echo $row['nama_suplier'];?> </option>
                                        <?php } ?>
                                    </select>
                                    </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-10">
                                    <label>Keterangan PO</label>
                                    <input type="text" class="form-control" name="keterangan_po"  id="keterangan_po" autocomplete="off">
                                    </div> 
                                    </div>
                                </div>
                                <br><hr>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="pull-right"> 
                                            <button type="button" class="btn btn-info btn-flat btn-sm" id="show_item_po">
                                            <i class="fa fa-plus-square"></i> Tambah Item</button>
                                        </div>
                                    </div>
                                </div>
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
                                            id="tr_po_d" 
                                            data-toggle="table"
                                            data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="delete" data-checkbox="true" class="col-sm-1"></th>
                                                <th data-field="po_item_id" class="text-center" data-visible="false">Item</th>
                                                <th data-field="kode_barang" data-sortable="true" class="text-center">Kode Item</th>
                                                <th data-field="nama_barang" data-sortable="true" class="text-center">Nama Item</th>
                                                <th data-field="po_item_qty" data-sortable="true" class="text-center " data-align="right" >Qty</th>
                                                <th data-field="po_harga_beli_item" class="text-center " data-align="right" data-formatter="moneyFormatter">Harga</th>
                                                <th data-field="po_total_harga_beli" class="text-center " data-align="right" data-formatter="moneyFormatter">Subtotal</th>
                                                <th data-field="po_harga_jual_item" class="text-center " data-visible="false" data-align="right" >Harga Jual</th>
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
                                        <span class="pull-right" id="po_total_harga_beli">0.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-sm-12">
                                    <div class="hidden-xs col-sm-8 text-right ">
                                    </div>
                                    <div class="col-xs-12 col-sm-4 btn-lg text-center">
                                        <input type="hidden" id="po_total_harga_beli_val" name="po_total_harga_beli_val" value="0">
                                        <input type="hidden" id="po_total_harga_jual" name="po_total_harga_jual" value="0">
    
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger pull-right btn-flat" id="po_save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>

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
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/underscore/underscore-min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/js/JsFieldPO.js" type="text/javascript"></script>

    <script>
    window.items = <?php echo json_encode( $items ) ?>;
    window.after_save = false;
    window.modal_edit = false;
    window.po_id_edit = <?php echo $this->uri->segment(3) ?>;
    
    $( document ).ready(function(){
        load_data_po();
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

    $("#show_item_po").click( function(){
        window.modal_edit= false;
        $('#modal_po').modal('show');
        clear_po_d();
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
        modal_add_po_d(index_data);
    }
    else{
        var index_data = $('#modal_po_index').val();
        console.log(index_data);
        modal_add_po_d(index_data);   
    }
    $('#modal_po').modal('hide');
});


$('#modal_close').click(function(){
    $('#modal_po').modal('hide');                    
});

function modal_add_po_d(index_data){
    var qty = $("#modal_item_qty").val();
    var item = $("#modal_item_code");
    var $tableData = $('#tr_po_d').bootstrapTable('getData');
    var item_exis = _.findWhere( $tableData, { po_item_id: item.val() } );
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
    
    $('#tr_po_d').bootstrapTable(state, {
        index : index_data,
        row : {
            po_item_id : item.val(),
            nama_barang : $("#modal_item_code option:selected").text(),
            po_item_qty : qty,
            po_harga_beli_item : $("#modal_item_harga_beli").val(),
            po_total_harga_beli : $("#modal_item_harga_beli").val() * qty,
            po_harga_jual_item  : $('#modal_item_harga_jual').val(),
            kode_barang : $("#modal_kode_item").val()
        }
    });
    recount_data( $tableData );
}



$('#tr_po_d').on('click-row.bs.table', function (e, row, $element) {
    console.log (row);
    if( after_save == false ){
        $('#modal_po_index').val($element.attr('data-index'));

        window.modal_edit = true;
        // $('#modal_po_id').val(row.po_id);
        $('#modal_item_qty').val(row.po_item_qty);
        $('#modal_item_code').val(row.po_item_id).trigger('change');;
        $('#modal_item_harga_beli').val(row.po_harga_beli_item);
        $('#modal_item_harga_jual').val(row.po_harga_jual_item);
        $('#modal_kode_item').val(row.kode_barang);
        $('#modal_po').modal('show');
    }
});


$("#delete_item").click( function(){
    var ids = $.map($('#tr_po_d').bootstrapTable("getSelections"), function (row) {
        return row.po_item_id;
    });
    $('#tr_po_d').bootstrapTable("remove", {
        field: "po_item_id",
        values: ids
    });
    var $tableData = $('#tr_po_d').bootstrapTable('getData');
    recount_data( $tableData );
});





$("#po_save").click( function (){
    // prepare_tr_po();
    var id = $("#id").val();
    var suplier_po = $("#suplier_po").val();
    var kode_po = $("#kode_po").val();
    var tgl_po = $("#tgl_po").val();
    var keterangan_po = $("#keterangan_po").val();
    var po_total_harga_beli =  $("#po_total_harga_beli_val").val();
    var po_total_harga_jual = $("#po_total_harga_jual").val();
    var item = $("#tr_po_d").bootstrapTable('getData');
    if ( suplier_po == "" )
    {
        swal({
            title: "Error!",
            text: "Anda belum memilih suplier",
            type: "error",
            confirmButtonText: 'OK'
        });
        return "";
    }
    if ( 0 == item.length )
    {
        swal({
            title: "Error!",
            text: "Tidak ada item !",
            type: "error",
            confirmButtonText: 'OK'
        });
        return "";
    }
    // console.log (tr_po);
    $.ajax({
        method: "POST",
        url:"<?php echo base_url();?>po/update",
        async : true,
        dataType : 'json',
        data: {
             id : id,
             suplier_po : suplier_po,
             kode_po : kode_po,
             tgl_po : tgl_po,
             keterangan_po : keterangan_po,
             po_total_harga_beli : po_total_harga_beli,
             po_total_harga_jual : po_total_harga_jual,
             item : item
        },
        success: function( data ){
            swal({
                type: 'success',
                title: 'PO berhasil disimpan.',
                html:  'Nomor PO anda : ' + data.kode_po,
                showConfirmButton: true
            })
            // $("#kode_po").val(result.po_code);
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


    function load_data_po(){
            $.ajax({
                type: "GET",
                url:"<?php echo base_url();?>po/show/" + po_id_edit,
                dataType : "json",
                success: function( data ){
                    console.log (data);
                    window.po_data = Get_Header_Detail ( data, "id", po_header, po_detail );
                    $('#tr_po_d').bootstrapTable('load', po_data[0].pod);
                    // console.log(cepo_data[0].total_harga_beli_po);
                    $('#suplier_po').val(po_data[0].suplier_po).trigger('change');
                    $('#tgl_po').val(po_data[0].tgl_po);
                    $('#keterangan_po').val(po_data[0].keterangan_po);
                    $('#kode_po').val(po_data[0].kode_po);
                    $('#id').val(po_data[0].id);
                    recount_data( $('#tr_po_d').bootstrapTable('getData') );
                },
                error: function( data ){
                    console.log( data );
                }
            });
    }

function clear_po_d(){
    //Olds ways     
    $("#modal_item_code").val("");
    $('#select2-modal_item_code-container').text("Pilih Item");
    $("#modal_item_qty").val("");
    $("#modal_item_harga_beli").val("0");
    $("#modal_item_harga_jual").val("0");
    $("#modal_kode_item").val("");
};

function disable_all(){
    $('#suplier_po').select2("enable",false);
    $("#keterangan_po").attr("disabled",true);
    $("#tgl_po").attr("disabled",true).datepicker("destroy");
    $("#show_item_po").fadeOut("Slow");
    $("#delete_item").fadeOut("Slow");
    $("#delete_all").fadeOut("Slow");
    $("#po_save").fadeOut("Slow");
}

function recount_data( arrayTable ){
    //counting summary
    var total_harga_beli = 0,
        total_harga_jual = 0;
    for ( i=0; i<=arrayTable.length-1; i++ ){
        var temp_table = arrayTable[i];
        console.log(arrayTable[i]);
        total_harga_beli += ( temp_table.po_item_qty * temp_table.po_harga_beli_item );
        total_harga_jual += ( temp_table.po_item_qty * temp_table.po_harga_jual_item );
    }
    console.log(total_harga_beli);
    $("#po_total_harga_beli").text(numeral(total_harga_beli).format('0,0.00'));
    // console.log(total_harga_beli);
    $("#po_total_harga_jual").val(total_harga_jual);
    $("#po_total_harga_beli_val").val(total_harga_beli);
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


    </script>
</body>
</html>
