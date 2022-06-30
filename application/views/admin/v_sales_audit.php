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
                <h1 class="page-header">Sales
                    <small>Audit</small>
                    <div class="pull-right"><a id="tambahCustomer" href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Customer</a></div>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <table>
                    <tr>
                        <td style="width:90px;padding-bottom:5px;"><b>Sales</b></td>
                        <td style="width:350px;padding-bottom:5px;">
                            <select name="sel_sales" id="sel_sales" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Sales" data-width="100%" required>
                                <?php foreach ($sales->result_array() as $i) {
                                    $id_sales=$i['sales_id'];
                                    $nm_sales=$i['karyawan_nama'];
                                    $sales_id = $this->session->userdata('sales_id');
                                    if($sales_id==$id_sales)
                                        echo "<option value='$id_sales' selected>$nm_sales</option>";
                                    else                                    
                                        echo "<option value='$id_sales'>$nm_sales</option>";
                                }?>
                            </select>
                        </td>                        
                    </tr>
                    <tr>
                        <td style="width:120px;padding-bottom:5px;"><b>Total Belanja</b></td>
                        <td style="width:350px;padding-bottom:5px;">
                            <input type="text" class="form-control input sm" name="sum_belanja" id="sum_belanja" readonly value="<?php echo number_format($this->session->userdata('sum_belanja'));?>">
                        </td>                        
                    </tr>
                    <tr>
                        <td style="width:90px;padding-bottom:5px;"><b>Setoran Sales</b></td>
                        <td style="width:350px;padding-bottom:5px;">
                            <input type="text" class="form-control input sm" name="sum_setoran" id="sum_setoran" readonly value="<?php echo number_format($this->session->userdata('sum_setoran'));?>">
                        </td>                        
                    </tr>
                    <tr>
                        <td style="width:90px;padding-bottom:5px;"><b>Sisa Faktur</b></td>
                        <td style="width:350px;padding-bottom:5px">
                            <input type="text" class="form-control input sm" name="sisa_faktur" id="sisa_faktur" readonly value="<?php echo number_format($this->session->userdata('sum_belanja')-$this->session->userdata('sum_setoran'));?>">
                        </td>                        
                    </tr>                
                </table>
                &nbsp;
            </div>
        </div>
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                <thead>
                    <tr>
                        <th style="text-align:center;width:40px;">No</th>                        
                        <th style="text-align:center;">Faktur</th>
                        <th style="text-align:center;">Customer</th>
                        <th style="width:140px;text-align:center;">Total Belanja</th>
                        <th style="width:140px;text-align:center;">Setoran</th>
                        <th style="width:140px;text-align:center;">Status Bayar</th>                        
                        <th style="width:140px;text-align:center;">Sales</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no=0;
                        foreach ($data->result_array() as $a):
                            $no++;                        
                            $nofak=$a['jual_nofak'];
                            $customer_name=$a['customer_name'];
                            $jual_belanja=$a['jual_belanja'];
                            $setoran=$a['setoran'];                        
                            $status_bayar=$a['status_bayar'];                            
                            $sales=$a['karyawan_nama'];
                    ?>                
                    <tr>
                        <td style="text-align:center;"><?php echo $no;?></td>
                        <td><?php echo $nofak;?></td>
                        <td><?php echo $customer_name;?></td>
                        <td class='money'><?php echo number_format($jual_belanja);?></td>
                        <td class='money'><?php echo number_format($setoran);?></td>
                        <td><?php echo $status_bayar;?></td>
                        <td><?php echo $sales;?></td>
                    </tr>
                <?php endforeach;?>
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
        $(document).ready(function() {
            $('#setoran_sales').val(); 
            // $('#mydata').dataTable();
            // $(document.body).on("change","#sel_sales",function(){                
            //     sales_id = $(this).val();                
            //     $.ajax({
            //         type: "POST",
            //         async:"false",
            //         dataType:"json",
            //         data: {sales_id:sales_id},
            //         url : "<?php echo base_url()?>admin/Sales_audit/faktur_bysales",
            //         success:function(data){  
            //             // var data = $.parseJSON(data);                      
            //             var html = '';
            //             var i;
            //             var no = 0;
            //             for(i=0; i<data.length; i++){
            //                 no++;
            //                 html += '<tr>'+
            //                         '<td>'+no+'</td>'+    
            //                         '<td>'+data[i].jual_nofak+'</td>'+
            //                         '<td>'+data[i].customer_name+'</td>'+
            //                         '<td>'+data[i].jual_belanja+'</td>'+
            //                         '<td>'+data[i].setoran+'</td>'+
            //                         '<td>'+data[i].status_bayar+'</td>'+
            //                         '<td>'+data[i].karyawan_nama+'</td>'+
            //                         '</tr>';
            //             }                        
            //             // location.reload();
            //             $('#show_data').html(html);                      
            //         }
            //     });
            // });

            $(document.body).on("change","#sel_sales",function(){
                sales_id = $(this).val();
                // alert(sales_id);
                $.ajax({
                    type: "POST",                    
                    dataType:"json",
                    async:"false",
                    data: {sales_id:sales_id},
                    url : "<?php echo base_url()?>admin/Sales_audit/session_salesid",
                    success:function(data){
                        // alert("a");
                        location.reload();
                        // $("#sum_belanja").val("<?php echo $this->session->userdata('sum_belanja');?>");
                        // $("#sum_setoran").val("<?php echo $this->session->userdata('sum_setoran');?>");
                    }
                })
            })

            var table = $('#mydata').DataTable({
                            initComplete: function () {
                                $('#mydata').on('draw.dt', function() {
                                    $('select').select2();
                                });
                            },
                        });
            $('.money').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });                        
        });
    </script>
    
    
</body>

</html>

