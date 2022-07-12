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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap-datetimepicker.min.css'?>">
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
                <h1 class="page-header">Data
                    <small>Laporan</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:12px;" id="mydata">
                <thead>
                    <tr>
                        <th style="text-align:center;width:40px;">No</th>
                        <th>Laporan</th>
                        <th style="width:120px;text-align:center;">Download</th>
                        <th style="width:20px;text-align:center;">Email</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">1</td>
                        <td style="vertical-align:middle;">Laporan Pembelian</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_pembelian_xls'?>" target="_blank"><span style="color:green" class="fa fa-file-excel-o"></span> Excel</a>
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_pembelian_pdf'?>" target="_blank"><span style="color:red" class="fa fa-file-pdf-o"></span> Pdf</a>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">2</td>
                        <td style="vertical-align:middle;">Laporan Pembelian Range Date</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_beli_xls_cust" data-toggle="modal"><span style="color:green" class="fa fa-file-excel-o"></span> Excel</a>
                            <a class="btn btn-sm btn-default" href="#lap_beli_pdf_cust" data-toggle="modal"><span style="color:red" class="fa fa-file-pdf-o"></span> Pdf</a>                            
                        </td>
                        <td></td>
                    </tr>
                
                    <tr>
                        <td style="text-align:center;vertical-align:middle">3</td>
                        <td style="vertical-align:middle;">Laporan Data Barang</td>
                        <td style="text-align:center;">                            
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_data_barang_xls'?>" target="_blank"><span style="color:green"class="fa fa-file-excel-o"></span> Excel</a>
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_data_barang'?>" target="_blank"><span style="color:red"class="fa fa-file-pdf-o"></span> Pdf</a>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">4</td>
                        <td style="vertical-align:middle;">Laporan Penjualan</td>
                        <td style="text-align:center;">
                            <!-- <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_jual_xls'?>" target="_blank"><span style="color:green" class="fa fa-file-excel-o"></span> Excel</a>
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_jual_pdf'?>" target="_blank"><span style="color:red" class="fa fa-file-pdf-o"></span> Pdf</a> -->
                            <a class="btn btn-sm btn-default" href="#" data-toggle="modal" data-target="#exReportPenjualan"><span style="color:green" class="fa fa-file-excel-o"></span> Excel</a>
                            <a class="btn btn-sm btn-default" href="#" data-toggle="modal" data-target="#pdfReportPenjualan"><span style="color:red" class="fa fa-file-pdf-o"></span> Pdf</a>
                        </td>
                        <td> <a class="btn btn-sm btn-default" href="#" data-toggle="modal" data-target="#emailReportPenjualan"><span style="color:red" class="fa fa-envelope"></span> Email</a></td>
                    </tr>
