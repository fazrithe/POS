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

            <td align='center'><?php echo $list['beli_nofak'];?></td>

            <td align='center'><?php echo $list['beli_tanggal'];?></td>

            <td align='center'><?php echo $list['d_beli_barang_id'];?></td>

            <td align='left'><?php echo $list['barang_nama'];?></td>

            <td align='center'><?php echo $list['barang_satuan'];?></td>

            <td align='center'><?php echo number_format($list['d_beli_harga']);?></td>

            <td align='center'><?php echo $list['d_beli_jumlah'];?></td>
            
            <td align='right'><?php echo number_format($list['d_beli_total']);?></td>

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













