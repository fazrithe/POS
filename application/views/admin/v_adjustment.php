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
                <h1 class="page-header">Modul
                    <small>Adjustment</small>                    
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <form id="myForm">
                    <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                        <thead>
                            <tr>
                                <th style="text-align:center;width:40px;">No</th>                        
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>                        
                                <th>Satuan</th>
                                <th>Stok Sistem</th>
                                <th>Stok Real</th>
                                <th>Stok Diff</th>
                                <th>Stok Adjustment</th>
                                <th>Stok Final</th>
                                <th>Tanggal Input</th>
                                <th>User Input</th>
                                <th>Input Adjustment</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no=0;
                            foreach ($data->result_array() as $a):
                                $no++;                    
                                $barang_id=$a['barang_id'];
                                $barang_nama=$a['barang_nama'];
                                $barang_satuan=$a['barang_satuan'];   
                                $barang_stok=$a['barang_stok'];                    
                                $real_stok=$a['real_stok'];
                                $different_stok=$a['different_stok'];                                              
                                $adjustment_stok=$a['adjustment_stok'];
                                $final_stok=$a['final_stok'];
                                $insert_datetime=$a['insert_datetime'];
                                $insert_user=$a['insert_user'];
                        ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $no;?></td>
                                <td id="barang_id" name="barang_id"><?php echo $barang_id;?></td>
                                <td id="barang_nama" name="barang_nama"><?php echo $barang_nama;?></td>
                                <td id="barang_satuan" name="barang_satuan"><?php echo $barang_satuan;?></td>                        
                                <td id="barang_stok" name="barang_stok"><?php echo $barang_stok;?></td>
                                <td id="real_stok" name="real_stok"><?php echo $real_stok;?></td>
                                <td id="different_stok" name="different_stok"><?php echo $different_stok;?></td>
                                <td id="adjustment_stok" name="adjustment_stok"><?php echo $adjustment_stok;?></td>
                                <td id="final_stok" name="final_stok"><?php echo $final_stok;?></td>
                                <td id="insert_datetime" name="insert_datetime"><?php echo $insert_datetime;?></td>
                                <td id="insert_user" name="insert_user"><?php echo $insert_user;?></td> 
                                <td id="input_adjustment" name="input_adjustment"><input type="text" id="tes" name="tes" data-barang_id="<?php echo $barang_id;?>"></td>                                                                                        
                            </tr>
                        <?php endforeach;?> 
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-info">Posting</button>
        </div>
        <!-- /.row -->
        
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
    <script src="<?php echo base_url().'assets/js/dataTables.fixedHeader.js'?>"></script>    
    <script type="text/javascript">

        $(document).ready(function() {   
             	
            // Swal.fire('Ini adalah sweetalert Basic');
            // $('td[name="input_adjustment"]').on('click', function() {
            //     var $this = $(this);
            //     var $input = $('<input>', {
            //         value: $this.text(),
            //         type: 'text',
            //         blur: function() {
            //             $this.text(this.value);
            //         },
            //         keyup: function(e) {
            //             if ((e.which === 13)) {
            //                 $input.blur();
            //             }
            //         }
            //     }).appendTo( $this.empty() ).focus();
            // });
            // var table = $('#mydata').DataTable({
            //     columnDefs: [{
            //         orderable: true,
            //         targets: [1,2,3,4,5,6,7,8,9,10,11]
            //     }]
            // }); 

            // var data = $.param($('td').map(function() {
            //     return {
            //         name: $(this).attr('name'),
            //         value: $(this).text().trim()
            //     };
            // }));    

            // alert(data);

            
            $('.bootstrap-select').selectpicker();
            // $('#mydata').DataTable();  
            var table = $('#mydata').DataTable({
                fixedHeader:{
                    header :true,
                    footer : false
                }
            })
//             var table = $('#mydata').DataTable({ //Hier wird die Tabelle zu einem DataTable gemacht (genaue Erklärungen auf DataTables.net).
//                     scrollX: true, //Scrollen in der x-Achse ist möglich
//                     paging: false, //Es ist möglich die Einträge der Tabelle auf mehrere Seiten zu packen, aber das ist hier unnötig.
//                     "scrollY": "80%", //Scrollen in der y-Achse ist ebenfalls möglich -> Statt paging.
                    
//                     fixedHeader : {
//                     header : true,
//                     footer : false,
//                     headerOffset: 0
// 	            },
//    });
            $('button').click( function() {                
                var table = $('#mydata').DataTable();
                var json = $('#mydata tbody tr').map(function () {                        
                    barang_id = $('td', this).eq(1).text(),
                    qty = parseInt($('td', this).eq(11).find('input').val(), 10) || 0;                
                    return {              
                        "barang_id": barang_id,
                        "qty": qty                        
                    }
                }).get();                                
                $.ajax({
                    type: "POST",
                    data: {json:json},
                    url: "<?php echo base_url()?>admin/Adjustment/proses_adjustment",
                    success:function(data){
                        var data = $.parseJSON(data);
                        if (data.status == 1){
                            Swal.fire({
                                type:'success',
                                title: 'Sukses!',
                                text: 'Proses adjustment berhasil! ',                                
                            }).then (function(){
                                location.reload();
                            })
                        }else{
                            Swal.fire({
                                type:'error',
                                title: 'Oops...',
                                text: 'Proses adjustment gagal!',
                                footer: '<a href="https://google.com">Why do I have this issue?</a>'
                            },function(){
                                location.reload();
                            })
                        }                        
                    }
                })
            });                
    });      

            
    </script>
    
    
</body>

</html>