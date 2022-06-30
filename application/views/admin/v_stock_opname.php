<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By CV. Dua Sekawan">
    <meta name="author" content="CV. Dua Sekawan">

    <title>Management data barang</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/css/style.css'?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/css/font-awesome.css'?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url().'assets/css/4-col-portfolio.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/dataTables.bootstrap.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/jquery.dataTables.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/dist/css/bootstrap-select.css'?>" rel="stylesheet">
</head>

<body>

    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Modul
                    <small>Stock Opname</small>
                    <!-- <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Barang</a></div> -->
                </h1>
            </div>
        </div>
        <!-- /.row -->
        
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <?php echo $this->session->flashdata('notif') ?>
                <div class="form-group">
                    <button class="btn btn-info" onclick="window.location.href='<?php echo base_url().'admin/Stock_opname/download_so';?>';">DOWNLOAD</button>
                </div>
                <form method="POST" action="<?php echo base_url().'admin/Stock_opname/upload_so';?>" enctype="multipart/form-data">                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">UNGGAH FILE EXCEL</label>
                        <input type="file" name="uploadFile" class="form-control">            
                        <span style="color:red;">*Please choose an Excel file(.xls or .xlxs) as Input</span>
                        <div class="form-group text-right"><button class="btn btn-primary" onclick="window.location.href='<?php echo base_url().'admin/Stock_opname/upload_so';?>';">UPLOAD</button></div>
                    </div>
                </form>               
            </div>
        </div>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p style="text-align:center;">Copyright &copy; <?php echo '2020';?> by CV. Dua Sekawan</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

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
        //$(document).ready(function(){
            $(document).on('click', ".btnHapus",function(){            
                var kobar = $(this).val();                
                $.ajax({
                    type: "POST",
                    data: {kobar:kobar},
                    url : "<?php echo base_url()?>admin/Barang/hapus_barang",
                    success:function(data){  
                        var data = $.parseJSON(data);                      
                        console.log(data);
                        alert(data.message);
                    }
                });
            });
            $('#mydata').DataTable();
        // });
    </script>
    <script type="text/javascript">
        $(function(){
            $('.harpok').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('.harjul').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
        });
    </script>
    
</body>

</html>
