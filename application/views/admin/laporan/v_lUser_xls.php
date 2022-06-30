<?php 

$title = "laporan_user".date('d-m-Y');;

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>


<b><h4>Laporan User <?php echo date('M-Y');?></h4></b>
<table width="100%">
    <thead>
        <tr style='font-weight:bold;'>
            <th>No.</th>

            <th>Username</th>

            <th>Nama</th>                  
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($data->result_array() as $list) { ?>                      
        <tr>
            <td align='center'><?php echo $i;?></td>

            <td><?php echo $list['user_username'];?></td>

            <td><?php echo $list['user_nama'];?></td>
        </tr>

        <?php $i++; } ?>
    </tbody>
</table>

<?php redirect('admin/Laporan','refresh'); ?>