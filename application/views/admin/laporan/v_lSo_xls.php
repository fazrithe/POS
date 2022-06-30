<?php 

$title = "laporan_so".date('d-m-Y');;

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>


<b><h4>Laporan Stock Opname <?php echo date('M-Y');?></h4></b>
<table width="100%">
    <thead>
        <tr style='font-weight:bold;'>
            <th>No.</th>

            <th>Kode Barang</th>

            <th>Nama Barang</th>

            <th>Satuan</th>
            
            <th>Stok</th>

            <th>Real Stok</th>

            <th>Stok Selisih</th>

            <th>Adjustment Stok</th>

            <th>Final Stok</th>

            <th>Tanggal SO</th>

            <th>Admin</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($data->result_array() as $list) { ?>                      
        <tr>
            <td align='center'><?php echo $i;?></td>

            <td><?php echo $list['barang_id'];?></td>

            <td><?php echo $list['barang_nama'];?></td>

            <td><?php echo $list['barang_satuan'];?></td>

            <td><?php echo $list['barang_stok'];?></td>

            <td><?php echo $list['real_stok'];?></td>

            <td><?php echo $list['different_stok'];?></td>

            <td><?php echo $list['adjustment_stok'];?></td>

            <td><?php echo $list['final_stok'];?></td>

            <td><?php echo $list['insert_datetime'];?></td>

            <td><?php echo $list['insert_user'];?></td>
        </tr>

        <?php $i++; } ?>
    </tbody>
</table>

<?php redirect('admin/Laporan','refresh'); ?>