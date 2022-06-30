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