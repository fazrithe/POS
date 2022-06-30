<?php 

$title = "laporan_sales".date('d-m-Y');;

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>


<b><h4>Laporan Sales <?php echo date('M-Y');?></h4></b>
<table width="100%">
    <thead>
        <tr style='font-weight:bold;'>
            <th>No.</th>

            <th>ID Sales</th>

            <th>Nama</th>

            <th>Area</th>

            <th>Konsumen</th>                        
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($data->result_array() as $list) { ?>            
        <tr>
            <td align='center'><?php echo $i;?></td>

            <td><?php echo $list['karyawan_id'];?></td>

            <td><?php echo $list['karyawan_nama'];?></td>

            <td><?php echo $list['sales_area'];?></td>

            <td><?php echo $list['sales_buyer'];?></td>

        </tr>

        <?php $i++; } ?>
    </tbody>
</table>

<?php redirect('admin/Laporan','refresh'); ?>