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
                <h1 class="page-header">Setoran
                    <small>Hutang</small>                    
                </h1>
            </div> 
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
            <table class="display" style="font-size:11px;" id="mydata">
                <thead>
                    <tr>
                        <th style="text-align:center;width:40px;">No</th>                        
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;">Faktur</th>
                        <th style="width:140px;text-align:center;">Customer</th>
                        <th style="width:140px;text-align:center;">Alamat</th>
                        <th style="width:140px;text-align:center;">Total Belanja</th>
                        <th style="width:140px;text-align:center;">Sisa Hutang</th>
                        <th style="width:140px;text-align:center;">Tanggal</th>                        
                        <th style="width:140px;text-align:center;">Setoran</th>
                        <th style="width:140px;text-align:center;">Status</th>
                        <th style="width:140px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;                        
                        $dt_nofak=$a['jual_nofak'];
                        $dt_cust=$a['customer_name'];
                        $dt_alamat=$a['customer_alamat'];                        
                        $dt_belanja=$a['jual_belanja'];                                            
                        $dt_tgl=$a['jual_tanggal'];
                        $dt_setoran=$a['total_setoran'];
                        $dt_status=$a['jual_status_bayar'];   
                        $dt_str_status = "Lunas"; 
                        $dt_cust_id = $a['customer_id'];
                        $dt_sisa_hutang = $a['total_hutang'];                        
                        
                        if($dt_status == 0 && $dt_setoran == ""){
                            $dt_sisa_hutang = $dt_belanja;
                        }
                        if ($dt_status == 0){
                            $dt_str_status = "Belum Lunas";
                        };
                        if ($dt_setoran == ""){
                            $dt_setoran = 0;
                        }
                        $dt_hutang = $dt_belanja - $dt_setoran;
                ?>
                    <tr data-custid="<?php echo $dt_cust_id;?>" data-customer="<?php echo $dt_cust;?>" data-nofak="<?php echo $dt_nofak;?>" data-setoran="<?php echo $dt_setoran;?>" data-hutang="<?php echo $dt_hutang;?>" data-belanja="<?php echo $dt_belanja;?>">
                        <td style="text-align:center;"><?php echo $no;?></td>
                        <td class = "details-control"></td>
                        <td><?php echo $dt_nofak;?></td>
                        <td><?php echo $dt_cust;?></td>
                        <td><?php echo $dt_alamat;?></td>
                        <td class='money'><?php echo number_format($dt_belanja);?></td>
                        <td class='money'><?php echo number_format($dt_sisa_hutang);?></td>
                        <td><?php echo $dt_tgl;?></td>
                        <td class='money'><?php echo number_format($dt_setoran);?></td>
                        <td><?php echo $dt_str_status;?></td>
                        <td style="text-align:center;">
                            <?php if ($dt_status == 0){?>
                                <a data-id="<?php echo $dt_nofak;?>" data-target = "#orderModal" class="btn btn-xs  btn-success" data-toggle="modal" data-target="#orderModal" title="Belum lunas"><span class="fa fa-money-bill"></span> Bayar</a>
                            <?php }else{?>
                                <a disabled="true" data-id="<?php echo $dt_nofak;?>" data-target = "#orderModal1" class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#orderModal" title="Sudah lunas"><span class="fa fa-dollar-sign"></span> Lunas</a>
                            <?php }?>                        
                        </td>
                    </tr>
                    
                <?php endforeach;?>
                </tbody>
            </table>
            </div>
        </div>
        <!-- /.row -->

        <!-- ============ MODAL EDIT =============== -->
   
    <div id="orderModal" class="modal fade" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true" tabindex="-1" aria-labelledby="largeModal">
        <div class="modal-dialog"> 
            <div class="modal-content">
                <div class="modal-header">    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3>Input Setoran</h3>
                </div>
                <div class="form-horizontal">
                    <div class="modal-body">

                        <input type="hidden" name="edtCustid" id="edtCustid" readonly>

                        <div class="form-group">                                                
                            <label class="control-label col-xs-3" >Faktur</label>
                            <div class="col-xs-9">
                                <input type="text" id="edtNofak" name="edtNofak" class="form-control" style="width:280px;" readonly>
                            </div>
                        </div>    
                    
                        <div class="form-group">                                                
                            <label class="control-label col-xs-3" >Customer</label>
                            <div class="col-xs-9">
                                <input type="text" id="edtCustomer" name="edtCustomer" class="form-control" style="width:280px" readonly>
                            </div>
                        </div>

                        <div class="form-group">                                                
                            <label class="control-label col-xs-3" >Total Belanja</label>
                            <div class="col-xs-9">                            
                                <input type="text" id="edtTotal" name="edtTotal" class="form-control input-sm" style="width:280px" readonly>
                            </div>
                        </div>

                        <div class="form-group">                        
                            <label class="control-label col-xs-3" >Sisa Hutang</label>
                            <div class="col-xs-9">
                                <input type="text" id="edtHutang" name="edtHutang" class="form-control input-sm" style="width:280px;" readonly>      
                            </div>
                        </div>

                        <div class="form-group">                        
                            <label class="control-label col-xs-3" >Bayar</label>                        
                            <div class="col-xs-9">
                                <input type="text" id="edtBayar" name="edtBayar" class="money form-control input-sm" style="width:280px;">      
                            </div>                        
                        </div>
                                            
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button id="orderSimpan" class="btn btn-info" data-dismiss="modal" aria-hidden="true" >Simpan</button>
                </div>
            </div>
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


        function format ( d ) {
            // `d` is the original data object for the row            
            var nofak = $(event.target).closest('tr').data('nofak');
            var return_first = function(){
                var tmp = null;                                          
                $.ajax({
                    async: false,
                    type: "POST",
                    global: false,
                    data: {nofak:nofak},
                    url : "<?php echo base_url()?>admin/Setoran_hutang/data_detail",
                    success:function(data){                          
                        var data = $.parseJSON(data); 
                        tmp = data.detail;
                    }
                });
                // console.log(tmp);
                return tmp;
            }();
            // console.log(return_first.length);return;
            // console.log(return_first);

            var display = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            display += '<tr>'+
                    '<th>Id Setoran</th>'+
                    '<th>Faktur</th>'+
                    '<th>Setoran</th>'+
                    '<th>Tanggal</th>'+
                    '<th>Sisa Hutang</th>'+
                    '<th>Keterangan</th>'+
                '</tr>';
            
            if (return_first.length > 0){                
                var dt_str_status = "";                
                for(val of return_first){            
                    display += '<tr>' + '<td>' + val[0] + '</td>' + '<td>' + val[1] + '</td>' + '<td>' + val[2] + '</td>' + '<td>' + val[3] + '</td>' + '<td>' + val[4] + '</td>' + '<td>' + val[5] + '</td>' + '</tr>';
                }
            }else{
                display += '<tr>'+'<td colspan = "6">No data to show</td>'+'</tr>';
            }            

            display += '</table>';
            return display;
        }

        $(function(){

            var table = $('#mydata').DataTable();

            $('#mydata tbody').on('click', 'td.details-control', function(){
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if(row.child.isShown()){
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });




            $('#orderModal').modal({        
                keyboard: true,
                backdrop: "static",
                show:false,
        
            }).on('show.bs.modal', function(){                
                var nofak = $(event.target).closest('tr').data('nofak');
                var hutang = $(event.target).closest('tr').data('hutang');
                var customer = $(event.target).closest('tr').data('customer');
                var belanja = $(event.target).closest('tr').data('belanja');
                var custid = $(event.target).closest('tr').data('custid');
                
                $('#edtCustid').val(custid);
                $('#edtNofak').val(nofak);
                $('#edtCustomer').val(customer);
                $('#edtHutang').val(hutang).priceFormat({
                                    prefix: '',
                                    //centsSeparator: '',
                                    centsLimit: 0,
                                    thousandsSeparator: ','
                                });
                $('#edtTotal').val(belanja).priceFormat({
                                    prefix: '',
                                    //centsSeparator: '',
                                    centsLimit: 0,
                                    thousandsSeparator: ','
                                });
                
                $('#edtBayar').val("");                
            });
        });
            
        $("#orderSimpan").click(function(){
            nofak    = $('#edtNofak').val();
            custid   = $('#edtCustid').val();
            customer = $('#edtCustomer').val();
            hutang   = parseInt($('#edtHutang').val().replace(/[^\d]/g,""));
            total    = parseInt($('#edtTotal').val().replace(/[^\d]/g,""));
            setoran  = parseInt($('#edtBayar').val().replace(/[^\d]/g,""));
            
            if (setoran > hutang){
            
                Swal.fire({
                    type:'warning',
                    title: 'Warning!',
                    text: 'Setoran tidak dapat melebihi jumlah hutang',                                
                });
            }else{
                $.ajax({
                    type: "POST",
                    data: {nofak:nofak,
                           custid:custid,
                           customer:customer,
                           hutang:hutang,
                           total:total,
                           setoran:setoran
                    },
                    url : "<?php echo base_url()?>admin/Setoran_hutang/setor_uang",
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
            }                  
        })

        function reset(){
            $("#edtBayar").val("");
            $("#add_customer").val("");
            $("#add_limit").val("");
            $("#add_hutang").val("");
            $("#add_alamat").val("");
            $("#add_telepon").val("");
        }

        $("#edtBayar").keypress(function(e) {
            if (e.which == 13) {
                $("#orderSimpan").focus();
            }
        });

        $(document).ready(function() {
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

