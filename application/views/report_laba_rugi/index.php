<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $judul;?> | Dashboard</title>
  <?php include(APPPATH.'views/layouts/style.php'); ?>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/admin/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/admin/bower_components/select2-bootstrap-theme/dist/select2-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/admin/bower_components/bootstrap-table/dist/bootstrap-table.min.css"/>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" /></head>
  <body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">
<?php include(APPPATH.'views/layouts/header.php'); ?>
<?php include(APPPATH.'views/layouts/sidebar.php'); ?>
    <div class="content-wrapper">
        <!-- breadcumb -->
        <section class="content-header">
            <h1><?php echo $judul;?> </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><?php echo $judul;?></li>
            </ol>
        </section>
        <!-- content section -->
        <section class="content">
            <div class="row">
                <!-- konten here -->
                <div class="col-md-12">
                    <div class="box">
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
                                    <button type="button" class="btn btn-info" id="download">Download</button>
                                </div>
                            </div>
                        </div>
                       
                        <div class="box-body">
                            <div class="col-md-12">
                                <br>
                                <div class="row scroll" id="printableAreadefault">
                                <center>
                                    <h2>LAPORAN LABA/RUGI</h2>
                                </center>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th colspan="3"><b>PENDAPATAN</b></th>
                                        </tr>
                                        <div id="pendapatan_list">
                                            <tr>
                                                <td>-</td>
                                                <td>0</td>
                                                <td></td>
                                            </tr>
                                        </div>
                                        <tr>
                                            <th colspan="2"><b>TOTAL PENDAPATAN</b></th>
                                            <th><b>0</b></th>
                                        </tr>
                                      
                                        <tr rowspan="2"></tr>
                                        <tr>
                                            <th colspan="3"><b>PENGELUARAN</b></th>
                                        </tr>
                                        <div id="pengeluaran_list">
                                            <tr>
                                                <td>-</td>
                                                <td>0</td>
                                                <td></td>
                                            </tr>
                                        </div>
                                        <tr>
                                            <th colspan="2"><b>TOTAL PENGELUARAN</b></th>
                                            <th><b>0</b></th>
                                        </tr>
                                        
                                        <tr>
                                            <th colspan="2"><b>TOTAL LABA/RUGI</b></th>
                                            <th><b>0</b></th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="row scroll" id="printableArea"></div>
                            </div>
                        </div>
                    <!-- /.box-body -->
                    </div>
                </div>
                <!-- konten selesai -->
            </div>
        </section>
    </div>
    <?php include(APPPATH.'views/layouts/copyright.php'); ?>
</div>
<?php include(APPPATH.'views/layouts/jquery.php'); ?>
 <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/bootstrap-table/dist/bootstrap-table.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
<script src="<?php echo base_url();?>assets/theme/admin/js/tableExport.js"></script>
<script src="<?php echo base_url();?>assets/theme/admin/js/FileSaver.min.js"></script>
<script src="<?php echo base_url();?>assets/theme/admin/js/jspdf.min.js"></script>
<script src="<?php echo base_url();?>assets/theme/admin/js/jspdf.plugin.autotable.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/numeral/min/numeral.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/theme/admin/js/xlsx.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/theme/admin/js/papaparse.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/theme/admin/js/FileSaver.min.js"></script>
<script>
    $( ".select2" ).select2({
        theme: "bootstrap"
    });
    $(".select2").width("100%");
    $("#download").hide();
    function moneyFormatter(value){
            return numeral(value).format('0,0.00');
        }
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

    $('#download').click(function (e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('div[id$=printableArea]').html()));
        e.preventDefault();
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
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>get-report-laba-rugi",
                    data: {
                        tanggal_awal : start_date,
                        tanggal_akhir : end_date
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data.pendapatans);
                        console.log(data.pengeluarans);
                        console.log(data.total_pendapatan);
                        var html = '';
                        html += '<center>'+
                                    '<h2>LAPORAN LABA/RUGI</h2>'+
                                    '<h4>Periode '+start_date+ ' s.d ' + end_date +'</h4>'+
                                '</center>';
                        html += '<table class="table table-bordered">'+
                                        '<tr>'+
                                            '<th colspan="3"><b>PENDAPATAN</b></th>'+
                                        '</tr>';
                        for (let x = 0; x < data.pendapatans.length; x++) 
                            {
                                html +='<tr>'+
                                            '<td>'+data.pendapatans[x].detail_trx+'</td>'+
                                            '<td>'+moneyFormatter(data.pendapatans[x].nilai_trx)+'</td>'+
                                            '<td></td>'+
                                        '</tr>';

                            }
                        html +='<tr>'+
                                    '<th colspan="2"><b>TOTAL PENDAPATAN</b></th>'+
                                    '<th><b>'+moneyFormatter(data.total_pendapatan)+'</b></th>'+
                                '</tr>'+
                                '<tr rowspan="2"></tr>'+
                                '<tr>'+
                                    '<th colspan="3"><b>PENGELUARAN</b></th>'+
                                '</tr>';
                        for (let i = 0; i < data.pengeluarans.length; i++){
                                html +='<tr>'+
                                            '<td>'+data.pengeluarans[i].detail_trx+'</td>'+
                                            '<td>'+moneyFormatter(data.pengeluarans[i].nilai_trx)+'</td>'+
                                            '<td></td>'+
                                        '</tr>';

                        }
                        html +='<tr>'+
                                    '<th colspan="2"><b>TOTAL PENGELUARAN</b></th>'+
                                    '<th><b>'+moneyFormatter(data.total_pengeluaran)+'</b></th>'+
                                '</tr>'+
                                '<tr>'+
                                    '<th colspan="2"><b>TOTAL LABA/RUGI</b></th>'+
                                    '<th><b>'+moneyFormatter(data.total_pendapatan - data.total_pengeluaran)+'</b></th>'+
                                '</tr>'+
                                '</table>';
                        $('#printableArea').html(html);
                        $('#printableAreadefault').hide();
                        $("#download").show();
                        },
                    error: function(data){
                        console.log(data);
                    }
                }); 
            }


</script>
</body>
</html>
