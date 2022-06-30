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
                <h1 class="page-header">Data
                    <small>Karyawan</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Karyawan</a></div>
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
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Domisili</th>
                        <th>Status</th>
                        <th>isActive</th>
                        <th style="width:140px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;
                        $defJK = "Wanita";
                        $defStatus = "Belum Kawin";
                        $defIsActive = "Non Aktif";

                        $id=$a['karyawan_id'];
                        $nm=$a['karyawan_nama'];
                        $tmpLahir=$a['karyawan_tempatlahir'];
                        $tglLahir=$a['karyawan_tgllahir'];
                        $domisili=$a['karyawan_domisili'];
                        $status=$a['karyawan_marrital'];
                        $isActive=$a['karyawan_status'];
                        $jKelamin=$a['karyawan_gender'];                    
                ?>
                <?php                                                                            
                    if ($jKelamin == 1){                        
                        $defJK = "Pria";
                    }                    
                    if ($status == 1){
                        $defStatus = "Kawin";
                    }                    
                    if ($isActive == 1){
                        $defIsActive = "Aktif";
                    }                    
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no;?></td>
                        <td><?php echo $nm;?></td>
                        <td><?php echo $tmpLahir;?></td>
                        <td><?php echo $tglLahir;?></td>
                        <td><?php echo $defJK;?></td>
                        <td><?php echo $domisili;?></td>
                        <td><?php echo $defStatus;?></td>
                        <td><?php echo $defIsActive;?></td>
                        <td style="text-align:center;">
                            <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo $id?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                            <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id?>" data-toggle="modal" title="Hapus"><span class="fa fa-close"></span> Nonaktifkan</a>
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
                <h3 class="modal-title" id="myModalLabel">Tambah Karyawan</h3>
            </div>
            <div class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama</label>
                        <div class="col-xs-9">
                            <input name="nama" id="add_nama" class="form-control" type="text" placeholder="Input Nama..." style="width:280px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tempat Lahir</label>
                        <div class="col-xs-9">
                            <input name="tmpLahir" id="add_tmpLahir"class="form-control" type="text" placeholder="Input Tempat Lahir..." style="width:280px;" required>
                        </div>
                    </div>                   

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Lahir</label>
                        <div class="col-xs-9">
                            <!-- <input name="tglLahir" id="add_tglLahir" class="form-control" type="date" placeholder="Input Tanggal Lahir..." style="width:280px;" value=required> -->
                            <input type="date" id="add_tglLahir" name="tglLahir" data-date="" data-date-format="DD MMMM YYYY" value="2015-08-09">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jenis Kelamin</label>
                        <div class="col-xs-7">
                             <select name="jenisKelamin" id="add_jenisKelamin" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Jenis Kelamin" data-width="80%" placeholder="Pilih Satuan" required>
                                <option value="1" selected="selected">Pria</option>
                                <option value="2">Wanita</option>                                
                             </select>
                        </div>
                    </div>              
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Domisili</label>
                        <div class="col-xs-9">
                            <input name="domisili" id="add_domisili" class="form-control" type="text" placeholder="Input Domisili..." style="width:280px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Status</label>
                        <div class="col-xs-7">
                             <select name="status" id="add_status" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Status" data-width="80%" placeholder="Pilih Satuan" required>
                                <option value="1" selected="selected">Kawin</option>
                                <option value="2">Belum Kawin</option>                                
                             </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >isActive</label>
                        <div class="col-xs-7">
                             <select name="isActive" id="add_isActive" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih isActive" data-width="80%" placeholder="Pilih Satuan" required>
                                <option value="1" selected="selected">Aktif</option>
                                <option value="2">Non Aktif</option>                                
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

        <!-- ============ MODAL EDIT =============== -->
        <?php            
                    foreach ($data->result_array() as $a) {
                        $id=$a['karyawan_id'];
                        $nm=$a['karyawan_nama'];
                        $tmpLahir=$a['karyawan_tempatlahir'];
                        $tglLahir=$a['karyawan_tgllahir'];
                        $domisili=$a['karyawan_domisili'];
                        $status=$a['karyawan_marrital'];
                        $isActive=$a['karyawan_status'];
                        $jKelamin=$a['karyawan_gender'];
                    ?>

                <div id="modalEditPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Edit Karyawan</h3>
                    </div>
                    
                    <!-- <div class="form-horizontal"> -->
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/Karyawan/edit_karyawan'?>">
                        <div class="modal-body">
                            <form>
                            <input name="karyawan_id" id="karyawan_id" type="hidden" value="<?php echo $id;?>">

                            <div class="form-group">
                                <label class="control-label col-xs-3" >Nama</label>
                                <div class="col-xs-9">
                                    <input name="edit_nama" id="edit_nama" class="form-control" type="text" value="<?php echo $nm;?>" placeholder="Input Nama..." style="width:280px;" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-3" >Tempat Lahir</label>
                                <div class="col-xs-9">
                                    <input name="edit_tmpLahir" id="edit_tmpLahir" class="form-control" type="text" value="<?php echo $tmpLahir;?>" placeholder="Input tempat lahir..." style="width:280px;" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-3" >Tanggal Lahir</label>
                                <div class="col-xs-9">
                                    <input name="edit_tglLahir" id="edit_tglLahir" class="form-control" type="date" placeholder="Input tanggal lahir..." style="width:280px;" value="<?php echo $tglLahir;?>">
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Jenis Kelamin</label>
                                <div class="col-xs-8">
                                    <select name="edit_jeniskelamin" id="edit_jeniskelamin" class="selectpicker show-tick form-control" style="width:280px;" required>
                                    <?php if ($jKelamin =='1'):?>                                        
                                        <option value="1" selected>Pria</option>
                                        <option value="2">Wanita</option>                                        
                                    <?php else:?>
                                        <option value="1">Pria</option>
                                        <option value="2" selected>Wanita</option>
                                    <?php endif;?>
                                    </select>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="control-label col-xs-3" >Domisili</label>
                                <div class="col-xs-9">
                                    <input name="edit_domisili" id="edit_domisili" class="form-control" type="text" value="<?php echo $domisili;?>" placeholder="Input tempat lahir..." style="width:280px;" required>                                    
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Status</label>
                                <div class="col-xs-8">
                                    <select name="edit_status" id="edit_status" class="selectpicker show-tick form-control" style="width:280px;" required>
                                    <?php if ($status=='1'):?>
                                        <option value="1" selected>Kawin</option>
                                        <option value="2">Belum Kawin</option>
                                    <?php else:?>
                                        <option value="1">Kawin</option>
                                        <option value="2" selected>Belum Kawin</option>
                                    <?php endif;?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-3" >isActive</label>
                                <div class="col-xs-8">
                                    <select name="edit_isactive" id="edit_isactive" class="selectpicker show-tick form-control" style="width:280px;" required>
                                    <?php if ($isActive=='1'):?>
                                        <option value="1" selected>Aktif</option>
                                        <option value="0">Non Aktif</option>
                                    <?php else:?>
                                        <option value="1">Aktif</option>
                                        <option value="0" selected>Non Aktif</option>
                                    <?php endif;?>
                                    </select>
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
                        $id=$a['karyawan_id'];                       
                    ?>
                <div id="modalHapusPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
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
            $(document).on('click', ".btnHapus",function(){                   
                var karyawan_id = $(this).val();
                
                $.ajax({
                    type: "POST",
                    data: {karyawan_id:karyawan_id},
                    url : "<?php echo base_url()?>admin/Karyawan/nonaktifkan",
                    success:function(data){  
                        var data = $.parseJSON(data);                      
                        console.log(data);
                        alert(data.message);
                        location.reload();
                    }
                });
            });

            

            $("#simpan").click(function(){                      
                karyawan_nama         = $("#add_nama").val();
                karyawan_tmpLahir     = $("#add_tmpLahir").val();
                karyawan_tglLahir     = $("#add_tglLahir").val();
                karyawan_jenisKelamin = $("#add_jenisKelamin").val();
                karyawan_domisili     = $("#add_domisili").val();
                karyawan_status       = $("#add_status").val();
                karyawan_isActive     = $("#add_isActive").val();
                
                $.ajax({
                    type: "POST",
                    data: {karyawan_nama: karyawan_nama,
                            karyawan_tmpLahir: karyawan_tmpLahir,
                            karyawan_tglLahir: karyawan_tglLahir,
                            karyawan_jenisKelamin: karyawan_jenisKelamin,
                            karyawan_domisili: karyawan_domisili,
                            karyawan_status: karyawan_status,
                            karyawan_isActive: karyawan_isActive},
                    url: "<?php echo base_url()?>admin/Karyawan/tambah_karyawan", 
                    success:function(data){                        
                        var data = $.parseJSON(data);                                              
                        alert(data.message);
                        location.reload();
                        
                    }
                });
            })
            
            $('#mydata').DataTable();
        });
    </script>
    
    
</body>

</html>
