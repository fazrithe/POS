<?php 

$title = "laporan_return".date('d-m-Y');;

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>


<b><h4>Laporan Return <?php echo date('M-Y');?></h4></b>
<table width="100%">
    <thead>
        <tr style='font-weight:bold;'>
            <th>No.</th>

            <th>Faktur</th>

            <th>Tanggal</th>

            <th>Kode Barang</th>

            <th>Nama Barang</th>            

            <th>Harga Jual (Rp)</th>

            <th>Qty</th>

            <th>Qty Retur Good</th>

            <th>Qty Retur Broken</th>

            <th>Keterangan</th>

            <th>Return By</th>
                        
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($data->result_array() as $list) { 
                $changeWith = "";
                switch ($list['change_with']) {
                    case '1':
                        $changeWith = 'Item';
                        break;
                    
                    default:
                        $changeWith = 'Cash';
                        break;
                }
            ?>            
        <tr>
            <td align='center'><?php echo $i;?></td>

            <td><?php echo $list['jual_nofak'];?></td>

            <td><?php echo $list['insert_datetime'];?></td>

            <td><?php echo $list['barang_id'];?></td>

            <td><?php echo $list['barang_nama'];?></td>

            <td><?php echo $list['harga_jual'];?></td>

            <td><?php echo $list['qty'];?></td>

            <td><?php echo $list['stok_retur_good'];?></td>
            
            <td><?php echo $list['stok_retur_broken'];?></td>

            <td><?php echo $list['reason'];?></td>

            <td><?php echo $changeWith;?></td>

        </tr>

        <?php $i++; } ?>
    </tbody>
</table>

<?php redirect('admin/Laporan','refresh'); ?>