<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $judul;?> | Dashboard</title>
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
                            <div class="pull-left"> <button type="button " class="btn btn-info btn-flat btn-sm" onclick="window.location.href='<?php echo base_url('pengguna/tambah');?>'">
                                <i class="fa fa-plus-square"></i> Tambah <?php echo $judul;?></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $editor){ ?>
                                    <tr>
                                        <td><?php echo $editor['nama'];?></td>

                                        <td><?php echo $editor['username'];?></td>
                                        <td><?php echo $editor['nama_role'];?></td>
                                        <td>
                                        <button type="button " class="btn btn-info btn-flat btn-sm" onclick="window.location.href='<?php echo base_url();?>pengguna/edit/<?php echo $editor['id'];?>'">
                                        <i class="fa fa-edit"></i> Edit</button>
                                        <button type="button " class="btn btn-warning btn-flat btn-sm" onclick="window.location.href='<?php echo base_url();?>pengguna/delete/<?php echo $editor['id'];?>'">
                                        <i class="fa fa-trash"></i> Hapus</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
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
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/admin/plugins/toast/jquery.toast.min.js"></script>
<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })

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
