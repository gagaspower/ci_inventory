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
  <link href="<?php echo base_url(); ?>assets/theme/admin/bower_components/waitMe/waitMe.min.css" rel="stylesheet" type="text/css" />
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
                                </div>
                            </div>
                        </div>
                       
                        <div class="box-body">
                        <table id="table"
                                class="table table-striped"
                                data-toggle="table" 
                                data-search="true"  
                                data-show-export="true"
                                data-show-refresh="true"
                                data-toolbar="#toolbar">
                                <thead>
                                <tr>
                                        <th data-field="id" data-visible="false">ID</th>
                                        <th data-field="kode_trx">Kode</th>
                                        <th data-field="tgl_trx">Tgl. Transaksi</th>
                                        <th data-field="detail_trx">Detail Transaksi</th>
                                        <th data-field="nilai_trx" data-formatter="moneyFormatter">Nilai Transaksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Total Pengeluaran</td>
                                    <th><span class="totalNilai"></span></th>
                                    </tr>
                                </tfoot>
                               </table>
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
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/waitMe/waitMe.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/bootstrap-table/dist/bootstrap-table.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
<script src="<?php echo base_url();?>assets/theme/admin/js/tableExport.js"></script>
<script src="<?php echo base_url();?>assets/theme/admin/js/FileSaver.min.js"></script>
<script src="<?php echo base_url();?>assets/theme/admin/js/jspdf.min.js"></script>
<script src="<?php echo base_url();?>assets/theme/admin/js/jspdf.plugin.autotable.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/numeral/min/numeral.min.js" type="text/javascript"></script>
<script>
    var $table = $('.table');
    var $today = new Date();
    $(function () {
        $table.bootstrapTable('destroy').bootstrapTable({
            exportDataType: 'all',
            exportOptions: {
                fileName: 'Export_' + $today
            }
        });
    })
    $('#table').bootstrapTable();
    $( ".select2" ).select2({
        theme: "bootstrap"
    });
    $(".select2").width("100%");
       
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
                run_waitMe($('#table'), 1, 'facebook');
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>get-report-pengeluaran",
                    data: {
                        tanggal_awal : start_date,
                        tanggal_akhir : end_date
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        $('#table').bootstrapTable('load', data);
                        var totalNilai = data.reduce(function(a, b){
                            return a + parseFloat(b.nilai_trx);
                        }, 0);
                        document.querySelector('.totalNilai').innerHTML = moneyFormatter(totalNilai);
                            $('#table').waitMe('hide');
                        },
                    error: function(data){
                        console.log(data);
                    }
                }); 
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
