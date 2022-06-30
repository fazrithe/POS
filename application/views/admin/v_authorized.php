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
                <h1 class="page-header">User
                    <small>Authorized</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
            <table border = "0"align ="center" style="font-size:11px;" id="mydata">
                <tr>
                    <td>Old Password</td>
                    <td>:</td>
                    <td><input type="password" name="oldpassw" id="oldpassw"></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>:</td>
                    <td><input type="password" name="newpassw" id="newpassw"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>:</td>
                    <td><input type="password" name="confirmpassw" id="confirmpassw"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr align="right">
                    <td></td>
                    <td></td>
                    <td><button id="btn_process" class="btn btn-success"> Simpan</button></td>                    
                </tr>
                <tr><td><input type="hidden" id="op" name="op" value="<?php echo $this->session->userdata('op');?>"></td></tr>
            </table>    

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

        $(document).ready(function() {
            // setTimeout(function(){ $('#oldpassw').val('');}, 50);
            $("#oldpassw").focus();
            $("#btn_process").click(function(){
                var oldpassw = $("#oldpassw").val();
                var newpassw = $("#newpassw").val().trim();
                var confirmpassw = $("#confirmpassw").val().trim();
                var voldpass = $("#op").val();
                
                if(newpassw == "" || confirmpassw ==""){
                    Swal.fire({
                        type:'error',
                        title: 'Oops...',
                        text: 'Not allowed white space!!!',
                        footer: '<a href="https://google.com">Why do I have this issue?</a>'
                            }).then (function(){
                                location.reload();
                            })
                }else if (newpassw != confirmpassw){
                    Swal.fire({
                        type:'error',
                        title: 'Oops...',
                        text: 'Password is not match!!!',
                        footer: '<a href="https://google.com">Why do I have this issue?</a>'
                            }).then (function(){
                                location.reload();
                            })
                }else if (voldpass != oldpassw){
                    Swal.fire({
                        type:'error',
                        title: 'Oops...',
                        text: 'Wrong Credential!!!',
                        footer: '<a href="https://google.com">Why do I have this issue?</a>'
                            }).then (function(){
                                location.reload();
                            })                            
                }else{
                    $.ajax({
                        type: "POST",
                        data: {newpassw:newpassw,oldpassw:oldpassw},
                        url: "<?php echo base_url()?>admin/Authorized/change_password",
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
                                    text: 'Failed update password',
                                    footer: '<a href="https://google.com">Why do I have this issue?</a>'
                                },function(){
                                    location.reload();
                                })
                            }                        
                        }
                    })
                }

            })
        });
    </script>
    
    
</body>

</html>
