<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $judul;?> | Dashboard</title>
  <?php include(APPPATH.'views/layouts/style.php'); ?>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
  <link href="<?php echo base_url(); ?>assets/theme/admin/bower_components/waitMe/waitMe.min.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/admin/plugins/toast/jquery.toast.min.css"/>
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
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary" id="search_report">Cari</button>
                            </div>
                        </div>
                    </div>
                    <br><br><br><br><hr>
                <div class="row">
                <!-- konten here -->
                <div class="col-md-12">
                    <div class="box">
                       <div class="col-md-12">
                            <div class="pull-left"> <button type="button " class="btn btn-info btn-flat btn-sm" onclick="window.location.href='<?php echo base_url('po/tambah');?>'">
                                <i class="fa fa-plus-square"></i> Tambah <?php echo $judul;?></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div id="po_data" >
                            <table 
                                class="table table-hover"
                                id="table_po"
                                data-toggle="table"
                                data-search="true"
                                data-row-style="striped"
                                data-pagination="true">
                                <thead>
                                <tr>
                                    <th data-field="id" data-visible="false">id</th>
                                    <th class="col-xs-2" data-field="kode_po">Kode</th>
                                    <th class="col-xs-3" data-field="keterangan_po" >Ketarangan</th>
                                    <th class="col-xs-" data-field="tgl_po" >Tgl PO</th>
                                    <th class="col-xs-2" data-field="nama_suplier" data-visible="false">Suplier</th>
                                    <th class="col-xs-2"  data-field="total_harga_beli_po" data-align="right" data-formatter="moneyFormatter">Total Harga</th>
                                </tr>
                                </thead>
                            </table>
                            </div>
                        </div>
                    <!-- /.box-body -->
                    </div>
                </div>
                <!-- konten selesai -->
            </div>
            <div id="po_detail" style="display:none;">
            <input type="hidden" id="po_id">
                <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab_1" data-toggle="tab">Detail</a></li>
                          <li class="pull-right">
                            <button type="button" class="btn btn-warning btn-flat" id="data_edit" onclick="dataEdit()"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                            <button type="button" class="btn btn-danger btn-flat" id="data_void" onclick="dataVoid()"><i class="fa fa-times" aria-hidden="true"></i> Delete</button>
                            <button type="button" class="btn btn-default btn-flat" id="po_hide"><i class="fa fa-compress" aria-hidden="true"></i> Hide</button>
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-1 control-label">Kode PO</label>
                                            <div class="col-sm-3">
                                                <input class="form-control" id="kode_po" disabled>
                                            </div>
                                            <label for="name" class="col-sm-1 control-label">Tgl PO</label>
                                            <div class="col-sm-3">
                                                <input class="form-control " id="tgl_po" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-1 control-label">Suplier</label>
                                            <div class="col-sm-3">
                                                <input class="form-control disabled" id="nama_suplier" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-sm-1 control-label">Deskripsi</label>
                                            <div class="col-sm-11">
                                                <textarea class="form-control" rows="1" id="keterangan_po" name="keterangan_po" maxlength="500" disabled></textarea>
                                            </div>
                                        </div>
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
                                                <th data-field="po_item_id" class="text-center" data-visible="false">Item</th>
                                                <th data-field="kode_barang" data-sortable="true" class="text-center col-sm-5">Kode Item</th>
                                                <th data-field="nama_barang" data-sortable="true" class="text-center col-sm-5">Nama Item</th>
                                                <th data-field="po_item_qty" data-sortable="true" class="text-center col-sm-1" data-align="right" >Qty</th>
                                                <th data-field="po_harga_beli_item" class="text-center col-sm-2" data-align="right" data-formatter="moneyFormatter">Harga</th>
                                                <th data-field="po_total_harga_beli" class="text-center col-sm-3" data-align="right" data-formatter="moneyFormatter">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-4 box-total">
                                        <span>Total</span>
                                        <span class="pull-right" id="po_total_cost">0.00</span>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.tab-content -->
                      </div>
                      <!-- nav-tabs-custom -->
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
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/waitMe/waitMe.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/admin/plugins/toast/jquery.toast.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/underscore/underscore-min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/js/JsFieldPO.js" type="text/javascript"></script>

<script>

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

$(function () {
        $("#search_report").click(function () {
            searchItem();
        });
    });

