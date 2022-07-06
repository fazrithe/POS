<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By novariodanie@gmail.com">
    <meta name="author" content="CV. Dua Sekawan">

    <title><?=$webtitle?></title>

    


    <!-- Bootstrap Core CSS -->
      <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet">
          <link href="<?php echo base_url().'assets/css/style.css'?>" rel="stylesheet">
          <link href="<?php echo base_url().'assets/newfa/css/fontawesome.css'?>" rel="stylesheet">
	    
    <!-- Custom CSS -->
      <link href="<?php echo base_url().'assets/css/4-col-portfolio.css'?>" rel="stylesheet">

      <style type="text/css">
      .bg {
           width: 100%;
           height: 100%;
           position: fixed;
           z-index: -1;
           float: left;
           left: 0;
           margin-top: -20px;
      }
      p{
            font-family: Arial, Helvetica, sans-serif !important;
            text-align:left !important;
            font-size:14px !important;
            padding-left:5px !important;
      }
      </style>
</head>

<body>
<img src="<?php echo base_url().'assets/img/bg2.jpg'?>" alt="gambar" class="bg" />
    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:#fcc;">Welcome to
                    <small><?=$webtitle?></small>                   
                </h1>                
            </div>
        </div>
        <!-- /.row -->
	<div class="mainbody-section text-center">
     <?php $h=$this->session->userdata('akses'); ?>
     <?php $u=$this->session->userdata('user'); ?>

        <!-- Projects Row  1-->
        <div class="row">
         <?php if($h=='1'){ ?> 
            
             <div class="col-md-3 portfolio-item">
                <div class="menu-item light-red" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Pembelian'?>" data-toggle="modal">
                           <i class="fa fa-shopping-basket"></i>
                            <p>Pembelian</p>
                      </a>
                </div> 
            </div>
            <div class="col-md-3 portfolio-item">
                <div class="menu-item blue" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Penjualan'?>" data-toggle="modal">
                           <i class="fa fa-cash-register"></i>
                            <p>Penjualan</p>
                      </a>
                </div> 
            </div>
            
            <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item green" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Stock_opname'?>" data-toggle="modal">
                           <i class="fa fa-calendar-check"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Stock Opname</p>
                      </a>
                </div> 
            </div> -->
            <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item light-orange" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Suplier'?>" data-toggle="modal">
                           <i class="fa fa-truck"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Suplier</p>
                      </a>
                </div> 
            </div> -->
            <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item color" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Adjustment'?>" data-toggle="modal">
                           <i class="fa fa-balance-scale"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Adjustment</p>
                      </a>
                </div> 
            </div> -->
            <?php }?>
            <?php if($h=='2'){ ?> 
            <div class="col-md-2 portfolio-item">
                <div class="menu-item blue" style="height:150px;">
                     <a href="#" data-toggle="modal">
                           <i class="fa fa-shopping-cart"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Penjualan Eceran</p>
                      </a>
                </div> 
            </div>
            <div class="col-md-2 portfolio-item">
                <div class="menu-item green" style="height:150px;">
                     <a href="#" data-toggle="modal">
                           <i class="fa fa-users"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Penjualan Grosir</p>
                      </a>
                </div> 
            </div>
            <div class="col-md-2 portfolio-item">
                <div class="menu-item light-orange" style="height:150px;">
                     <a href="#" data-toggle="modal">
                           <i class="fa fa-truck"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Suplier</p>
                      </a>
                </div> 
            </div>
            <div class="col-md-2 portfolio-item">
                <div class="menu-item color" style="height:150px;">
                     <a href="#" data-toggle="modal">
                           <i class="fa fa-sitemap"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Kategori</p>
                      </a>
                </div> 
            </div>
            <?php }?>
            <div class="col-md-3 portfolio-item">
                <div class="menu-item purple" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Barang'?>" data-toggle="modal">
                           <i class="fa fa-shopping-cart"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Barang</p>
                      </a>
                </div> 
            </div>
            
            <div class="col-md-3 portfolio-item">
                <div class="menu-item red" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Pengguna'?>" data-toggle="modal">
                           <i class="fa fa-user-tie"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Pengguna</p>
                      </a>
                </div> 
            </div>
            <div class="col-md-3 portfolio-item">
                <div class="menu-item blue" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Laporan'?>" data-toggle="modal">
                           <i class="fa fa-file-download"></i>
                            <p>Laporan</p>
                      </a>
                </div> 
            </div>
            <div class="col-md-3 portfolio-item">
                <div class="menu-item blue" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Stock_minimum'?>" data-toggle="modal">
                           <i class="fa fa-store-alt-slash"></i>
                            <p>Stock Minimum</p>
                      </a>
                </div> 
            </div>
            <div class="col-md-3 portfolio-item">
                  <div class="menu-item lightgreen" style="height:150px;">
                        <a href="<?php echo base_url().'admin/Setoran_hutang'?>" data-toggle="modal">
                              <i class="fa fa-calculator"></i>
                              <p style="text-align:left;font-size:14px;padding-left:5px;">Setoran Hutang</p>
                        </a>
                  </div> 
            </div>
            <div class="col-md-3 portfolio-item">
                  <div class="menu-item light-orange" style="height:150px;">
                        <a href="<?php echo base_url().'admin/Income_outcome'?>" data-toggle="modal">
                              <i class="fa fa-balance-scale"></i>
                              <p style="text-align:left;font-size:14px;padding-left:5px;">Income/ Outcome</p>
                        </a>
                  </div> 
            </div>
        </div>
        
        <!-- /.row -->

        <!-- Projects Row  2-->
        <div class="row">
        <?php if($h=='1'){ ?> 
            <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item blue" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Laporan'?>" data-toggle="modal">
                           <i class="fa fa-file-download"></i>
                            <p>Laporan</p>
                      </a>
                </div> 
            </div> -->
            <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item light-red" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Pembelian'?>" data-toggle="modal">
                           <i class="fa fa-shopping-basket"></i>
                            <p>Pembelian</p>
                      </a>
                </div> 
            </div> -->
            <?php }?>
            <?php if($h=='2'){ ?> 
            <div class="col-md-2 portfolio-item">
                <div class="menu-item purple" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Penjualan_grosir'?>" data-toggle="modal">
                           <i class="fa fa-cubes"></i>
                            <p>Penjualan Grossir</p>
                      </a>
                </div> 
            </div>
            <div class="col-md-2 portfolio-item">
                <div class="menu-item red" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Penjualan'?>" data-toggle="modal">
                           <i class="fa fa-shopping-bag"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Penjualan Eceran</p>
                      </a>
                </div> 
            </div>
            <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item blue" style="height:150px;">
                     <a href="#" data-toggle="modal">
                           <i class="fa fa-bar-chart"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Laporan</p>
                      </a>
                </div> 
            </div> -->
             <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item light-red" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Pembelian'?>" data-toggle="modal">
                           <i class="fa fa-shopping-basket"></i>
                            <p>Pembelian</p>
                      </a>
                </div> 
            </div> -->
            <?php }?>
            <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item purple" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Karyawan'?>" data-toggle="modal">
                           <i class="fas fa-users"></i>
                            <p>Karyawan</p>
                      </a>
                </div> 
            </div> -->
            <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item red" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Sales'?>" data-toggle="modal">
                           <i class="fa fa-people-carry"></i>                                                      
                            <p>Sales</p>
                      </a>
                </div> 
            </div> -->
            <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item blue" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Stock_minimum'?>" data-toggle="modal">
                           <i class="fa fa-store-alt-slash"></i>
                            <p>Stock Minimum</p>
                      </a>
                </div> 
            </div> -->
            <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item fuchsia" style="height:150px;">
                     <a href="<?php echo base_url().'admin/After_sales'?>" data-toggle="modal">
                           <i class="fa fa-recycle"></i>
                            <p>Return</p>
                      </a>
                </div> 
            </div> -->
        </div>

      <!-- Projects Row  3-->
      <div class="row">
            <!-- <div class="col-md-2 portfolio-item">
                  <div class="menu-item forestgreen" style="height:150px;">
                        <a href="<?php echo base_url().'admin/Kategori'?>" data-toggle="modal">
                              <i class="fa fa-cog"></i>
                              <p style="text-align:left;font-size:14px;padding-left:5px;">Kategori</p>
                        </a>
                  </div> 
            </div> -->
            <!-- <div class="col-md-2 portfolio-item">
                  <div class="menu-item cadetblue" style="height:150px;">
                        <a href="<?php echo base_url().'admin/Area'?>" data-toggle="modal">
                              <i class="fa fa-map-marked"></i>
                              <p style="text-align:left;font-size:14px;padding-left:5px;">Area</p>
                        </a>
                  </div> 
            </div> -->
            <div class="col-md-3 portfolio-item">
                  <div class="menu-item goldenrod" style="height:150px;">
                        <a href="<?php echo base_url().'admin/Customer'?>" data-toggle="modal">
                              <i class="fa fa-hand-holding-usd"></i>
                              <p style="text-align:left;font-size:14px;padding-left:5px;">Customer</p>
                        </a>
                  </div> 
            </div>

            <div class="col-md-3 portfolio-item">
                  <div class="menu-item softblue" style="height:150px;">
                        <a href="<?php echo base_url().'admin/Laba_rugi'?>" data-toggle="modal">
                              <i class="fa fa-money-check"></i>
                              <p style="text-align:left;font-size:14px;padding-left:5px;">Laba Rugi</p>
                        </a>
                  </div> 
            </div>
            <div class="col-md-3 portfolio-item">
                  <div class="menu-item lightgreen" style="height:150px;">
                        <a href="<?php echo base_url().'admin/Setoran_hutang'?>" data-toggle="modal">
                              <i class="fa fa-calculator"></i>
                              <p style="text-align:left;font-size:14px;padding-left:5px;">Setoran Hutang</p>
                        </a>
                  </div> 
            </div>
            <!-- <div class="col-md-2 portfolio-item">
                  <div class="menu-item softblue" style="height:150px;">
                        <a href="<?php echo base_url().'admin/Sales_mapping'?>" data-toggle="modal">
                              <i class="fa fa-network-wired"></i>
                              <p style="text-align:left;font-size:14px;padding-left:5px;">Sales Mapping</p>
                        </a>
                  </div> 
            </div> -->
             <!-- <div class="col-md-2 portfolio-item">
                  <div class="menu-item lightgreen" style="height:150px;">
                        <a href="<?php echo base_url().'admin/Setoran_hutang'?>" data-toggle="modal">
                              <i class="fa fa-calculator"></i>
                              <p style="text-align:left;font-size:14px;padding-left:5px;">Setoran Hutang</p>
                        </a>
                  </div> 
            </div> -->
            <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item new-orange" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Sales_audit'?>" data-toggle="modal">
                           <i class="fa fa-money-check"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Sales Audit</p>
                      </a>
                </div> 
            </div> -->

            <!-- <div class="col-md-2 portfolio-item">
                <div class="menu-item red" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Authorized'?>" data-toggle="modal">
                           <i class="fa fa-key"></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Authorized</p>
                      </a>
                </div> 
            </div>  -->
      </div>
        <!-- <div class="row">
            <div class="col-md-2 portfolio-item">
                <div class="menu-item light-red" style="height:150px;">
                     <a href="<?php echo base_url().'admin/Customer'?>" data-toggle="modal">
                           <i class="fa fa-recycle"></i>
                            <p>Customer</p>
                      </a>
                </div> 
            </div>
        </div> -->
        
		
        <!-- /.row -->

	
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url().'assets/js/jquery.js'?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>

</body>

</html>