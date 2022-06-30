
<link href="<?php echo base_url().'assets/css/td_alignment.css'?>" rel="stylesheet">

<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>laporan data stok barang</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css')?>"/>
</head>
<body onload="window.print()">
<div id="laporan">
<table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">
<!--<tr>
    <td><img src="<?php// echo base_url().'assets/img/kop_surat.png'?>"/></td>
</tr>-->
</table>
<?php 
    $b=$data->row_array();
?>

<table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
<tr>
    <td colspan="2" style="width:800px;padding-left:20px;"><center><h4>LAPORAN PENJUALAN TAHUN <?php echo $b['tahun'];?></h4></center><br/></td>
</tr>
                       
</table>
 
<table border="0" align="center" style="width:900px;border:none;">
        <tr>
            <th style="text-align:left"></th>
        </tr>
</table>

<table border="1" align="center" style="width:900px;margin-bottom:20px;">
<?php 
    $urut=0;
    $nomor=0;
    $group='-';
    
    $b=$jml->row_array();
    foreach($data->result_array()as $d){
    $nomor++;
    $urut++;    

    if($group=='-' || $group!=$d['bulan']){
        $bulan=$d['bulan'];
        
        // $query=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_tanggal desc");
        $query=$this->db->query("SELECT sum(jual_total)as jual_total, sum(jual_belanja)as grand_total,sum(jual_cashback) as total_cashback  FROM tbl_jual WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan'");
        $t=$query->row_array();
        // print_r($t);
        $tots=$t['jual_total'];
        $cb = $t['total_cashback'];
        $gt=$t['grand_total'];        
        if($group!='-')
        echo "</table><br>";
        echo "<table align='center' width='900px;' border='1'>";
        echo "<tr><td colspan='8' rowspan='3'><b>Bulan: $bulan</b></td> <td style='text-align:right;'><b>Total:</b></td><td style='text-align:right;'><b>".number_format($tots)."</b></td></tr>";
        echo "<tr><td style='text-align:right;'><b>Cashback:</b></td><td style='text-align:right;'><b>".number_format($cb)."</b></td></tr>";
        echo "<tr><td style='text-align:right;'><b>Grand Total:</b></td><td style='text-align:right;'><b>".number_format($gt)."</b></td></tr>";
echo "<tr style='background-color:#ccc;'>
    <td width='3%' align='center'>No</td>
    <td width='8%' align='center'>No Faktur</td>
    <td width='10%' align='center'>Tanggal</td>
    <td width='10%' align='center'>Kode Barang</td>
    <td width='25%' align='center'>Nama Barang</td>
    <td width='7%' align='center'>Satuan</td>
    <td width='7%' align='center'>Harga Jual</td>
    <td width='5%' align='center'>Qty</td>
    <td width='12%' align='center'>Diskon</td>
    <td width='10%' align='center'>Subtotal</td>
    
    </tr>";
$nomor=1;
    }
    $group=$d['bulan'];
        if($urut==500){
        $nomor=0;
            echo "<div class='pagebreak'> </div>";            
            //echo "<center><h2>KALENDER EVENTS PER TAHUN</h2></center>";
            }
        ?>
        
        <tr>
                <td style="text-align:center;vertical-align:top;text-align:center;"><?php echo $nomor; ?></td>
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['jual_nofak']; ?></td>
                <td style="vertical-align:top;text-align:center;"><?php echo $d['jual_tanggal']; ?></td>
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['d_jual_barang_id']; ?></td>
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['d_jual_barang_nama']; ?></td> 
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['d_jual_barang_satuan']; ?></td>
                <td style="vertical-align:top;padding-left:5px;text-align:right;"><?php echo number_format($d['d_jual_barang_harjul']); ?></td>
                <td style="vertical-align:top;padding-left:5px;text-align:center;"><?php echo $d['d_jual_qty']; ?></td>
                <td style="vertical-align:top;padding-left:5px;text-align:right;"><?php echo number_format($d['d_jual_diskon']); ?></td>
                <td style="vertical-align:top;padding-left:5px;text-align:right;"><?php echo number_format($d['d_jual_total']); ?></td> 
        </tr>
        

        <?php
        }
        ?>
</table>
</table>
<table align="center" style="width:900px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td colspan ='2'style='text-align:right;'><b>Total Jual:</b></td>        
        <td style='text-align:right;'><b><?php echo number_format($b['grand_total']);?></b></td>
    </tr>
    <tr>
        <td colspan ='2'style='text-align:right;'><b>Total Cashback:</b></td>
        <td style='text-align:right;'><b><?php echo number_format($b['total_cashback']);?></b></td>
    </tr>
    <tr>
        <td colspan = '2'style='text-align:right;'><b>Grand Total:</b></td>
        <td style='text-align:right;'><b><?php echo number_format($b['grand_total']);?></b></td>
    </tr>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td align="right">Serang, <?php echo date('d-M-Y')?></td>
    </tr>
    <tr>
        <td align="right"></td>
    </tr>
   
    <tr>
    <td><br/><br/><br/><br/></td>
    </tr>    
    <tr>
        <td align="right">( <?php echo $this->session->userdata('nama');?> )</td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <th><br/><br/></th>
    </tr>
    <tr>
        <th align="left"></th>
    </tr>
</table>
</div>
</body>
</html>