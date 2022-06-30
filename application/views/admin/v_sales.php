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
    <link href="<?php echo base_url().'assets/swal/sweetalert2.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/swal/all.css'?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/css/style.css'?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/css/font-awesome.css'?>" rel="stylesheet">
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
                <h1 class="page-header">Data
                    <small>Sales</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Sales</a></div>
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
                        <th>Nama</th>
                        <th>Sales Status</th>                                                
                        <th style="width:140px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;                    
                        $sales_id=$a['sales_id'];
                        $karyawan_id=$a['karyawan_id'];   
                        $sales_nama=$a['karyawan_nama'];                    
                        $sales_status=$a['sales_status'];
                        $karyawan_status=$a['karyawan_status'];
                ?>
                <?php
                    $desc_status = "Tidak Aktif";
                    if ($sales_status == 1){
                        $desc_status = "Aktif";
                    }
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no;?></td>                        
                        <td><?php echo $sales_nama;?></td>
                        <td><?php echo $desc_status;?></td>                    
                        <td style="text-align:center;">                            
                            <a class="btn btn-xs btn-danger" href="#modalHapusSales<?php echo $karyawan_id?>" data-toggle="modal" title="Hapus"><span class="fa fa-close"></span> Hapus</a>
                        </td>                        
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            </div>
        </div>
        <!-- /.row -->
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="largeModal" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Sales</h3>
            </div>
            <div class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Sales</label>
                        <div class="col-xs-9">
                        <select id='selSales' style='width: 200px;'>
                            <option value='0'>-- Pilih sales --</option>
                        </select>
                        </div>
                    </div>                     
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="simpan">Simpan</button>
                </div>
                </div>
            </div>
            </div>
        </div>

       <!-- ============ MODAL HAPUS =============== -->
       <?php
                    foreach ($data->result_array() as $a) {
                        $id=$a['karyawan_id'];                       
                    ?>
                <div id="modalHapusSales<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Hapus Karyawan</h3>
                    </div>
                    
                        <div class="modal-body">                            
                            <p>Yakin mau menghapus data karyawan ini..?</p>                                    
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-primary btnHapus" value ="<?php echo $id;?>"data-dismiss="modal">Hapus</button>                            
                        </div>
                    
                </div>
                </div>
                </div>
            <?php
        }
        ?>

        <!--END MODAL-->

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
    

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url().'assets/dist/js/bootstrap-select.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/dataTables.bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.price_format.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/dist/js/bootstrap-select.js'?>"></script>
    <!-- Select2 JS -->
   <script src="<?php echo base_url().'assets/select2/dist/js/select2.min.js'?>"></script>
    <script type="text/javascript">

        $(document).ready(function() {         
            $('.bootstrap-select').selectpicker();                        

            $("#selSales").select2({                
                ajax: { 
                    url: "<?php echo base_url()?>admin/Sales/getKaryawan",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

            $(document).on('click', ".btnHapus",function(){                   
                var karyawan_id = $(this).val();
                
                $.ajax({
                    type: "POST",
                    data: {karyawan_id:karyawan_id},
                    url : "<?php echo base_url()?>admin/Sales/nonaktifkan",
                    success:function(data){  
                        var data = $.parseJSON(data);                                               
                        if (data.status == 1){
                            Swal.fire({
                                type:'success',
                                title: 'Sukses!',
                                text: data.message,                                
                            }).then (function(){
                                location.reload();
                            })
                        }else{
                            Swal.fire({
                                type:'error',
                                title: 'Oops...',
                                text: data.message,
                                footer: '<a href="https://google.com">Why do I have this issue?</a>'
                            },function(){
                                location.reload();
                            })
                        }  
                    }
                });
            });

            $("#simpan").click(function(){                       
                karyawan_id = $("#selSales").val();                        
                
                $.ajax({
                    type: "POST",
                    data: {karyawan_id: karyawan_id},
                    url: "<?php echo base_url()?>admin/Sales/insert_sales", 
                    success:function(data){                        
                        var data = $.parseJSON(data);                                         
                        if (data.status == 1 || data.status == 2){
                            Swal.fire({
                                type:'success',
                                title: 'Sukses!',
                                text: data.message,                                
                            }).then (function(){
                                location.reload();
                            })
                        }else if (data.status == 3){
                            Swal.fire({
                                type:'warning',
                                title: 'Oops...',
                                text: data.message,                                
                            }),then (function(){
                                location.reload();
                            })
                        }else if (data.status == 0){
                            Swal.fire({
                                type:'error',
                                title: 'Oops...',
                                text: data.message,
                                footer: '<a href="https://google.com">Why do I have this issue?</a>'
                            },function(){
                                location.reload();
                            })
                        }
                        
                    }
                });
            })
            
            $('#mydata').DataTable();
        });
    </script>
    
    
</body>

</html>