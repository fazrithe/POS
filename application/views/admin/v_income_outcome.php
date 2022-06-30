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
</head>

<body>

    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <center><?php echo $this->session->flashdata('msg');?></center>
                <h1 class="page-header">Income/
                    <small>Outcome</small>
                    
                </h1>
            </div>
        </div>
        <form class="form-horizontal" action="<?php echo base_url().'admin/Income_outcome/store'?>" method="post">
            <div id="dynamic_field">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Tanggal</label>
                    <div class="col-sm-5">
                        <!-- <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name[]"autocomplete="off"> -->
                        <div class='input-group date' id='datepicker' style="width:200px;">
                            <input type='text' name="tgl[]" class="form-control" value="<?php echo $this->session->userdata('tglfak');?>" placeholder="Tanggal..." required/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
    
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Income/Outcome</label>
                    <div class="col-sm-5">
                        <select class="selectpicker show-tick form-control" id="io" placeholder="Please choose..." name="io[]" autocomplete="off">
                            <option value="2">Select</option>
                            <option value="1">Income</option>
                            <option value="0">Outcome</option>
                        </select>                    
                    </div>
                </div>
    
                <div class="form-group">
                    <label class="control-label col-sm-2" for="description">Description</label>
                        <div class="col-sm-5">          
                            <textarea class="form-control" id="description" name="description[]" autocomplete="off" placeholder="Enter description" required></textarea>
                        </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="description">Nominal</label>
                        <div class="col-sm-5">          
                            <input type="text" class="form-control uang" id="nominal" placeholder="Enter Nominal" name="nominal[]" autocomplete="off" required>
                            </input>
                        </div>
                </div>
            </div>  
    
            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                </div>
            </div>
        
            <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" /> 
        </form>
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
    <!-- /home/daniel/Downloads/jquery-ui-1.12.1 -->
    <script type="text/javascript">
            $(function () {
                // alert("tes");
                // $('#datetimepicker').datetimepicker({
                //     format: 'DD MMMM YYYY HH:mm',
                // });
                
                $('#datepicker').datetimepicker({
                    format: 'YYYY-MM-DD',
                });

                // for {

                // }

                $('#datepicker2').datetimepicker({
                    format: 'YYYY-MM-DD',
                });

                $('#timepicker').datetimepicker({
                    format: 'HH:mm'
                });
            });
    </script>

<script type="text/javascript">

    function addCommas(nStr) {
    	var val = nStr;
  		val = val.replace(/[^0-9\.]/g,'');
		if(val != "") {
			valArr = val.split('.');
			valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
			val = valArr.join('.');
		}
  		return val;
	}

    $(document).ready(function(){      
      var i=1;  

      $('#add').click(function(){  
           i++;             

        //    <div class="form-group"><label class="control-label col-sm-2" for="description">Nominal</label><div class="col-sm-5"><input type="text" class="form-control uang" id="nominal" placeholder="Enter Nominal" name="nominal[]" autocomplete="off"></input></div></div>

           $('#dynamic_field').append('<div id="row'+i+'"><div class="form-group"><label class="control-label col-sm-2" for="name">Tanggal</label><div class="col-sm-5"><div class="input-group date" id="datepickertes'+i+'" style="width:200px;"><input type="text" name="tgl[]" class="form-control" value="" placeholder="Tanggal..." required/><span class="input-group-addon" id="tes'+i+'"><span class="glyphicon glyphicon-calendar"></span></span></div></div></div><div class="form-group"><label class="control-label col-sm-2" for="io1">Income/Outcome</label><div class="col-sm-5"><select class="selectpicker show-tick form-control" id="io1" placeholder="Please choose..." name="io[]" autocomplete="off"><option value="0">Select</option><option value="1">Income</option><option value="2">Outcome</option></select></div></div><div class="form-group"><label class="control-label col-sm-2" for="description">Description</label><div class="col-sm-5"><textarea class="form-control" id="description" name="description[]"autocomplete="off" placeholder="Enter description" required></textarea></div></div><div class="form-group"><label class="control-label col-sm-2" for="description">Nominal</label><div class="col-sm-5"><input type="text" class="form-control uang" id="nominal'+i+'" placeholder="Enter Nominal" name="nominal[]" autocomplete="off" required></input></div><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div></div>');
           
           var button_id = $("#tes"+i+'').attr("id");
        //    var nominal_id = $("#nominal"+i+'').attr("id");
        
            $('#datepicker'+button_id+'').datetimepicker({
                format: 'YYYY-MM-DD',
            });

            $("#nominal"+i+'').keyup(function(){
                oldVal = this.value;
                // alert(oldVal);
                this.value = addCommas(oldVal);
            });

            $('.selectpicker').selectpicker('render');

     });

   
    //   $('#add').click(function(){  
    //        i++;             
    //        $('#dynamic_field').append('<div id="row'+i+'"><div class="form-group"><label class="control-label col-sm-2" for="name">Tanggal</label><div class="col-sm-5"><input type="text" class="form-control"  placeholder="Enter Name" name="name[]" autocomplete="off"></div></div><div class="form-group"><label class="control-label col-sm-2" for="email">Email:</label><div class="col-sm-5"><input type="email" class="form-control" id="email" placeholder="Enter email" name="email[]" autocomplete="off"></div></div><div class="form-group"><label class="control-label col-sm-2" for="mobno">Mobile Number:</label><div class="col-sm-5"><input type="number" class="form-control" id="mobno" placeholder="Enter Mobile Number" name="mobno[]" autocomplete="off"></div><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div></div>');
    //  });
     
     $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id"); 
           var res = confirm('Are You Sure You Want To Delete This?');
           if(res==true){
           $('#row'+button_id+'').remove();  
           $('#'+button_id+'').remove();  
           }
      });  

      $(document).on('click', '.input-group-addon', function(){  
           var button_id = $(this).attr("id"); 
           $('#datepicker'+button_id+'').datetimepicker({
                    format: 'YYYY-MM-DD',
                });
        //    alert(button_id);
        //    var res = confirm('Are You Sure You Want To Delete This?');
        //    if(res==true){
        //    $('#row'+button_id+'').remove();  
        //    $('#'+button_id+'').remove();  
        //    }
      });
  
    });  
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
    <script type="text/javascript">
        $(document).ready(function(){             
            $("#kode_brg").autocomplete({
              source: "<?php echo base_url().'admin/Pembelian/get_autocomplete';?>"
            });
            
            //Ajax kabupaten/kota insert
            $("#kode_brg").focus();
            
            $("#kode_brg").keyup(function(){
                var kobar = {kode_brg:$(this).val()};
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url().'admin/Pembelian/get_barang';?>",
                    data: kobar,
                    success: function(msg){
                        $('#detail_barang').html(msg);
                    }
                });
            }); 

            $("#kode_brg").keypress(function(e){
                if(e.which==13){
                    $("#jumlah").focus();
                }
            });

            $(".uang").keyup(function(){
                oldVal = this.value;
                // alert("ss");
                this.value = addCommas(oldVal);
            })
        });
    </script>
    
</body>

</html>