<!-- 
                    <tr>
                        <td style="text-align:center;vertical-align:middle">5</td>
                        <td style="vertical-align:middle;">Laporan Penjualan Range Date</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_jual_xls_cust" data-toggle="modal"><span style="color:green" class="fa fa-file-excel-o"></span> Excel</a>
                            <a class="btn btn-sm btn-default" href="#lap_jual_pdf_cust" data-toggle="modal"><span style="color:red" class="fa fa-file-pdf-o"></span> Pdf</a>                            
                        </td>
                        <td></td>
                    </tr> -->

                    <tr>
                        <td style="text-align:center;vertical-align:middle">6</td>
                        <td style="vertical-align:middle;">Laporan Return</td>
                        <td style="text-align:center;">
                        <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_return_xls'?>" target="_blank"><span style="color:green" class="fa fa-file-excel-o"></span> Excel</a>
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_return_pdf'?>" target="_blank"><span style="color:red" class="fa fa-file-pdf-o"></span> Pdf</a>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">7</td>
                        <td style="vertical-align:middle;">Laporan Data Sales</td>
                        <td style="text-align:center;">
                        <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_dtSales_xls'?>" target="_blank"><span style="color:green" class="fa fa-file-excel-o"></span> Excel</a>
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_dtSales_pdf'?>" target="_blank"><span style="color:red" class="fa fa-file-pdf-o"></span> Pdf</a>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">8</td>
                        <td style="vertical-align:middle;">Laporan Data Karyawan</td>
                        <td style="text-align:center;">
                        <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_dtKaryawan_xls'?>" target="_blank"><span style="color:green" class="fa fa-file-excel-o"></span> Excel</a>
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_dtKaryawan_pdf'?>" target="_blank"><span style="color:red" class="fa fa-file-pdf-o"></span> Pdf</a>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">9</td>
                        <td style="vertical-align:middle;">Laporan Data User</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_dtUser_xls'?>" target="_blank"><span style="color:green" class="fa fa-file-excel-o"></span> Excel</a>
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_dtUser_pdf'?>" target="_blank"><span style="color:red" class="fa fa-file-pdf-o"></span> Pdf</a>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">10</td>
                        <td style="vertical-align:middle;">Laporan Stock Opname</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_history_so_xls" data-toggle="modal"><span style="color:green" class="fa fa-file-excel-o"></span> Excel</a>
                            <a class="btn btn-sm btn-default" href="#lap_history_so_pdf" data-toggle="modal"><span style="color:red" class="fa fa-file-pdf-o"></span> Pdf</a>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">11</td>
                        <td style="vertical-align:middle;">Laporan Top Item</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_rankItem_xls'?>" target="_blank"><span style="color:green" class="fa fa-file-excel-o"></span> Excel</a>
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/Laporan/lap_rankItem_pdf'?>" target="_blank"><span style="color:red" class="fa fa-file-pdf-o"></span> Pdf</a>
                        </td>
                        <td></td>
                    </tr>

                    <!-- <tr>
                        <td style="text-align:center;vertical-align:middle">40</td>
                        <td style="vertical-align:middle;">Laporan Stok Barang</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/laporan/lap_stok_barang'?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">100</td>
                        <td style="vertical-align:middle;">Laporan Penjualan PerTanggal</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_jual_pertanggal" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">12</td>
                        <td style="vertical-align:middle;">Laporan Penjualan PerBulan</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_jual_perbulan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr> -->

                    <!-- <tr>
                        <td style="text-align:center;vertical-align:middle">11</td>
                        <td style="vertical-align:middle;">Laporan Penjualan PerTahun</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_jual_pertahun" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>

                     <tr>
                        <td style="text-align:center;vertical-align:middle">11</td>
                        <td style="vertical-align:middle;">Laporan Laba/Rugi</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_laba_rugi" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr> -->
              
                </tbody>
            </table>
            </div>
        </div>
        <!-- /.row -->
        

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_pdf_cust" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/Laporan/lap_jual_pdf_cust'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >From</label>
                        <div class="col-xs-9">
                            <div class='input-group date' id='datepicker5' style="width:300px;">
                                <input type='text' name="dtJp1" class="form-control" value="" placeholder="Tanggal..." required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >To</label>
                        <div class="col-xs-9">
                            <div class='input-group date' id='datepicker6' style="width:300px;">
                                <input type='text' name="dtJp2" class="form-control" value="" placeholder="Tanggal..." required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_xls_cust" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/Laporan/lap_jual_xls_cust'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >From</label>
                        <div class="col-xs-9">
                            <div class='input-group date' id='datepicker3' style="width:300px;">
                                <input type='text' name="dtJx1" class="form-control" value="" placeholder="Tanggal..." required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >To</label>
                        <div class="col-xs-9">
                            <div class='input-group date' id='datepicker4' style="width:300px;">
                                <input type='text' name="dtJx2" class="form-control" value="" placeholder="Tanggal..." required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_beli_pdf_cust" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/Laporan/lap_beli_pdf_cust'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >From</label>
                        <div class="col-xs-9">
                            <div class='input-group date' id='datepicker1' style="width:300px;">
                                <input type='text' name="dateFrom" class="form-control" value="" placeholder="Tanggal..." required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >To</label>
                        <div class="col-xs-9">
                            <div class='input-group date' id='datepicker2' style="width:300px;">
                                <input type='text' name="dateTo" class="form-control" value="" placeholder="Tanggal..." required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_beli_xls_cust" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/Laporan/lap_beli_xls_cust'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >From</label>
                        <div class="col-xs-9">
                            <div class='input-group date' id='datepicker3' style="width:300px;">
                                <input type='text' name="dateFrom" class="form-control" value="" placeholder="Tanggal..." required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >To</label>
                        <div class="col-xs-9">
                            <div class='input-group date' id='datepicker4' style="width:300px;">
                                <input type='text' name="dateTo" class="form-control" value="" placeholder="Tanggal..." required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_pertanggal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/Laporan/lap_penjualan_pertanggal'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal</label>
                        <div class="col-xs-9">
                            <div class='input-group date' id='datepicker' style="width:300px;">
                                <input type='text' name="tgl" class="form-control" value="" placeholder="Tanggal..." required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_history_so_xls" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/Laporan/lap_so_perbulan_xls'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                <?php foreach ($so_bln->result_array() as $k) {
                                    $bln=$k['bulan'];
                                ?>
                                    <option><?php echo $bln;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_history_so_pdf" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/Laporan/lap_so_perbulan_pdf'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                <?php foreach ($so_bln->result_array() as $k) {
                                    $bln=$k['bulan'];
                                ?>
                                    <option><?php echo $bln;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_perbulan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/Laporan/lap_penjualan_perbulan'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                <?php foreach ($jual_bln->result_array() as $k) {
                                    $bln=$k['bulan'];
                                ?>
                                    <option><?php echo $bln;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_pertahun" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Tahun</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/Laporan/lap_penjualan_pertahun'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tahun</label>
                        <div class="col-xs-9">
                                <select name="thn" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Tahun" data-width="80%" required/>
                                <?php foreach ($jual_thn->result_array() as $t) {
                                    $thn=$t['tahun'];
                                ?>
                                    <option><?php echo $thn;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>


         <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_laba_rugi" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_laba_rugi'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                <?php foreach ($jual_bln->result_array() as $k) {
                                    $bln=$k['bulan'];
                                ?>
                                    <option><?php echo $bln;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        

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

    <!-- Modal -->
<div class="modal fade" id="exReportPenjualan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export Laporan Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="post" action="<?php echo base_url().'admin/laporan/lap_jual_xls'?>" target="_blank">
      <div class="modal-body">
        <div class="form-group">
            <label>Mulai Tanggal</label>
            <input type="date" name="start_date" class="form-control">
        </div>
        <div class="form-group">
            <label>Saimpai Tanggal</label>
            <input type="date" name="end_date" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-success">Export</button>
      </div>
    </form>
    </div>
  </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="pdfReportPenjualan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export Laporan Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="post" action="<?php echo base_url().'admin/laporan/lap_jual_pdf'?>" target="_blank">
      <div class="modal-body">
        <div class="form-group">
            <label>Mulai Tanggal</label>
            <input type="date" name="start_date" class="form-control">
        </div>
        <div class="form-group">
            <label>Saimpai Tanggal</label>
            <input type="date" name="end_date" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-danger">Export</button>
      </div>
    </form>
    </div>
  </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="emailReportPenjualan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kirim Email Laporan Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url().'admin/laporan/lap_jual_email'?>" enctype="multipart/form-data" target="_blank">
      <div class="modal-body">
      <div class="form-group">
            <label>Email to</label>
            <input type="text" name="email_to" class="form-control">
        </div>
        <div class="form-group">
            <label>Mulai Tanggal</label>
            <input type="date" name="start_date" class="form-control">
        </div>
        <div class="form-group">
            <label>Saimpai Tanggal</label>
            <input type="date" name="end_date" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-danger">Send</button>
      </div>
    </form>
    </div>
  </div>
</div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url().'assets/js/jquery.js'?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url().'assets/dist/js/bootstrap-select.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/dataTables.bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/moment.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap-datetimepicker.min.js'?>"></script>
    <script type="text/javascript">
            $(function () {
                $('#datetimepicker').datetimepicker({
                    format: 'DD MMMM YYYY HH:mm',
                });
                
                $('#datepicker').datetimepicker({
                    format: 'YYYY-MM-DD',
                });

                $('#datepicker1').datetimepicker({
                    format: 'YYYY-MM-DD',
                });

                $('#datepicker2').datetimepicker({
                    format: 'YYYY-MM-DD',
                });

                $('#datepicker3').datetimepicker({
                    format: 'YYYY-MM-DD',
                });

                $('#datepicker4').datetimepicker({
                    format: 'YYYY-MM-DD',
                });

                $('#datepicker5').datetimepicker({
                    format: 'YYYY-MM-DD',
                });

                $('#datepicker6').datetimepicker({
                    format: 'YYYY-MM-DD',
                });

                $('#timepicker').datetimepicker({
                    format: 'HH:mm'
                });
            });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable();
        });
        
    </script>
    
</body>

</html>
