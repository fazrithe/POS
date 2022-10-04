<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Faktur Penjualan Barang</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css') ?>" />
</head>

<body onload="window.print()">
    <div id="laporan">
        <table align="center" style="width:700px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

        </table>

        <table border="0" align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>

            </tr>

        </table>
        <?php
        $b = $data->row_array();
        $a = $sum_qty->row_array();
        $c = $cust_info->row_array();
        $cust = "";
        $alamat = "";
        $jual_garansi = 0;
        if ($b['jual_garansi'] != ""){
            $jual_garansi = $b['jual_garansi'];
        }
        if (count($c) != 0){
            $cust = $c['customer_name'];
            $alamat = $c['customer_alamat'];
        }else{
            $alamat = $b['jual_alamat'];
            if ($b["jual_customer"] == "ssNONAMEee") {
                $cust = "";                
            }else{
                $cust = $b["jual_customer"];                
            }            
        }

        // print_r($a);print_r($b);die();
        ?>
        <table border="0" align="center" style="width:700px;border:none;">
            <tr>
                <th style="text-align:left; font-size: 20px;">CV. DUA SEKAWAN ACCU</th>
            </tr>
            <tr>
                <th style="text-align:left;">Jl. Raya Jakarta KM. 04 Terminal Pakupatan Serang-Banten</th>
            </tr>
            <tr>
                <th style="text-align:left;">Telp. 0254-284405, 0813 8178 9004, 0819 1110 5282</th>
            </tr>
        </table>
        <table border="0" align="center" style="font-size: 15px; border-width: 2px; width:700px; border-top: 8px; border-left: 8px; border-right: 8px;">
            <tr>
                <th style="text-align:right;">GARANSI <?php echo $jual_garansi;?> BULAN</th>
            </tr>
        </table>
        <table border="0" align="center" style="margin-bottom: 20px;font-size: 15px; border-width: 2px; width:700px; border-top: 8px; border-left: 8px; border-right: 8px;">
            <tr>
                <th style="text-align:left;">FAKTUR</th>
            </tr>
        </table>
        <table border="0" align="center" style="width:700px;border:none; margin-bottom: 20px;">
            <tr>
                <th style="text-align:left;">No Faktur</th>
                <th style="text-align:left;">: <?php echo $b['jual_nofak']; ?></th>
                <th style="text-align:left;">Nama Customer</th>
                <th style="text-align:left;"> : <?php echo "$cust"; ?></th>
            </tr>
            <tr>
                <th style="text-align:left;">Tanggal</th>
                <th style="text-align:left;">: <?php echo $b['jual_tanggal']; ?></th>
                <th style="text-align:left;">Alamat</th>
                <th style="text-align:left;">: <?php echo $alamat; ?></th>
            </tr>            
        </table>

        <table border="1" align="center" style= "border-bottom: none; width:700px;">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Harga Jual</th>
                    <th>Qty</th>
                    <th>Diskon</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data->result_array() as $i) {
                    $no++;

                    $nabar = $i['d_jual_barang_nama'];
                    $satuan = $i['d_jual_barang_satuan'];

                    $harjul = $i['d_jual_barang_harjul'];
                    $qty = $i['d_jual_qty'];
                    $diskon = $i['d_jual_disc_val'];
                    $total = $i['d_jual_total'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no; ?></td>
                        <td style="text-align:left;"><?php echo $nabar; ?></td>
                        <td style="text-align:center;"><?php echo $satuan; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                        <td style="text-align:center;"><?php echo $qty; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($diskon); ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($total); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <!-- <tfoot>
                <tr>
                    <td colspan="6" style="text-align:center;"><b>Total</b></td>
                    <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($b['jual_total']); ?></b></td>
                </tr>
            </tfoot> -->
        </table>
        <table border="0" align="center" style=" margin-bottom: 20px; width:700px; border:none;">
            <tr>
                <td align="left" style="padding-left: 500px;"><b>Total (<?php echo $a['sumQty'] ?>)</b></td>
                <td style="text-align:right;"> <b><?php echo 'Rp ' . number_format($b['jual_total']); ?></b></td>
            </tr>
            <tr>
                <td style="text-align:left;padding-left: 500px;"><b>Cashback</b></td>
                <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($b['jual_cashback']); ?></b></td>
            </tr>
            <tr>
                <td style="text-align:left;padding-left: 500px;"><b>Potong Aki Bekas</b></td>
                <td style="text-align:right;"><b> <?php echo 'Rp ' . number_format($b['jual_aki_bekas']); ?></b></td>
            </tr>
            <tr>
                <td style="text-align:left;padding-left: 500px;"><b>Total Belanja</b></td>
                <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($b['jual_belanja']); ?></b></td>
            </tr>
            <tr>
                <td style="text-align:left;padding-left: 500px;"><b>Bayar <?php echo $this->session->userdata('tipe_pembayaran'); ?></b></td>
                <td style="text-align:right;"><b> <?php echo 'Rp ' . number_format($b['jual_jml_uang']); ?></b></td>
            </tr>
            <tr>
                <td style="text-align:left;padding-left: 500px;"><b>Kembalian</b></td>
                <td style="text-align:right;"><b> <?php echo 'Rp ' . number_format($b['jual_kembalian']); ?></b></td>
            </tr>
        </table>
        <table align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <td align="center">Customer</td>
                <td align="right">Serang, <?php echo date('d-M-Y') ?></td>
            </tr>
            <tr>
                <td align="right"></td>
            </tr>

            <tr>
                <td><br /><br /><br /><br /></td>
            </tr>
            <tr>
                <td align="center">(<?php echo $cust;?>)</td>
                <td align="right">( <?php echo $this->session->userdata('nama'); ?> )</td>
            </tr>
            <tr>
                <td align="center"></td>
            </tr>
        </table>
        <table align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <th><br /><br /></th>
            </tr>
            <tr>
                <th align="left"></th>
            </tr>
        </table>
    </div>
</body>

</html>