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
                            <div class="pull-left"> <button type="button " class="btn btn-info btn-flat btn-sm" onclick="window.location.href='<?php echo base_url('so/tambah');?>'">
                                <i class="fa fa-plus-square"></i> Tambah <?php echo $judul;?></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div id="po_data" >
                            <table 
                                class="table table-hover"
                                id="table_so"
                                data-toggle="table"
                                data-search="true"
                                data-row-style="striped"
                                data-pagination="true">
                                <thead>
                                <tr>
                                    <th data-field="id" data-visible="false">id</th>
                                    <th data-field="kode_so">Kode</th>
                                    <th data-field="keterangan_so" >Ketarangan</th>
                                    <th data-field="tgl_so" >Tgl SO</th>
                                    <th data-field="nama_customer" data-visible="false">Customer</th>
                                    <th data-field="so_total_harga_jual" data-align="right" data-formatter="moneyFormatter">Total Harga</th>
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
            <div id="so_detail" style="display:none;">
            <input type="hidden" id="so_id">
                <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab_1" data-toggle="tab">Detail</a></li>
                          <li class="pull-right">
                            <button type="button" class="btn btn-warning btn-flat" id="data_edit" onclick="dataEdit()"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                            <button type="button" class="btn btn-danger btn-flat" id="data_void" onclick="dataVoid()"><i class="fa fa-times" aria-hidden="true"></i> Delete</button>
                            <button type="button" class="btn btn-default btn-flat" id="so_hide"><i class="fa fa-compress" aria-hidden="true"></i> Hide</button>
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-1 control-label">Kode SO</label>
                                            <div class="col-sm-3">
                                                <input class="form-control" id="kode_so" disabled>
                                            </div>
                                            <label for="name" class="col-sm-1 control-label">Tgl SO</label>
                                            <div class="col-sm-3">
                                                <input class="form-control " id="tgl_so" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-1 control-label">Customer</label>
                                            <div class="col-sm-3">
                                                <input class="form-control disabled" id="nama_customer" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-sm-1 control-label">Deskripsi</label>
                                            <div class="col-sm-11">
                                                <textarea class="form-control" rows="1" id="keterangan_so" name="keterangan_so" maxlength="500" disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped" 
                                            id="tr_so_d" 
                                            data-toggle="table"
                                            data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="so_item_id" class="text-center" data-visible="false">Item</th>
                                                <th data-field="kode_barang" data-sortable="true" class="text-center">Kode Item</th>
                                                <th data-field="nama_barang" data-sortable="true" class="text-center">Nama Item</th>
                                                <th data-field="so_item_qty" data-sortable="true" class="text-center" data-align="right" >Qty</th>
                                                <th data-field="so_item_harga_jual" class="text-center" data-align="right" data-formatter="moneyFormatter">Harga</th>
                                                <th data-field="so_total_harga_jual" class="text-center" data-align="right" data-formatter="moneyFormatter">Subtotal</th>
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
                                        <span class="pull-right" id="so_total_price">0.00</span>
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
<script src="<?php echo base_url(); ?>assets/theme/admin/js/JsFieldSO.js" type="text/javascript"></script>

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
            url: "<?php echo base_url();?>so/data",
            data: {
                tanggal_awal : start_date,
                tanggal_akhir : end_date
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                window.so_data = Get_Header_Detail ( data, "id", so_header, so_detail );
                $('#table_so').bootstrapTable('load', so_data);
                    // for ( var i=0; i < so_data.length; i++ ){
                    //     //console.log ( result[i] );
                    //     var ObjRow = {
                    //         id: so_data[i].id,
                    //         kode_so: so_data[i].kode_so,
                    //         tgl_so: so_data[i].tgl_so,
                    //         keterangan_so: so_data[i].keterangan_so,
                    //         nama_customer: so_data[i].nama_customer,
                    //         so_total_harga_jual : so_data[i].so_total_harga_jual
                    //     }
                        // $('#table_so').bootstrapTable('append', ObjRow);
                    // }
                $('#table_so').waitMe('hide');
                },
            error: function(data){
                console.log(data);
            }
        }); 
    }


    $( document ).ready(function(){
            // load_data();
            
            $('#table_so').on('click-row.bs.table', function (e, row, $element) {
                var po_id = row.id;
                // console.log(po_id);
                $so_detail = _.where( so_data , { id : po_id });
                console.log('detail',$so_detail);
                $('#so_id').text( $so_detail[0].id);
                $('#so_id').val( $so_detail[0].id );
                $('#kode_so').val( $so_detail[0].kode_so);
                $('#tgl_so').val( $so_detail[0].tgl_so);
                $('#nama_customer').val( $so_detail[0].nama_customer);
                $('#keterangan_so').text( $so_detail[0].keterangan_so);
                var pod = $so_detail[0].pod;
                console.log('xxx',pod);
                $('#tr_so_d').bootstrapTable("removeAll");
                for ( i=0; i<pod.length; i++  ){
                    $('#tr_so_d').bootstrapTable('insertRow', {
                        index : 0,
                        row : {
                            so_item_id  : pod[i].so_item_id,
                            kode_barang : pod[i].kode_barang,
                            nama_barang : pod[i].nama_barang,
                            so_item_qty : pod[i].so_item_qty,
                            so_item_harga_jual : pod[i].so_harga_jual_item,
                            so_total_harga_jual : parseInt(pod[i].so_harga_jual_item) * parseInt(pod[i].so_item_qty),
                        }
                    });
                }
                recount_data( $('#tr_so_d').bootstrapTable("getData") );
                if ( ! $('#so_detail').is(':visible') ){
                    $('#so_detail').slideDown();
                }
            });

            $('#so_hide').click( function(){
                $('#so_detail').slideUp();
            })
        });



function dataEdit(){
    window.location = "<?php echo base_url();?>so/edit/" + $("#so_id").val();
};

function dataVoid(){
    var so_id = $('#so_id').val();
    $.ajax({
        method: "POST",
        url : "<?php echo base_url();?>so/delete",
        data: { id: so_id },
        success: function( data ){
            console.log(data);
            swal({
                type: 'success',
                title: 'SO berhasil dihapus',
                showConfirmButton: true
            }).then((result) => {
                location.reload();
            });
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
        total_harga += temp_table.so_total_harga_jual;
    }
    $('#so_total_price').text( moneyFormatter(total_harga.toString()) );
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
