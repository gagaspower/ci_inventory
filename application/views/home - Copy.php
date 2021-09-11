<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Home | Dashboard</title>
  <?php include(APPPATH.'views/layouts/style.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/admin/plugins/toast/jquery.toast.min.css"/>
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

                <div class="col-lg-4 col-xs-6">
                <!-- small box -->
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
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                <!-- small box -->
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
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                <!-- small box -->
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
                <!-- ./col -->
                <div class="col-md-12">
                    <div class="container">
                        <div class="grafik" style="width:100%; height:400px;"></div>
                    </div>
                </div>
                <!-- konten selesai -->
            </div>
        </section>
    </div>
    <?php include(APPPATH.'views/layouts/copyright.php'); ?>
</div>
<?php include(APPPATH.'views/layouts/jquery.php'); ?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="http://code.highcharts.com/modules/exporting.js"></script>

</body>
<?php 

 // array data
	 $array_periode = array();
	 $array_kategori = array();
	 $array_series = array();
	 $array_datas = array();
	
	 // set attribute
	 $array_attribute = array('pendapatan', 'pengeluaran');
	
	 // cari periode
	 $sql = "SELECT bulan_trx, tahun_trx FROM tr_trx GROUP BY bulan_trx,tahun_trx";
	 $rs = $this->db->query($sql)->result_array();
	
	foreach($rs as $row) {
	  $bulan = $row['bulan_trx'];
	  $tahun = $row['tahun_trx'];
	  $periode = $bulan . ' ' . $tahun;
	
	  // set periode
	  array_push($array_periode, array('bulan '=>$bulan, 'tahun'=>$tahun, 'periode' => $periode));
	
	  // set kategori
	  array_push($array_kategori, $periode);
	 }
	
	 foreach($array_periode as $key=>$val){
	  // set datas
	  $array_datas[$val['periode']] = array();
	
	  $sql = "SELECT SUM(IF(jenis_trx_id=1,nilai_trx,0)) AS pendapatan, SUM(IF(jenis_trx_id=2,nilai_trx,0)) AS pengeluaran
				FROM tr_trx
				GROUP BY bulan_trx,tahun_trx,jenis_trx_id
                ORDER BY bulan_trx,tahun_trx asc";
    // echo $sql;exit;
	  $rs = $this->db->query($sql)->result_array();
	
	  foreach($rs as $row){
	   $pendapatan = $row['pendapatan'];
	   $pengeluaran = $row['pengeluaran'];
	
	   // value datas
	   $array_datas[$val['periode']]['pendapatan'] = intval($pendapatan);
	   $array_datas[$val['periode']]['pengeluaran'] = intval($pengeluaran);
	  }
	 }
	
	 // set nama series grafik
	 foreach($array_attribute as $attribute){
	  array_push($array_series, array('name'=>$attribute, 'data'=>array()));
	 }
	
	 // set value per series grafik
	 foreach($array_kategori as $kategori){
	  $i = 0;
	  foreach($array_attribute as $attribute){
	   array_push($array_series[$i]['data'], $array_datas[$kategori][$attribute]);
	
	   $i++;
	  }
	 }
?>
<script>
$('.grafik').highcharts({
 chart: {
  type: 'line',
  marginTop: 80
 },
 credits: {
  enabled: false
 }, 
 tooltip: {
  shared: true,
  crosshairs: true,
  headerFormat: '<b>{point.key}</b><br/>'
 },
 title: {
  text: 'Grafik Perbandingan pendapatan & pengeluaran setiap bulan'
 },
//  subtitle: {
//   text: 'TAHUN 2013 - 2015'
//  },
 xAxis: {
  categories: <?php echo json_encode($array_kategori); ?>,
  labels: {
   rotation: 0,
   align: 'right',
   style: {
    fontSize: '10px',
    fontFamily: 'Verdana, sans-serif'
   }
  }
 },
 legend: {
  enabled: true
 },
 series: <?php echo json_encode($array_series); ?>
});
</script>
</html>
