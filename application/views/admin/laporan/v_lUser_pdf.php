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