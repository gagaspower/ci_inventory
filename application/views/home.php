<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Home | Dashboard</title>
  <?php include(APPPATH.'views/layouts/style.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/admin/plugins/toast/jquery.toast.min.css"/>
<link rel="stylesheet" href="<?php echo base_url().'assets/theme/admin/css/morris.css'?>">
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
            </ol>
        </section>
        <!-- content section -->
        <section class="content">
            <div class="row">
                <!-- konten here -->
                <div class="col-md-12">
                    <div class="alert alert-info"><?php echo $welcome;?></div>                   
                </div>

                <!-- <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                    <h3><?php echo ' Rp '. number_format($sum_pemasukan, 2, ",", ".");?></h3>

                    <p>Pemasukan hari ini</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
                </div>

                <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                    <h3><?php echo ' Rp '. number_format($sum_pengeluaran, 2, ",", ".");?></h3>
                    <p>Pengeluaran hari ini</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                    <h3><?php echo ' Rp '. number_format($saldo, 2, ",", ".");?></h3>
                    <p>Total Saldo Saat ini</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
                </div>
                <div class="col-md-12">
                        <div class="box box-widget">
                            <h2><center>Grafik perbandingan pendapatan vs pengeluaran setiap bulan </center></h2>
                            <h4><center>Periode  tahun <?php echo date('Y');?></center></h4>
                            <div id="graph"></div>
                        </div>
                </div> -->
                <!-- konten selesai -->
            </div>
        </section>
    </div>
    <?php include(APPPATH.'views/layouts/copyright.php'); ?>
</div>
<?php include(APPPATH.'views/layouts/jquery.php'); ?>
<!-- <script src="<?php echo base_url().'assets/theme/admin/js/jquery.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/theme/admin/js/raphael-min.js'?>"></script>
    <script src="<?php echo base_url().'assets/theme/admin/js/morris.min.js'?>"></script>

</body>

<script>
        Morris.Bar({
          element: 'graph',
          data: <?php echo $charts;?>,
          xkey: 'periode',
          ykeys: ['pendapatan', 'pengeluaran'],
          labels: ['pendapatan', 'pengeluaran']
        });

</script> -->
</html>
