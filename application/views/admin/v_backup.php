<!DOCTYPE html>


<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By novariodaniel@gmail.com">
    <meta name="author" content="CV. Dua Sekawan">

    <title>Welcome To Point of Sale Apps</title>

    <!-- Bootstrap Core CSS -->    
    <link href="<?php echo base_url().'assets/css/fixedHeader.dataTables.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/swal/sweetalert2.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/swal/all.css'?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/css/style.css'?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/newfa/css/fontawesome.css'?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url().'assets/css/4-col-portfolio.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/dataTables.bootstrap.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/jquery.dataTables.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/dist/css/bootstrap-select.css'?>" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo base_url().'assets/select2/dist/css/select2.min.css'?>" rel="stylesheet" />
    <!-- jQuery library -->
   <script src="<?php echo base_url().'assets/jquery-3.3.1.min.js'?>"></script>
   <script src="<?php echo base_url().'assets/swal/sweetalert2.min.js'?>"></script>
   <!-- Select2 JS -->
   <script src="<?php echo base_url().'assets/select2/dist/js/select2.min.js'?>"></script>

</head>

<style>
    td.details-control {
        /* background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_open.png') no-repeat center center; */
        background: url("<?php echo base_url().'assets/img/details_open.png'?>") no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        /* background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_close.png') no-repeat center center; */
        background: url("<?php echo base_url().'assets/img/details_close.png'?>") no-repeat center center;
    }
</style>

<body>

    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');        
   ?>

    <!-- Page Content -->
    <div class="container">

       <div class="row">
       <div class="col-md-4 portfolio-item">
                <div class="menu-item green" style="height:200px;">
                    <h3>Backup Database</h3>
                    <a href="<?php echo base_url().'admin/Backup/backup_database'?>" class="btn btn-sm btn-primary extra" target="_blank">Backup Database</a>
                </div> 
            </div>
            <div class="col-md-4 portfolio-item">
                <div class="menu-item blue" style="height:200px;">
                <h3>Restore Database</h3>
                <?php echo form_open_multipart('admin/Backup/restore_database');?>
                <input type="file" class="form-control" name="datafile" id="datafile" /><br>
                <button type="submit" class="btn btn-sm btn-primary extra">Upload</button>
                </form>
                </div> 
            </div>
       </div>
        <hr>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url().'assets/js/jquery.js'?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url().'assets/dist/js/bootstrap-select.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/dataTables.bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.price_format.min.js'?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable();
        })        
    </script>
    
    
</body>

</html>