function searchItem() {
    var date_range = $("#range_id").val();
        var date_split = date_range.split('-');
        var start_date = $.trim(date_split[0].replace(/\//ig, '-'));
        var end_date = $.trim(date_split[1].replace(/\//ig, '-'));
        run_waitMe($('#table_po'), 1, 'facebook');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>po/data",
            data: {
                tanggal_awal : start_date,
                tanggal_akhir : end_date
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                window.po_data = Get_Header_Detail ( data, "id", po_header, po_detail );
                $('#table_po').bootstrapTable('load', po_data);
                    // for ( var i=0; i < po_data.length; i++ ){
                    //     //console.log ( result[i] );
                    //     var ObjRow = {
                    //         id: po_data[i].id,
                    //         kode_po: po_data[i].kode_po,
                    //         tgl_po: po_data[i].tgl_po,
                    //         keterangan_po: po_data[i].keterangan_po,
                    //         nama_suplier: po_data[i].nama_suplier,
                    //         total_harga_beli_po : po_data[i].total_harga_beli_po
                    //     }
                    //     $('#table_po').bootstrapTable('append', ObjRow);
                    // }
                $('#table_po').waitMe('hide');
                },
            error: function(data){
                console.log(data);
            }
        }); 
    }


    $( document ).ready(function(){
            // load_data();
            
            $('#table_po').on('click-row.bs.table', function (e, row, $element) {
                var po_id = row.id;
                // console.log(po_id);
                $po_detail = _.where( po_data , { id : po_id });
                console.log('detail',$po_detail);
                $('#po_id').text( $po_detail[0].id);
                $('#po_id').val( $po_detail[0].id );
                $('#kode_po').val( $po_detail[0].kode_po);
                $('#tgl_po').val( $po_detail[0].tgl_po);
                $('#nama_suplier').val( $po_detail[0].nama_suplier);
                $('#keterangan_po').text( $po_detail[0].keterangan_po);
                var pod = $po_detail[0].pod;
                console.log('xxx',pod);
                $('#tr_po_d').bootstrapTable("removeAll");
                for ( i=0; i<pod.length; i++  ){
                    $('#tr_po_d').bootstrapTable('insertRow', {
                        index : 0,
                        row : {
                            po_item_id  : pod[i].po_item_id,
                            kode_barang : pod[i].kode_barang,
                            nama_barang : pod[i].nama_barang,
                            po_item_qty : pod[i].po_item_qty,
                            po_harga_beli_item : pod[i].po_harga_beli_item,
                            po_total_harga_beli : parseInt(pod[i].po_harga_beli_item) * parseInt(pod[i].po_item_qty),
                        }
                    });
                }
                recount_data( $('#tr_po_d').bootstrapTable("getData") );
                if ( ! $('#po_detail').is(':visible') ){
                    $('#po_detail').slideDown();
                }
            });

            $('#po_hide').click( function(){
                $('#po_detail').slideUp();
            })
        });



function dataEdit(){
    window.location = "<?php echo base_url();?>po/edit/" + $("#po_id").val();
};

function dataVoid(){
    var po_id = $('#po_id').val();
    console.log(po_id);
            $.ajax({
                method: "POST",
                url : "<?php echo base_url();?>po/cek_po_gr",
                data: { id: po_id },
                async : true,
                dataType : 'json',
                success: function( data ){
                    console.log(data.length);
                    if(data.length == 0){
                        $.ajax({
                            method: "POST",
                            url : "<?php echo base_url();?>po/delete",
                            data: { id: po_id },
                            async : true,
                            dataType : 'json',
                            success: function( data ){
                                console.log(data);
                                swal({
                                    type: 'success',
                                    title: 'PO berhasil dihapus',
                                    showConfirmButton: true
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function( data ){
                                console.log (data);

                            }
                        });
                    }else{
                        swal({
                            type: 'error',
                            title: 'Tidak bisa hapus data dikarenakan masih ada GR.',
                            showConfirmButton: true
                        })                       
                    }
                    // swal({
                    //     type: 'success',
                    //     title: 'PO berhasil dihapus',
                    //     showConfirmButton: true
                    // }).then((result) => {
                    //     location.reload();
                    // });
                },
                error: function( data ){
                    console.log (data);

                }
            });

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


function qtyFormatter(value){
    return numeral(value).format('0,0');
}

function moneyFormatter(value){
    return numeral(value).format('0,0.00');
}


function recount_data( arrayTable ){
    var total_harga = 0;
    for ( i=0; i<=arrayTable.length-1; i++ ){
        var temp_table = arrayTable[i];
        total_harga += temp_table.po_total_harga_beli;
    }
    $('#po_total_cost').text( moneyFormatter(total_harga.toString()) );
};


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

<?php if($this->session->flashdata('msg')=='error'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Tidak dapat menghapus data.",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: true,
                    position: 'bottom-right',
                    bgColor: '#FF4859'
                });
        </script>

    <?php elseif($this->session->flashdata('msg')=='success'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Data berhasil dihapus.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: true,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>

    <?php else:?>

    <?php endif;?>

</body>
</html>
