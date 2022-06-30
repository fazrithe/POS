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


<b><h4>Laporan Penjualan <?php echo date('M-Y');?></h4></b>
<table width="100%">
    <thead>
        <tr style='font-weight:bold;'>
            <th>No.</th>

            <th>Faktur</th>

            <th>Tanggal</th>

            <th>Kode Barang</th>

            <th>Nama Barang</th>

            <th>Satuan</th>

            <th>Harga Jual (Rp)</th>

            <th>Qty</th>

            <th>Diskon</th>

            <th>Subtotal (Rp)</th>
                        
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($data->result_array() as $list) { ?>

        <tr>
            <td align='center'><?php echo $i;?></td>

            <td><?php echo $list['jual_nofak'];?></td>

            <td><?php echo $list['jual_tanggal'];?></td>

            <td><?php echo $list['d_jual_barang_id'];?></td>

            <td><?php echo $list['d_jual_barang_nama'];?></td>

            <td><?php echo $list['d_jual_barang_satuan'];?></td>

            <td><?php echo $list['d_jual_barang_harjul'];?></td>

            <td><?php echo $list['d_jual_qty'];?></td>
            
            <td><?php echo $list['d_jual_diskon'];?></td>

            <td><?php echo $list['d_jual_total'];?></td>

        </tr>

        <?php $i++; } ?>
        <?php 
            $b=$jml->row_array();
        ?>
        <tr>
            <td colspan="9" align='center'><b>Total (Rp)</b></td>
            <td align='right'><b><?php echo $b['jual_total'];?></b></td>
        </tr>

        <tr>
            <td colspan="9" align='center'><b>Cashback (Rp)</b></td>
            <td align='right'><b><?php echo $b['total_cashback'];?></b></td>
        </tr>

        <tr>
            <td colspan="9" align='center'><b>Grand Total (Rp)</b></td>
            <td align='right'><b><?php echo $b['grand_total'];?></b></td>
        </tr>
    </tbody>
</table>
