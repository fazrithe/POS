<?php 

$title = "SO-".date('d-m-Y');;

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<b><h4>Stock Opname periode <?php echo date('M-Y');?></h4></b>
<table width="100%">

<thead>

<tr>

    <th>No.</th>

    <th>Kode</th>

    <th>Nama</th>

    <th>Satuan</th>

    <th>Stock</th>

 </tr>

</thead>

<tbody>

<?php $i=1; foreach($data->result_array() as $list) { ?>

<tr>
 <td align='center'><?php echo $i;?></td>

 <td><?php echo $list['barang_id'];?></td>

 <td><?php echo $list['barang_nama'];?></td>

 <td><?php echo $list['barang_satuan'];?></td>

 <td align='center'><?php echo "....." ?></td>

 </tr>

<?php $i++; } ?>

</tbody>

</table>

<?php redirect('admin/Stock_opname','refresh'); ?>