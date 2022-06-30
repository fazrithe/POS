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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap-datetimepicker.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/jquery-ui-1.12.1/jquery-ui.css'?>">
    <!-- Swal -->
    <link href="<?php echo base_url().'assets/swal/sweetalert2.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/swal/all.css'?>" rel="stylesheet">
    <script src="<?php echo base_url().'assets/swal/sweetalert2.min.js'?>"></script>
    <link href="<?php echo base_url().'assets/css/font-awesome.css'?>" rel="stylesheet">
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
                    <small>Return</small>
                    
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">            
            <table>                
                <tr>
                    <!-- <th style="width:100px;padding-bottom:5px;">No Faktur</th> -->
                    <!-- <th style="width:300px;padding-bottom:5px;"><input type="text" name="nofak" value="<?php echo $this->session->userdata('nofak');?>" class="form-control input-sm" style="width:200px;" required></th> -->
                    <th style="width:90px;padding-bottom:5px;">Faktur</th>
                    <td style="width:350px;">
                    <!-- <input type="text" name="input_pembelian" id="input_pembelian"class="form-control input-sm" style="width:200px;" required> -->
                    <select name="nofak" id="nofak" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Faktur" data-width="100%" required>
                        <?php foreach ($faktur->result_array() as $i) {
                            $jual_nofak=$i['jual_nofak'];
                            // $nm_sup=$i['suplier_nama'];
                            // $al_sup=$i['suplier_alamat'];
                            // $notelp_sup=$i['suplier_notelp'];
                            $sess_id=$this->session->userdata('jual_nofak');
                            if($sess_id==$id_sup)
                                echo "<option value='$jual_nofak' selected>$jual_nofak</option>";
                            else
                                echo "<option value='$jual_nofak'>$jual_nofak</option>";
                        }?>
                    </select>
                    </td>                    
                </tr>
                <th style="width:100px;padding-bottom:5px;"></th>                
                <tr>
                    <th>Tanggal</th>
                    <td>
                        <div class='input-group date' id='datepicker' style="width:200px;">
                            <input type='text' id="tgl" name="tgl" class="form-control" value="<?php echo $this->session->userdata('tglfak');?>" placeholder="Tanggal..." required/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </td>
                </tr>                
                <th style="width:100px;padding-bottom:5px;"></th>                
                <th style="width:100px;padding-bottom:5px;"></th>                
            </table>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>                
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td><button id="confirm" class="btn btn-success">Confirm</button></td>
            <hr/>             
            <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Nomor Faktur</th>
                        <th style="text-align:center;">Kode Barang</th>
                        <th style="text-align:center;">Nama Barang</th>
                        <th style="text-align:center;">Satuan</th>
                        <th style="text-align:center;">Harga Pokok</th>
                        <th style="text-align:center;">Harga Jual</th>
                        <th style="text-align:center;">Qty</th>
                        <th style="text-align:center;">Diskon</th>                        
                        <th style="text-align:center;">Total</th>
                        <th style="width:100px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody id ="table">
                </tbody>
            </table>
            <!-- <a href="<?php echo base_url().'admin/Pembelian/simpan_pembelian'?>" class="btn btn-info btn-lg"><span class="fa fa-save"></span> Simpan</a> -->
            </div>
        </div>
        <!-- Modal Edit Start -->            
        <div class="modal fade" id="insert_retur" role="dialog">
		    <div class="modal-dialog">
		        <div class="modal-content">
			        <div class="modal-header" style="color:#fff;background-color: #e35f14;padding:6px;">
			            <h5 class="modal-title"><i class="fa fa-edit"></i> Detail Return</h5>
			        </div>
			        <div class="modal-body">
                            
                <!--1-->
                        <div class="row" style="padding-bottom:5px">
					        <div class="col-md-4">
					            <label>Tukar dengan</label>
					        </div>
                            <div class="col-md-8">
                            <select name="change_with" onchange="returnType()" id="change_with" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Jenis Return" data-width="80%" placeholder="Pilih Jenis Return" required>
                                <option value="1">Item</option>
                                <option value="2">Cash</option>                                
                             </select>
                            </div>	
                        </div>
                <!--2-->
                <div class="row" style="padding-bottom:5px">
					        <div class="col-md-4">
					            <label>Barang Id</label>
					        </div>
                            <div class="col-md-8">
                                <input type="text" name="t_barang_id" id="t_barang_id" class="form-control-sm" readonly>
                            </div>	
                        </div>	
                <!--3-->
                <div class="row" style="padding-bottom:5px">
					        <div class="col-md-4">
					            <label>Barang Nama</label>
					        </div>
                            <div class="col-md-8">
                                <input style="width:250px" type="text" name="t_barang_nama" id="t_barang_nama" class="form-control-sm" readonly>
                            </div>	
                        </div>	        				        
			    <!--4-->
                        <div class="row" style="padding-bottom:5px">
					        <div class="col-md-4">
					            <label>Qty/Nominal</label>
					        </div>
                            <div class="col-md-8">
                                <input type="text" name="t_qty" id="t_qty" class="form-control-sm" required>
                            </div>	
                        </div>
                <!--5-->
                        <div class="row" style="padding-bottom:5px" id="good_quality">
					        <div class="col-md-4">
					            <label>Good Quality</label>
					        </div>
                            <div class="col-md-8">
                                <input type="text" name="t_good_quality" id="t_good_quality" class="form-control-sm" >
                            </div>	
                        </div>
                <!--6-->
                        <div class="row" style="padding-bottom:5px" id="broke_quality">
					        <div class="col-md-4">
					            <label>Broke Quality</label>
					        </div>
                            <div class="col-md-8">
                                <input type="text" name="t_broke_quality" id="t_broke_quality" class="form-control-sm" >
                            </div>	
                        </div>
                <!--7-->                     
                        <div class="row" style="padding-bottom:5px">
					        <div class="col-md-4">
					            <label>Keterangan</label>
					        </div>
                            <div class="col-md-8">
                                <textarea name="t_reason" id="t_reason" class="form-control-sm" ></textarea>
                            </div>	
                        </div>
                        <input type="hidden" name="d_jual_id_modal" id="d_jual_id_modal" class="form-control-sm">
                        <input type="hidden" name="d_jual_nofak_modal" id="d_jual_nofak_modal" class="form-control-sm">
                        <input type="hidden" name="d_barangId_modal" id="d_barangId_modal" class="form-control-sm">
                        <input type="hidden" name="d_harpok_modal" id="d_harpok_modal" class="form-control-sm">
                        <input type="hidden" name="d_harjul_modal" id="d_harjul_modal" class="form-control-sm">
                        <input type="hidden" name="d_status_modal" id="d_status_modal" class="form-control-sm">
			        </div>
                    <div class="modal-footer" style="padding-bottom:0px !important;text-align:center !important;">
                        <p style="text-align:center;float:center;"><button type="btn" id="update_data" class="btn btn-default btn-sm" style="background-color: #e35f14;color:#fff;">Save</button>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="background-color: #e35f14;color:#fff;" id="close_btn">Close</button></p>
                    </div>
		        </div>
		    </div>
	    </div>

        <!-- Modal Edit End -->
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
    <script src="<?php echo base_url().'assets/js/moment.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap-datetimepicker.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/jquery-ui-1.12.1/jquery-ui.js'?>"></script>    
    <script type="text/javascript">
            function returnType(){
                var valueReturn = document.getElementById("change_with").value;                    
                if(valueReturn == 1){
                    $("#good_quality").show();
                    $("#broke_quality").show();
                }else{
                    $("#good_quality").hide();
                    $("#broke_quality").hide();
                }

            }
            $(function () {
                $('#datetimepicker').datetimepicker({
                    format: 'DD MMMM YYYY HH:mm',
                });
                
                $('#datepicker').datetimepicker({
                    format: 'YYYY-MM-DD',
                });
                $('#datepicker2').datetimepicker({
                    format: 'YYYY-MM-DD',
                });

                $('#timepicker').datetimepicker({
                    format: 'HH:mm'
                });
            });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){  
            $('#close_btn').click(function(){
                $('#t_qty').val("");
                $('#t_good_quality').val("");
                $('#t_broke_quality').val("");
                $('#t_reason').val("");
                $('#t_broke_quality').val("");
                $('#d_status_modal').val("");
                reload_page();
                // $('#change_with').val("");
            });
            $('#good_quality').hide();
            $('#broke_quality').hide();          
            $('#confirm').click(function(){
                var noFak = $('#nofak').val();
                var tanggal = $('#tgl').val();

                if (noFak == ""){
                    Swal.fire({
                        type:'error',
                        title: 'Oops...',
                        text: 'Faktur wajib diisi!',
                        footer: '<a href="https://google.com">Why do I have this issue?</a>'
                        },function(){
                            $('#nofak').focus();
                        })
                    // alert("Faktur wajib diisi!");                    
                }else if (tanggal == ""){
                    Swal.fire({
                        type:'error',
                        title: 'Oops...',
                        text: 'Tanggal wajib diisi',
                        footer: '<a href="https://google.com">Why do I have this issue?</a>'
                        },function(){
                            $('#tgl').focus();
                        })
                    // $('#tgl').focus();
                }else{
                    $.ajax({
                        type: "POST",
                        data: {noFak:noFak},
                        url: "<?php echo base_url()?>admin/After_sales/tampil_faktur",
                        success:function(data){                            
                            $("#table").html(data);
                        }
                    });
                }
            });

            function reload_page(){
                var noFak = $('#nofak').val();
                $.ajax({
                        type: "POST",
                        data: {noFak:noFak},
                        url: "<?php echo base_url()?>admin/After_sales/tampil_faktur",
                        success:function(data){                            
                            $("#table").html(data);
                        }
                });
            }

            $(function () {
                $('#insert_retur').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);           
                    // console.log(button.data(d_jual_barang_nama));          
                    var d_jual_id = button.data('d_jual_id');                    
                    var d_jual_nofak = button.data('d_jual_nofak');                    
                    var d_jual_barang_id = button.data('d_jual_barang_id'); 
                    var d_jual_harpok = button.data('d_jual_barang_harpok');                   
                    var d_jual_harjul = button.data('d_jual_barang_harjul');
                    var d_jual_status = button.data('d_jual_status');
                    var d_jual_barang_nama = button.data('d_jual_barang_nama').replace(/_/g," ");                    

                    var modal = $(this);              
                    modal.find('#t_barang_id').val(d_jual_barang_id);   
                    modal.find('#t_barang_nama').val(d_jual_barang_nama);   
                    modal.find('#d_jual_id_modal').val(d_jual_id);
                    modal.find('#d_jual_nofak_modal').val(d_jual_nofak);
                    modal.find('#d_barangId_modal').val(d_jual_barang_id);
                    modal.find('#d_harpok_modal').val(d_jual_harpok);
                    modal.find('#d_harjul_modal').val(d_jual_harjul);
                    modal.find('#d_status_modal').val(d_jual_status);                    
                });
            });

            $(document).on("click","#update_data",function(){
                $.ajax({
                    url:"<?php echo base_url()?>admin/After_sales/proses_retur",
                    type:"POST",
                    cache:false,
                    data:{
                            d_jual_id:$('#d_jual_id_modal').val(),
                            d_jual_nofak:$('#d_jual_nofak_modal').val(),
                            d_qty_nominal:$('#t_qty').val(),
                            d_qty_good:$('#t_good_quality').val(),
                            d_qty_broke:$('#t_broke_quality').val(),
                            d_keterangan:$('#t_reason').val(),
                            d_change_with:$('#change_with').val(),
                            d_barang_id:$('#d_barangId_modal').val(),
                            d_harjul:$('#d_harjul_modal').val(),
                            d_harpok:$('#d_harpok_modal').val(),
                            d_status:$('#d_status_modal').val()
                    },
                    success: function(dataResult){
                        // var dataResult = JSON.parse(dataResult);
                        var dataResult = $.parseJSON(dataResult);                         
                        if(dataResult.status_code == 200){
                            Swal.fire({
                                type:'success',
                                title: 'Sukses!',
                                text: 'Data berhasil diinput ',                                
                            }).then (function(){
                                $('#insert_retur').modal().hide();                                
                                reload_page();
                            })                                                                                    
                        }else if(dataResult.status_code == 400){                            
                            Swal.fire({
                                type:'error',
                                title: 'Oops...',
                                text: 'Transaksi gagal! Data sudah pernah direturn by cash',
                                footer: '<a href="https://google.com">Why do I have this issue?</a>'
                            },function(){
                                $('#insert_retur').modal().hide();
                                reload_page();
                            })
                        }
                    }                    
                })                
            })
        });
    </script>
    
</body>

</html>
