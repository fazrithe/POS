<?php 

$title = "laporan_penjualan".date('d-m-Y');;

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>


<b><h4>Laporan Penjualan <?php echo $start_date;?> s/d <?php echo $end_date;?></h4></b>
<table width="100%">
    <thead>
        <tr style='font-weight:bold;'>
            <th>No.</th>

            <th>Faktur</th>

            <th>Nama Customer</th>

            <th>Tanggal</th>

            <th>Kode Barang</th>

            <th>Nama Barang</th>

            <th>Satuan</th>

            <th>Harga Jual (Rp)</th>

            <th>Qty</th>

            <th>Diskon</th>

            <th>Tipe Pembayaran</th>

            <th>Subtotal (Rp)</th>
                        
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($data->result_array() as $list) { ?>
            <!-- <?php  
                 $this->db->select('customer_name');
                 $this->db->where('customer_id',$list['jual_customer']);
                 $this->db->from('tbl_customer');
                 $customer = $this->db->get();   
                 $custname = $customer->row(); 
            ?> -->
        <tr>
            <td align='center'><?php echo $i;?></td>

            <td><?php echo $list['jual_nofak'];?></td>

            <td><?php echo $list['customer_name'];?></td>

            <td><?php echo $list['jual_tanggal'];?></td>

            <td><?php echo $list['d_jual_barang_id'];?></td>

            <td><?php echo $list['d_jual_barang_nama'];?></td>

            <td><?php echo $list['d_jual_barang_satuan'];?></td>

            <td><?php echo $list['d_jual_barang_harjul'];?></td>

            <td><?php echo $list['d_jual_qty'];?></td>
            
            <td><?php echo $list['d_jual_diskon'];?></td>

            <td><?php echo $list['jual_tipe_pembayaran'];?></td>

            <td><?php echo $list['d_jual_total'];?></td>

        </tr>

        <?php $i++; } ?>
        <?php 
            $b=$jml->row_array();
        ?>
        <tr>
            <td colspan="11" align='right'><b>Total (Rp)</b></td>
            <td align='right'><b><?php echo $b['jual_total'];?></b></td>
        </tr>

        <tr>
            <td colspan="11" align='right'><b>Cashback (Rp)</b></td>
            <td align='right'><b><?php echo $b['total_cashback'];?></b></td>
        </tr>

        <tr>
            <td colspan="11" align='right'><b>Grand Total (Rp)</b></td>
            <td align='right'><b><?php echo $b['grand_total'];?></b></td>
        </tr>
    </tbody>
</table>

<?php redirect('admin/Laporan','refresh'); ?>