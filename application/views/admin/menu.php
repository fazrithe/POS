 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url().'Welcome'?>">Star-POS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   <?php $h=$this->session->userdata('akses'); ?>
                    <?php $u=$this->session->userdata('user'); ?>
                    <?php if($h=='1'){ ?> 
                     <!--dropdown-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span class="fa fa-shopping-cart" aria-hidden="true"></span> Transaksi</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url().'admin/Penjualan'?>"><span class="fa fa-shopping-bag" aria-hidden="true"></span> Penjualan</a></li> 
                            <li><a href="<?php echo base_url().'admin/Pembelian'?>"><span class="fa fa-cubes" aria-hidden="true"></span> Pembelian</a></li> 
                        </ul>
                    </li>
                    <!--ending dropdown-->
                    <li>
                        <a href="<?php echo base_url().'admin/After_sales'?>"><span class="fa fa-recycle"></span> Return</a>
                    </li>
                    <!-- <li>
                        <a href="<?php echo base_url().'admin/Grafik'?>"><span class="fa fa-line-chart"></span> Grafik</a>
                    </li> -->
                    <li>
                        <a href="<?php echo base_url().'admin/Laporan'?>"><span class="fa fa-file"></span> Laporan</a>
                    </li>
                    <?php }?>
                    <?php if($h=='2'){ ?> 
                      <!--dropdown-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span class="fa fa-shopping-cart" aria-hidden="true"></span> Transaksi</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url().'admin/Penjualan'?>"><span class="fa fa-shopping-bag" aria-hidden="true"></span> Penjualan (Eceran)</a></li> 
                            <li><a href="<?php echo base_url().'admin/Penjualan_grosir'?>"><span class="fa fa-cubes" aria-hidden="true"></span> Penjualan (Grosir)</a></li> 
                        </ul>
                    </li>
                    <!--ending dropdown-->
                    <li>
                        <a href="<?php echo base_url().'admin/Retur'?>"><span class="fa fa-recycle"></span> Return</a>
                    </li>
                    <?php }?>
                     <li>
                        <a href="<?php echo base_url().'Administrator/logout'?>"><span class="fa fa-sign-out"></span> Logout</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count_faktur" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-file" style="font-size:18px;"></span></a>
                        <ul class="dropdown-menu" id="dropdown-faktur"></ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
                        <ul class="dropdown-menu" id="dropdown-notif"></ul>
                    </li>
                </ul>


            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <script src="<?php echo base_url().'assets/js/jquery.js'?>"></script>    

    <script type="text/javascript">
        $(document).ready(function(){            
            function load_unseen_notification(view=''){
                $.ajax({
                    url: "<?php echo base_url()?>admin/Notification/show_notif", 
                    method:"POST",
                    data:{view:view},
                    dataType:"json",
                    success:function(data){
                        $('#dropdown-notif').html(data.notification);
                            if(data.unseen_notification > 0){
                                $('.count').html(data.unseen_notification);
                            }
                    }
                });
            }

            function load_unseen_notification_faktur(view=''){
                $.ajax({
                    url: "<?php echo base_url()?>admin/Notification/show_faktur", 
                    method:"POST",
                    data:{view:view},
                    dataType:"json",
                    success:function(data){
                        $('#dropdown-faktur').html(data.notification);
                            if(data.unseen_notification > 0){
                                $('.count_faktur').html(data.unseen_notification);
                            }
                    }
                });
            }

            load_unseen_notification();
            load_unseen_notification_faktur();
        })
    </script>