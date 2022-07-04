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

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <center><?php echo $this->session->flashdata('msg');?></center>
                <h1 class="page-header">Laba
                    <small>Rugi... on progress!!!</small>                    
                </h1>
            </div> 
        </div>
        <!-- /.row -->
        <!-- Projects Row -->


        <div class="row" id="radiobt_tahun">
            <div class="radio">
                <label><input type="radio" name="optradio" id="rd_tahun" value="Tahun" >By Tahun</label>
            </div>
        </div>        

        <div class="row" id="dropdown_tahun">
            <label class="control-label col-sm-1" for="email">Pilih Tahun</label>
            <div class="col-sm-2">
                <select class="selectpicker show-tick form-control" id="drd_tahun" placeholder="Please choose..." name="drd_tahun" autocomplete="off">
                </select>                    
            </div>
        </div>     
        
        <div class="row" id="radiobt_bulan">
            <div class="radio">
                <label><input type="radio" name="optradio" id="rd_bulan" value="Bulan">By Bulan</label>
            </div> 
        </div>

        <div class="row" id="dropdown_bulan">
            <label class="control-label col-sm-1" for="email">Pilih Bulan</label>
            <div class="col-sm-3">
                <select class="selectpicker show-tick form-control" id="drd_bulan" placeholder="Please choose..." name="drd_bulan" autocomplete="off">
                    <option value="0">Bulan di tahun berjalan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>                    
            </div>
        </div>

        <div class = "row">
            <button class="btn btn-success" id="btn_show">Show</button>
        </div>

        <div class = "row">
            </br>            
        </div>

        <div class="row">
            <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                <thead>
                    <tr>
                        <th style="font-size:14px;text-align:center;width:40px;">No</th>                        
                        <th style="font-size:14px;text-align:center;">Customer</th>                    
                        <th style="font-size:14px;text-align:center;">Total</th>
                    </tr>
                </thead>
                <tbody id ="table_customer">
                </tbody>
            </table>

            <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                <thead>
                    <tr>
                        <th style="font-size:14px;text-align:center;width:40px;">No</th>                        
                        <th style="font-size:14px;text-align:center;">Detail</th>                    
                        <th style="font-size:14px;text-align:center;">Nominal</th>
                    </tr>
                </thead>
                <tbody id ="table">
                </tbody>
            </table>

            </div>


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
                $("#dropdown_tahun").hide();
                $("#dropdown_bulan").hide();
                var valRadio = $('input:radio[name="optradio"]').val();
                uncheck();

                function uncheck(){                    
                    document.getElementById("rd_tahun").checked = false;
                    document.getElementById("rd_bulan").checked = false;
                }

                $('input:radio[name="optradio"]').change(function(){
                    var drTahun = document.getElementById('dropdown_tahun');
                    var drBulan = document.getElementById('dropdown_bulan');
                    if($(this).val() == 'Tahun'){                                                
                        drTahun.style.display = 'block';
                        drBulan.style.display = 'none';                            
                    }else{
                        drTahun.style.display = 'none';
                        drBulan.style.display = 'block';
                    }
                });

                $('#drd_tahun').each(function() {
                    var year = (new Date()).getFullYear();
                    var current = year;
                    year -= 3;
                    for (var i = 0; i < 6; i++) {
                      if ((year+i) == current)
                        $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
                      else
                        $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
                    }
                })

                $('#btn_show').click(function(){
                    // alert(valRadio);
                    var checkedTahun = document.getElementById("rd_tahun").checked;
                    var checkedBulan = document.getElementById("rd_bulan").checked;
                    var filter;
                    if (checkedTahun){
                        var valTahun = document.getElementById("drd_tahun").value;
                        filter = valTahun;
                        // alert(valTahun);
                    }else if(checkedBulan){
                        var valBulan = document.getElementById("drd_bulan").value;
                        filter = valBulan;
                        if (valBulan == 0) {
                            alert("Please select your dropdown correctly");
                            return;
                        }                        
                    }

                    if (!checkedTahun && !checkedBulan){
                        alert("You have to choose first!!");
                    }else{
                        $.ajax({
                            type: "POST",
                            data: {filter: filter},
                            url: "<?php echo base_url()?>admin/Laba_rugi/get_data", 
                            success:function(data){                        
                                // var data = $.parseJSON(data);
                                // console.log(data);  
                                $("#table").html(data);
                                // if (data.status == 1){
                                //     Swal.fire({
                                //         type:'success',
                                //         title: 'Sukses!',
                                //         text: data.message,                                
                                //     }).then (function(){
                                //         location.reload();
                                //     })
                                // }else{
                                //     Swal.fire({
                                //         type:'error',
                                //         title: 'Oops...',
                                //         text: data.message,
                                //         footer: '<a href="https://google.com">Why do I have this issue?</a>'
                                //     },function(){
                                //         location.reload();
                                //     })
                                // }                                        
                            }
                        });

                        $.ajax({
                            type: "POST",
                            data: {filter: filter},
                            url: "<?php echo base_url()?>admin/Laba_rugi/get_data_customer", 
                            success:function(data){                        
                                // var data = $.parseJSON(data);
                                // console.log(data);  
                                $("#table_customer").html(data);
                                // if (data.status == 1){
                                //     Swal.fire({
                                //         type:'success',
                                //         title: 'Sukses!',
                                //         text: data.message,                                
                                //     }).then (function(){
                                //         location.reload();
                                //     })
                                // }else{
                                //     Swal.fire({
                                //         type:'error',
                                //         title: 'Oops...',
                                //         text: data.message,
                                //         footer: '<a href="https://google.com">Why do I have this issue?</a>'
                                //     },function(){
                                //         location.reload();
                                //     })
                                // }                                        
                            }
                        });
                    }
                })
                
            })
        </script>
       
</body>

</html>

