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
   <!-- Select2 JS -->
   <script src="<?php echo base_url().'assets/select2/dist/js/select2.min.js'?>"></script>

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
                    <small>Area</small>
                    <div class="pull-right"><a id="tambahArea" href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Area</a></div>
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
                        <th style="text-align:center;">Area</th>                    
                        <th style="width:140px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;                        

                        $id=$a['id_area'];
                        $nm=$a['area_nama'];                        
                        $isActive=$a['area_flagging'];                        
                ?>                
                    <tr>
                        <td style="text-align:center;"><?php echo $no;?></td>
                        <td><?php echo $nm;?></td>                        
                        <td style="text-align:center;">
                            <a class="btn btn-xs btn-warning" href="#modalEditArea<?php echo $id;?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                            <a class="btn btn-xs btn-danger" href="#modalHapusArea<?php echo $id?>" data-toggle="modal" title="Hapus"><span class="fa fa-close"></span> Hapus</a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            </div>
        </div>
        <!-- /.row -->
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Area</h3>
            </div>
            <div class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Area</label>
                        <div class="col-xs-9">
                            <input name="add_area" id="add_area" class="form-control" type="text" placeholder="Input Area..." style="width:280px;" required>
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

        <!-- ============ MODAL EDIT =============== -->
        <?php            
                    foreach ($data->result_array() as $a) {
                        $id=$a['id_area'];
                        $nm=$a['area_nama'];
                    ?>

                <div id="modalEditArea<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 class="modal-title" id="myModalLabel">Edit Karyawan</h3>
                            </div>
                            
                            <!-- <div class="form-horizontal"> -->
                            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/Area/edit_area'?>">
                                <div class="modal-body">
                                    <input name="area_id" id="area_id" type="hidden" value="<?php echo $id;?>">

                                    <div class="form-group">
                                        <label class="control-label col-xs-3" >Area</label>
                                        <div class="col-xs-9">
                                            <input name="area_name" id="area_name" class="form-control" type="text" value="<?php echo $nm;?>" placeholder="Input Area..." style="width:280px;" required>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>

       <!-- ============ MODAL HAPUS =============== -->
       <?php
                    foreach ($data->result_array() as $a) {
                        $id=$a['id_area'];                       
                    ?>
                <div id="modalHapusArea<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Hapus Area</h3>
                    </div>
                    
                        <div class="modal-body">                            
                            <p>Yakin mau menghapus data area ini..?</p>                                    
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

        function reset(){
            $("#add_area").val("");
        }

        $(document).ready(function() {
            $(document).on('click', ".btnHapus",function(){                   
                var area_id = $(this).val();
                
                $.ajax({
                    type: "POST",
                    data: {area_id:area_id},
                    url : "<?php echo base_url()?>admin/Area/nonaktifkan",
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

            $("#tambahArea").click(function(){
                reset();
            })

            $("#simpan").click(function(){                      
                area_name = $("#add_area").val();                
                $.ajax({
                    type: "POST",
                    data: {area_name: area_name,
                            area_flagging: 1},
                    url: "<?php echo base_url()?>admin/Area/tambah_area", 
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
            })

            $("#add_area").keypress(function(e){                
                if(e.which==13){                    
                    $("#simpan").focus();
                }
            });
            
            $('#mydata').DataTable();
        });
    </script>
    
    
</body>

</html>
