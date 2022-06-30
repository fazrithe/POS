<?php 

$title = "laporan_pembelian".date('d-m-Y');;

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>


<b><h4>Laporan Pembelian <?php echo date('M-Y');?></h4></b>
<table width="100%">
    <thead>
        <tr style='font-weight:bold;'>
            <th>No.</th>

            <th>Faktur</th>

            <th>Tanggal</th>

            <th>Kode Barang</th>

            <th>Nama Barang</th>

            <th>Satuan</th>

            <th>Harga Pokok (Rp)</th>

            <th>Qty</th>

            <th>Total Bayar (Rp)</th>
                        
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($data->result_array() as $list) { ?>

        <tr>
            <td align='center'><?php echo $i;?></td>

            <td><?php echo $list['beli_nofak'];?></td>

            <td><?php echo $list['beli_tanggal'];?></td>

            <td><?php echo $list['d_beli_barang_id'];?></td>

            <td><?php echo $list['barang_nama'];?></td>

            <td><?php echo $list['barang_satuan'];?></td>

            <td><?php echo $list['d_beli_harga'];?></td>

            <td><?php echo $list['d_beli_jumlah'];?></td>
            
            <td><?php echo $list['d_beli_total'];?></td>

        </tr>

        <?php $i++; } ?>
        <?php 
            $b=$jml->row_array();
        ?>
        <tr>
            <td colspan="8" align='center'><b>Total (Rp)</b></td>
            <td align='right'><b><?php echo $b['beli_total'];?></b></td>
        </tr>
    </tbody>
</table>

<?php redirect('admin/Laporan','refresh'); ?>