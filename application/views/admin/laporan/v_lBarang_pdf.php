<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
}
</style>

<b><h4>Laporan Stok Barang <?php echo date('M-Y');?></h4></b>
<table width="100%" border="0.5">

<thead>

<tr style='font-weight:bold;'>

    <th>No.</th>

    <th>Kode Barang</th>

    <th>Nama Barang</th>

    <th>Satuan</th>

    <th>Harga Jual(Rp)</th>

    <th>Harga Pokok(Rp)</th>

    <th>Stok</th>

 </tr>

</thead>

<tbody>

<?php $i=1; foreach($data->result_array() as $list) { ?>

<tr>
 <td align='center'><?php echo $i;?></td>

 <td><?php echo $list['barang_id'];?></td>

 <td><?php echo $list['barang_nama'];?></td>

 <td><?php echo $list['barang_satuan'];?></td>

 <td><?php echo $list['barang_harjul'];?></td>

 <td><?php echo $list['barang_harpok'];?></td>

 <td><?php echo $list['barang_stok'];?></td>

 </tr>

<?php $i++; } ?>

</tbody>

</table>
