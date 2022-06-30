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
            <center><?php echo $this->session->flashdata('msg');?></center>
                <h1 class="page-header">Modul
                    <small>Stock Minimum</small>                   
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                <thead>
                    <tr>
                        <th style="text-align:center;width:40px;">No</th>                        
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Barang Stok</th>
                        <th>Stok Minimum</th>                        
                    </tr>
                </thead>
                <tbody id="show_data">
                
                </tbody>
            </table>
            </div>
        </div>
        <hr>

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


        // $(document).on('click', ".btnUpdate",function(){     
        //     console.log();
        // });

        $(document).ready(function() {
            // alert("s");
            tampil_stock_minimum();
            $('#mydata').dataTable();

            function tampil_stock_minimum(){
                $.ajax({
                    type: 'ajax',
                    dataType: 'json',
                    async:false,
                    url: "<?php echo base_url()?>admin/Stock_minimum/retrieve_data", 
                    success:function(data){                          
                        var html = '';
                        var i;
                        var no = 1;
                        for(i=0; i<data.length; i++){
                            html += '<tr>'+
                                    '<td>'+no+'</td>'+
                                    '<td>'+data[i].barang_id+'</td>'+                        
                                    '<td>'+data[i].barang_nama+'</td>'+
                                    '<td>'+data[i].barang_satuan+'</td>'+
                                    '<td>'+data[i].barang_stok+'</td>'+
                                    '<td>'+data[i].barang_min_stok+'</td>'+
                                    '</tr>';
                            no++;
                        }
                        $('#show_data').html(html);                        
                    }
                });
            }
        });
    </script>
    
    
</body>

</html>
