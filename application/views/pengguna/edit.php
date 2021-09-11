<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $judul;?> | Dashboard</title>
  
<?php include(APPPATH.'views/layouts/style.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/admin/plugins/toast/jquery.toast.min.css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/admin/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/admin/bower_components/select2-bootstrap-theme/dist/select2-bootstrap.min.css">
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
                <li class="active">Edit Admin</li>
            </ol>
        </section>
        <!-- content section -->
        <section class="content">
            <div class="row">
                <!-- konten here -->
                <div class="col-md-6">
                    <div class="box box-primary">

                        <form role="form" method="post" action="<?php echo base_url('pengguna/update');?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                             <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"  name="nama" value="<?php echo $nama;?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role</label>
                                    <select class="select2" name="role_id">
                                        <option value="">pilih</option>
                                        <?php foreach($roles->result_array() as $row){ ?>
                                            <option value="<?php echo $row['id'];?>" <?php if($row['id'] == $role_id) echo "selected"; ?>> <?php echo $row['nama_role'];?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"  name="username" value="<?php echo $username;?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/admin/plugins/toast/jquery.toast.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<?php if($this->session->flashdata('msg')=='error'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Terjadi kesalahan saat memperbarui data.",
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
                    text: "Data berhasil di update.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: true,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php else:?>

    <?php endif;?>

    <script>
    $( ".select2" ).select2({
        theme: "bootstrap"
    });
    $(".select2").width("100%");

    </script>
</body>
</html>
